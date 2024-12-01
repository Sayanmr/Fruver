const nombre = document.getElementById('nombre');
const apellido = document.getElementById('apellido');
const correo = document.getElementById('correo');
const contraseña = document.getElementById('contraseña');
const confirmContraseña = document.getElementById('confirmContraseña');
const fechaInput = document.getElementById('date');
const formulario = document.getElementById('formulario');
const mensajeExito = document.getElementById('Exito');

// Agregar los escuchadores de evento
nombre.addEventListener('input', verificarNombre);
apellido.addEventListener('input', verificarApellido);
correo.addEventListener('input', verificarCorreo);
contraseña.addEventListener('input', verificarContraseña);
confirmContraseña.addEventListener('input', verificarConfirmacionContraseña);
fechaInput.addEventListener('input', verificarFechaInput);

// Funciones de verificación
function verificarNombre() {
    const nombreValor = nombre.value.trim();
    if (nombreValor === '') {
        mostrarError(nombre, 'Este campo es obligatorio');
        return false;
    } else {
        mostrarExito(nombre);
        return true;
    }
}

function verificarApellido() {
    const apellidoValor = apellido.value.trim();
    if (apellidoValor === '') {
        mostrarError(apellido, 'Este campo es obligatorio');
        return false;
    } else {
        mostrarExito(apellido);
        return true;
    }
}

function verificarCorreo() {
    const correoValor = correo.value.trim();
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (correoValor === '') {
        mostrarError(correo, 'El correo es obligatorio');
        return false;
    } else if (!regexCorreo.test(correoValor)) {
        mostrarError(correo, 'El correo no es válido');
        return false;
    } else {
        mostrarExito(correo);
        return true;
    }
}

function verificarContraseña() {
    const contraseñaValor = contraseña.value.trim();
    if (contraseñaValor.length < 8) {
        mostrarError(contraseña, 'La contraseña debe tener al menos 8 caracteres');
        return false;
    } else {
        mostrarExito(contraseña);
        return true;
    }
}

function verificarConfirmacionContraseña() {
    const confirmContraseñaValor = confirmContraseña.value.trim();
    if (confirmContraseñaValor !== contraseña.value.trim()) {
        mostrarError(confirmContraseña, 'Las contraseñas no coinciden');
        return false;
    } else {
        mostrarExito(confirmContraseña);
        return true;
    }
}

function verificarFechaInput() {
    const fechaInputValor = fechaInput.value.trim();
    if (fechaInputValor === '') {
        mostrarError(fechaInput, 'Es necesario ingresar su fecha de nacimiento');
        return false;
    } else {
        mostrarExito(fechaInput);
        return true;
    }
}

// Evento de submit 
formulario.addEventListener('submit', (evento) => {
    evento.preventDefault();

    // Validación de cada campo
    let nombreCorrecto = verificarNombre();
    let apellidoCorrecto = verificarApellido();
    let correoCorrecto = verificarCorreo();
    let contraseñaCorrecto = verificarContraseña();
    let confirmacionContraseñaCorrecta = verificarConfirmacionContraseña();
    let fechaInputCorrecta = verificarFechaInput();

    // Si todos los campos son correctos, muestra el mensaje de éxito
    if (nombreCorrecto && apellidoCorrecto && correoCorrecto && contraseñaCorrecto && confirmacionContraseñaCorrecta && fechaInputCorrecta) {
        mensajeExito.style.display = 'block'; // Mostrar mensaje de éxito
        formulario.reset(); // Limpiar formulario después de éxito
    } else {
        mensajeExito.style.display = 'none'; // Ocultar mensaje de éxito si hay errores
    }
});

// Función para mostrar mensaje de error
function mostrarError(campo, mensaje) {
    const formControl = campo.parentElement;

    // Verifica si el mensaje de error ya existe, si no, lo crea
    let small = formControl.querySelector('small');
    if (!small) {
        small = document.createElement('small');
        formControl.appendChild(small); // Añadimos el elemento <small> si no existe
    }
    small.textContent = mensaje; // Establecer el mensaje de error

    formControl.className = 'form-control error'; // Marcar el campo como erróneo
}

// Función para mostrar mensaje de éxito
function mostrarExito(campo) {
    const formControl = campo.parentElement;
    formControl.className = 'form-control success'; // Marcar el campo como correcto
}
