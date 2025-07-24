<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left py-3 px-4 font-semibold text-sm">Nombre</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Precio</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Cantidad en Stock</th>
            </tr>
        </thead>
        <tbody id="products-table-body" class="text-gray-700">
            @forelse ($products as $product)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $product->name }}</td>
                    <td class="py-3 px-4">@money($product->price, 'COP')</td>
                    <td class="py-3 px-4">{{ $product->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-4 px-4 text-center text-gray-500">
                        No hay productos registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
