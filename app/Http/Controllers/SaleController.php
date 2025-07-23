<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Product;
use App\Models\Transaction;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'payment_method' => 'required|in:contado,credito',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $total = 0;
        $items = $request->input('items');

        // Usamos una transacción de base de datos para asegurar la integridad de los datos.
        // O todo se completa, o nada lo hace.
        try {
            DB::beginTransaction();

            $client = Client::findOrFail($request->client_id);
            $transactionItems = [];

            foreach ($items as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']); // Bloquear la fila para evitar concurrencia

                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Stock insuficiente para el producto: {$product->name}");
                }

                $product->quantity -= $item['quantity'];
                $product->save();

                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $transactionItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ];
            }

            // Registrar la transacción de la venta
            Transaction::create([
                'user_id' => $user->id,
                'client_id' => $client->id,
                'type' => 'purchase',
                'details' => $transactionItems,
                'amount' => $total,
                'payment_method' => $request->payment_method,
            ]);

            // Si es a crédito, actualizar el saldo del cliente
            if ($request->payment_method === 'credito') {
                $client->balance += $total;
                $client->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'Venta registrada con éxito.',
                'client' => $client->fresh() // Devuelve el cliente actualizado
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al procesar la venta: ' . $e->getMessage()], 500);
        }
    }
}
