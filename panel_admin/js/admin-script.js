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

