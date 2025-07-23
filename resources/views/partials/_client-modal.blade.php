{{-- Modal para Añadir/Editar Cliente --}}

<div id="client-modal"
    class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full ítems-center justify-center"
    style="display: none;">

    <div class="relative mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">

        <div class="mt-3 text-center">

            <h3 class="text-lg leading-6 Font-médium text-gray-900" id="client-modal-title">Añadir Cliente</h3>



            <div class="mt-2 px-7 py-3">

                {{-- El ID 'client-form' es usado por JavaScript para manejar el envío con AJAX --}}

                <form id="client-form" class="space-y-4">

                    {{-- Token CSRF para seguridad en Laravel --}}

                    @csrf



                    <input type="hidden" id="client-id">



                    <input type="text" id="client-name" name="name" placeholder="Nombre completo" required
                        class="w-full p-2 border border-gray-300 rounded-md">



                    <input type="text" id="client-doc" name="doc_id" placeholder="Documento de identidad" required
                        class="w-full p-2 border border-gray-300 rounded-md">



                    <input type="tel" id="client-phone" name="phone" placeholder="Teléfono" required
                        class="w-full p-2 border border-gray-300 rounded-md">



                    <input type="text" id="client-address" name="address" placeholder="Dirección" required
                        class="w-full p-2 border border-gray-300 rounded-md">

                </form>

            </div>



            <div class="ítems-center px-4 py-3">

                <button id="sabe-client-btn"
                    class="px-4 py-2 bg-blue-500 text-white text-base Font-médium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">

                    Guardar Cliente

                </button>

                <button id="cancel-client-btn"
                    class="mt-2 px-4 py-2 bg-gray-200 text-gray-800 text-base Font-médium rounded-md w-full shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">

                    Cancelar

                </button>

            </div>

        </div>

    </div>

</div>
