import {ModuloBeforeUnloadHandler} from '../js/moduloBeforeUnloadHandler.js'
export class ConcexionServidor {
    constructor(id_user) {
        this.urls = {
            optenerModelo: "../includes/obtenerModeloConfig.php",
            optenerDiseño: "../includes/obtenerDiseño.php",
            actualizarDiseño: "../includes/actualizarDiseño.php",
            subirImagenPreview: "../includes/subirImgPreviewDataURI.php",
            subirDiseño: "../includes/subirDiseño.php"


        }
        this.moduloBeforeUnloadHandler = new ModuloBeforeUnloadHandler();
        this.moduloBeforeUnloadHandler.activar();
        if (!id_user) {
            this.moduloBeforeUnloadHandler.desactivar();
        }
    }

    async getModel() {
        const response = await fetch(this.urls.optenerModelo);
        const data = await response.json();
        return data;
    }
    async getDisign(id) {
        id = id ? "?id=" + id : ""
        const response = await fetch(this.urls.optenerDiseño + id);
        const data = await response.json();

        if (data.length === 0) {
            // No hay registros que coincidan, manejar el caso aquí
            return null; // o cualquier otro valor que desees devolver
        }

        return data;
    }
    async updateDisign(disgin) {
        disgin.personalizaciones = JSON.stringify(disgin.personalizaciones)
        this.subirPreviewDataUri(disgin, (disgin) => {
            $.ajax({
                data: disgin,
                url: this.urls.actualizarDiseño,
                type: "POST",
                beforeSend: () => {
                    $("#mostrar_mensaje").html("por enviar")
                },
                success: (mensaje) => {
                    
                    if (document.getElementById('overlay').style.display === 'block') {
                        Toastify({
                            text: "Se guardo el Diseño",
                            duration: 4000,
                            close: 3 % 3 ? true : false,
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            }
                        }).showToast()
                    } else {
                        $("#mostrar_mensaje").html(mensaje)
                        swal("Guardado", "El diseño " + disgin.nombre + " se guardo con exito", "success");
                    }
                    
                }
            })
        })
    }
    async postDisign(disgin) {
        disgin.personalizaciones = JSON.stringify(disgin.personalizaciones)
        this.subirPreviewDataUri(disgin, (disgin) => {
            $.ajax({
                data: disgin,
                url: this.urls.subirDiseño,
                type: "POST",
                beforeSend: () => {
                    $("#mostrar_mensaje").html("por enviar")
                },
                success: (mensaje) => {
                    $("#mostrar_mensaje").html(mensaje)
                    swal({
                        title: "Su diseno ha sido guardado correctamente",
                        text: `El diseno se ha guardado como: ${disgin.nombre}`,
                        icon: "success",
                        button: "Aceptar",
                    }).then((value) => {
                        // Later, to disable the event listener
                        this.moduloBeforeUnloadHandler.desactivar();                        
                        window.location.href += "?id=" + mensaje;
                    });

                }
            })
        })
    }

    async post(data) {
        const response = await fetch(this.urls, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        return result;
    }

    async put(data) {
        const response = await fetch(this.urls, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        return result;
    }

    async delete() {
        const response = await fetch(this.urls, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        const result = await response.json();
        return result;
    }
    subirPreviewDataUri(disgin, func) {
        var data = disgin.preview.replace("data:image/png;base64,", "");
        var disgin = disgin
        $.ajax({
            url: this.urls.subirImagenPreview.replace("hooo", ""),
            type: "POST",
            data: {
                data,
                user_id: disgin.user_id
            },
            beforeSend: () => {
                $("#mostrar_mensaje").html("por enviar")
            },
            success: (mensaje) => {
                // $("#mostrar_mensaje").html(mensaje)
                // alert(mensaje)
                disgin.preview = mensaje
                func(disgin);
            }
        });
    }

    dataURLtoBlob(dataurl) {
        // convert base64 to raw binary data held in a string
        // doesn't handle URLEncoded dataurls - see SO answer #6850276 for code that does this
        var byteString = atob(dataurl.split(',')[1]);

        // separate out the mime component
        var mimeString = dataurl.split(',')[0].split(':')[1].split(';')[0];

        // write the bytes of the string to an ArrayBuffer
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }

        //Old Code
        //write the ArrayBuffer to a blob, and you're done
        //var bb = new BlobBuilder();
        //bb.append(ab);
        //return bb.getBlob(mimeString);

        //New Code
        return new Blob([ab], { type: mimeString });
    }
}