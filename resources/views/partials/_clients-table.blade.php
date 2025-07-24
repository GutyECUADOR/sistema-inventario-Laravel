<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left py-3 px-4 font-semibold text-sm">Nombre</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Documento</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Teléfono</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Dirección</th>
                <th class="text-left py-3 px-4 font-semibold text-sm">Saldo</th>
            </tr>
        </thead>
        <tbody id="clients-table-body" class="text-gray-700">
            @forelse ($clients as $client)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $client->name }}</td>
                    <td class="py-3 px-4">{{ $client->doc_id }}</td>
                    <td class="py-3 px-4">{{ $client->phone }}</td>
                    <td class="py-3 px-4">{{ $client->address }}</td>
                    <td class="py-3 px-4 font-medium {{ $client->balance > 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{-- Formato de moneda de Blade --}}
                        @money($client->balance, 'COP')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                        No hay clientes registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
