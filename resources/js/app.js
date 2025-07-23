import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// Asegúrate de incluir el token CSRF en tus peticiones POST
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function saveClient(e) {
    e.preventDefault();
    const name = document.getElementById('client-name').value;
    const docId = document.getElementById('client-doc').value;
    const phone = document.getElementById('client-phone').value;
    const address = document.getElementById('client-address').value;

    if (!name || !docId || !phone || !address) {
        showNotification("Por favor, complete todos los campos.", "error");
        return;
    }

    try {
        const response = await fetch('/clients', { // Llama a tu ruta de Laravel
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ name, doc_id: docId, phone, address })
        });

        const result = await response.json();

        if (!response.ok) {
            // Manejar errores de validación u otros
            throw new Error(result.message || 'Error del servidor');
        }

        showNotification("Cliente añadido con éxito.");
        document.getElementById('client-form').reset();
        clientModal.classList.remove('active');

        // Aquí deberías refrescar tu lista de clientes, por ejemplo, llamando a una función que recargue la tabla
        loadClients();

    } catch (error) {
        console.error("Error adding client: ", error);
        showNotification(error.message, "error");
    }
}

// Función para cargar los datos de la tabla
async function loadClients() {
    try {
        const response = await fetch('/clients'); // Ruta GET para listar
        const clientsHtml = await response.text(); // Suponiendo que el controlador devuelve una vista parcial
        document.getElementById('clients-table-container').innerHTML = clientsHtml;
    } catch(error) {
        console.error('Error al cargar clientes:', error);
    }
}

// Llama a esta función cuando la página se carga
document.addEventListener('DOMContentLoaded', loadClients);
