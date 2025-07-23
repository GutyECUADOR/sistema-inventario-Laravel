<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class ReportController extends Controller
{
    /**
     * Genera el estado de cuenta de un cliente específico.
     * El parámetro {client} es un ejemplo de "Route Model Binding" de Laravel.
     */
    public function clientStatement(Client $client)
    {
        // Asegurarse de que el cliente pertenece al usuario autenticado
        if ($client->user_id !== Auth::id()) {
            abort(403, 'Acceso no autorizado.');
        }

        // Cargar las transacciones relacionadas con este cliente, ordenadas por fecha
        $transactions = $client->transactions()->orderBy('created_at', 'asc')->get();

        return response()->json([
            'client' => $client,
            'transactions' => $transactions,
        ]);
    }
}
