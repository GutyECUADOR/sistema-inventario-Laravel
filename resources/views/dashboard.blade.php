<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema de Gestión') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="clients-content">
                <div class="bg-white p-6 rounded-xl shadow-md">
                     <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Gestión de Clientes</h2>
                        <button id="add-client-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Añadir Cliente</button>
                    </div>
                    <div id="clients-table-container">
                    </div>
                </div>
            </div>

            </div>
    </div>

    @include('partials._client-modal')
    @include('partials._product-modal')

</x-app-layout>
