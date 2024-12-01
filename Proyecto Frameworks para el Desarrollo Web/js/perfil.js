// Obtener elementos
const modal = document.getElementById("modal-editar");
const btnEditar = document.getElementById("editar");
const spanClose = document.getElementsByClassName("close")[0];
const formEditar = document.getElementById("editar-form");

// Mostrar el modal al hacer clic en "EDITAR"
btnEditar.onclick = function() {
    modal.style.display = "block";
}

// Cerrar el modal al hacer clic en la "X"
spanClose.onclick = function() {
    modal.style.display = "none";
}

// Cerrar el modal al hacer clic fuera del contenido del modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

formEditar.onsubmit = function(event) {
    event.preventDefault(); // Prevenir el comportamiento por defecto

    // Obtener nuevos valores
    const nuevoNombre = document.getElementById("nuevo-nombre").value;
    const nuevoApellido = document.getElementById("nuevo-apellido").value;
    const nuevoEmail = document.getElementById("nuevo-email").value;
    const nuevaContraseña = document.getElementById("nueva-contraseña").value;
    const nuevaFechaNacimiento = document.getElementById("nueva-fecha-nacimiento").value;

    // Verificar que los datos no estén vacíos
    if (!nuevoNombre || !nuevoApellido || !nuevoEmail || !nuevaContraseña || !nuevaFechaNacimiento) {
        alert("Por favor, completa todos los campos.");
        return; 
    }

    console.log(datos); // Para ver si los datos son correctos


    // Enviar los datos al servidor usando AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "actualizar_perfil.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Crear los datos para enviar al servidor
    const datos = "nombre=" + nuevoNombre +
                  "&apellido=" + nuevoApellido +
                  "&correo=" + nuevoEmail +
                  "&contraseña=" + nuevaContraseña +
                  "&fecha_nacimiento=" + nuevaFechaNacimiento;

    xhr.onload = function() {
        if (xhr.status == 200) {
            // Verifica la respuesta del servidor
            if (xhr.responseText.trim() === "Datos actualizados correctamente.") {
                // Si la actualización fue exitosa, actualizar la información en la página
                document.getElementById("nombre").innerText = nuevoNombre;
                document.getElementById("apellido").innerText = nuevoApellido;
                document.getElementById("correo").innerText = nuevoEmail;
                document.getElementById("contraseña").innerText = nuevaContraseña;
                document.getElementById("fecha-nacimiento").innerText = nuevaFechaNacimiento;

                // Cerrar el modal
                modal.style.display = "none";
            } else {
                alert("Error al actualizar los datos: " + xhr.responseText);
            }
        } else {
            alert("Error de comunicación con el servidor.");
        }
    };

    xhr.send(datos);
}
