<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Devuelve una vista parcial con la tabla de clientes (para AJAX).
     */
    public function index()
    {
        $clients = Auth::user()->clients()->orderBy('name')->get();

        // Esta respuesta está diseñada para ser inyectada en el DOM mediante JavaScript
        return view('partials._clients-table', compact('clients'))->render();
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'doc_id' => 'required|string|max:255|unique:clients,doc_id',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $client = Auth::user()->clients()->create($request->all());

        return response()->json([
            'message' => 'Cliente creado con éxito.',
            'client' => $client
        ], 201);
    }
}
