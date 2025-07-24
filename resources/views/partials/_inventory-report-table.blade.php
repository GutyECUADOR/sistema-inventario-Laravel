<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left py-3 px-4 font-semibold text-sm">Producto</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Precio Unitario</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Cantidad Actual</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Valor Total</th>
            </tr>
        </thead>
        <tbody id="inventory-report-body">
            @forelse ($products as $product)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $product->name }}</td>
                    <td class="py-3 px-4">@money($product->price, 'COP')</td>
                    <td class="py-3 px-4">{{ $product->quantity }}</td>
                    <td class="py-3 px-4 font-medium">
                        {{-- Calculamos el valor total del stock del producto --}}
                        @money($product->price * $product->quantity, 'COP')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 px-4 text-center text-gray-500">
                        El inventario está vacío.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
