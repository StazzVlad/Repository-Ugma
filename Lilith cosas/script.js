const contenedor = document.getElementById('login-contenedor');
const registroBtn = document.getElementById('registrarse');
const accederBtn = document.getElementById('acceder');

registroBtn.addEventListener('click', () => {
    contenedor.classList.add("active");
});

accederBtn.addEventListener('click', () => {
    contenedor.classList.remove("active");
});