// ✅ TRABAJOS DROPDOWN
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');

allDropdown.forEach(item=>{
    const a = item.parentElement.querySelector('a:first-child');
    a.addEventListener('click', function (e) {
        e.preventDefault();

        if(!this.classList.contains('active')){
            allDropdown.forEach(i=> {
                const aLink = i.parentElement.querySelector('a:first-child');

                aLink.classList.remove('active');
                i.classList.remove('show');
            })
        }

        this.classList.toggle('active');
        item.classList.toggle('show');
    })

})



// ✅ SIDEBAR 
const interruptorSidebar = document.querySelector('nav .interruptor-sidebar');
const sidebar = document.getElementById('sidebar');

const allSideDivider = document.querySelectorAll('#sidebar .divider');

if(sidebar.classList.contains('oculto')) {
    allSideDivider.forEach(item=>{
        item.textContent = '-'
    })
}
else {
    allSideDivider.forEach(item=>{
        item.textContent = item.dataset.text;
    })
}

interruptorSidebar.addEventListener('click', function() {
    sidebar.classList.toggle('oculto');

    if(sidebar.classList.contains('oculto')) {
        allSideDivider.forEach(item=>{
            item.textContent = '-'
        })
    }
    else {
        allSideDivider.forEach(item=>{
            item.textContent = item.dataset.text;
        })
    }
})


// ✅ PERFIL DROPDOWN
const perfil = document.querySelector('nav .perfil');
const imgPerfil = perfil.querySelector('img');
const dropdownPerfil = perfil.querySelector('.perfil-link');

imgPerfil.addEventListener('click', function () {
    dropdownPerfil.classList.toggle('show');
})



window.addEventListener('click', function(e) {
    if(e.target !== imgPerfil) {
        if(e.target !== dropdownPerfil) {
            if(dropdownPerfil.classList.contains('show')) {
                dropdownPerfil.classList.remove('show');
            }
        }
    }
})


// BARRA DE PROGRESO
const allProgress = document.querySelectorAll('main .card .progreso');

allProgress.forEach(item=> {
    item.style.setProperty('--value', item.dataset.value)
})

// ✅ MAIN CONTENT CLICKS
document.querySelectorAll('.side-menu a').forEach(item => {
    item.addEventListener('click', event => {
        event.preventDefault(); // Evita que el enlace navegue
        const contentId = item.getAttribute('id'); // Obtiene el id del enlace
        loadContent(contentId); // Llama a la función para cargar el contenido
    });
});

function loadContent(contentId) {
    const mainContent = document.getElementById('main-content'); // Asegúrate de que el id sea correcto
    let url = '';

    switch(contentId) {
        case 'panel':
            url = '/Repository-ugma-main/panel_admin/vistas/panel.php'; // Ruta al archivo PHP
            break;
        case 'pregrado':
            url = '/Repository-ugma-main/panel_admin/vistas/pregrado.php'; // Cambia esto por la ruta correcta si existe
            break;
        case 'usuarios':
            url = '/Repository-ugma-main/panel_admin/vistas/usuarios.php'; // Caso para gestion de usuarios            
            break;  
        case 'proxi':
            url = '/Repository-ugma-main/panel_admin/vistas/proximamente.php'; // Caso para cuando una pagina aun no este disponible
            break;
        // Agrega más casos según sea necesario
        default:
            mainContent.innerHTML = '<h2>Contenido por defecto</h2>';
            return; // Salir de la función si no hay URL
    }

    // Cargar el contenido del archivo PHP
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la carga del contenido');
            }
            return response.text() // Obtener el contenido como texto
        })
        .then(data => {
            mainContent.innerHTML = data; // Insertar el contenido en el main
        })
        .catch(error => {
            console.error('Error:', error);
            mainContent.innerHTML = '<h2>Error al cargar contenido</h2>'; // Mensaje de error
        });

    setTimeout(() => { //Para detectar formularios ajax de php cargado
            console.log('Se actualizan el ajax después de 2 segundos');
            recargarVariables();
    }, 2000); //2s de retraso
}
