<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal con datos agregados.
     */
    public function index()
    {
        $user = Auth::user();

        // Obtener los datos para las tarjetas de resumen
        $totalClients = $user->clients()->count();
        $totalProducts = $user->products()->count();
        $totalDebt = $user->clients()->sum('balance');

        // Obtener listas para los selectores en los formularios
        $clients = $user->clients()->orderBy('name')->get();
        $products = $user->products()->orderBy('name')->get();

        // Devolver la vista principal con todos los datos necesarios
        return view('dashboard', [
            'totalClients' => $totalClients,
            'totalProducts' => $totalProducts,
            'totalDebt' => $totalDebt,
            'clients' => $clients,
            'products' => $products,
        ]);
    }
}
