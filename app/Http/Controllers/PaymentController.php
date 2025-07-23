<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Transaction;

class PaymentController extends Controller
{
    /**
     * Registra el abono de un cliente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->findOrFail($request->client_id);

        if ($request->amount > $client->balance) {
            return response()->json(['message' => 'El monto del abono no puede ser mayor que el saldo actual.'], 422);
        }

        try {
            DB::beginTransaction();

            // 1. Actualizar el saldo del cliente
            $client->balance -= $request->amount;
            $client->save();

            // 2. Registrar la transacción del pago
            Transaction::create([
                'user_id' => $user->id,
                'client_id' => $client->id,
                'type' => 'payment',
                'details' => ['description' => 'Abono a la deuda'],
                'amount' => $request->amount,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Abono registrado con éxito.',
                'client' => $client->fresh()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al registrar el abono: ' . $e->getMessage()], 500);
        }
    }
}
