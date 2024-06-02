// Crear una instancia de objeto XMLHttpRequest
var xhr = new XMLHttpRequest();

// Configurar la solicitud
xhr.open("GET", "./json.php", true);

// Definir la función que manejará el cambio de estado de la solicitud
xhr.onreadystatechange = function() {
    // Verificar si la solicitud se completó (readyState = 4) y si el estado de la respuesta es OK (status = 200)
    if (xhr.readyState === 4 && xhr.status === 200) {
        // Verificar si la respuesta no está vacía
        if (xhr.responseText.trim() !== "") {
            // La solicitud se realizó correctamente y la respuesta no está vacía
            var data = JSON.parse(xhr.responseText);
            // Hacer algo con los datos, por ejemplo, imprimirlos en la consola
            console.log(data);
            // Aquí puedes procesar los datos y mostrarlos en tu página web
        } else {
            // La respuesta está vacía
            console.error('La respuesta JSON está vacía.');
        }
    } else if (xhr.readyState === 4) {
        // La solicitud finalizó, pero hubo un error en el servidor
        console.error('Error en la solicitud: ' + xhr.status);
    }
};

// Enviar la solicitud
xhr.send();
