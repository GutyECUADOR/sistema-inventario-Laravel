<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Transaction;

class StockController extends Controller
{
    /**
     * Añade stock a un producto existente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $product = Product::where('user_id', $user->id)->findOrFail($request->product_id);

        try {
            DB::beginTransaction();

            // 1. Actualizar la cantidad del producto
            $product->quantity += $request->quantity;
            $product->save();

            // 2. Registrar la transacción de entrada de stock
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'stock_add',
                'details' => [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity_added' => $request->quantity,
                ],
                'amount' => 0, // No hay valor monetario en esta transacción
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Stock añadido con éxito.',
                'product' => $product->fresh()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al añadir stock: ' . $e->getMessage()], 500);
        }
    }
}
