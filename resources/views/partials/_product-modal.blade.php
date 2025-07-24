
{{-- Modal para Añadir/Editar Producto --}}
<div id="product-modal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full items-center justify-center" style="display: none;">
    <div class="relative mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="product-modal-title">Añadir Producto</h3>

            <div class="mt-2 px-7 py-3">
                {{-- El ID 'product-form' es usado por JavaScript para manejar el envío con AJAX --}}
                <form id="product-form" class="space-y-4">
                    {{-- Token CSRF para seguridad en Laravel --}}
                    @csrf

                    <input type="hidden" id="product-id">

                    <input type="text" id="product-name" name="name" placeholder="Nombre del producto" required
                           class="w-full p-2 border border-gray-300 rounded-md">

                    <input type="number" id="product-price" name="price" placeholder="Precio" min="0" step="0.01" required
                           class="w-full p-2 border border-gray-300 rounded-md">

                    <input type="number" id="product-quantity" name="quantity" placeholder="Cantidad inicial" min="0" required
                           class="w-full p-2 border border-gray-300 rounded-md">
                </form>
            </div>

            <div class="items-center px-4 py-3">
                <button id="save-product-btn" class="px-4 py-2 bg-teal-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                    Guardar Producto
                </button>
                <button id="cancel-product-btn" class="mt-2 px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
