<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Devuelve una vista parcial con la tabla de productos (para AJAX).
     */
    public function index()
    {
        $products = Auth::user()->products()->orderBy('name')->get();

        // Devuelve HTML renderizado para actualizar la tabla de productos dinámicamente
        return view('partials._products-table', compact('products'))->render();
    }

    /**
     * Almacena un nuevo producto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Auth::user()->products()->create($request->all());

        return response()->json([
            'message' => 'Producto creado con éxito.',
            'product' => $product
        ], 201);
    }
}
