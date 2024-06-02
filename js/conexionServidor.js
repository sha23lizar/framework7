export class ConcexionServidor {
    constructor() {
        this.urls = {
            optenerModelo: "../includes/obtenerModeloConfig.php",
            optenerDiseño: "../includes/obtenerDiseño.php",
            actualizarDiseño: "../includes/actualizarDiseño.php",
        }

    }

    async getModel() {
        const response = await fetch(this.urls.optenerModelo);
        const data = await response.json();
        return data;
    }
    async getDisign() {
        const response = await fetch(this.urls.optenerDiseño);
        const data = await response.json();
        return data;
    }
    async updateDisign(disgin) {
        disgin.personalizaciones = JSON.stringify(disgin.personalizaciones)
        $.ajax({
            data: disgin,
            url: this.urls.actualizarDiseño,
            type: "POST",
            beforeSend: () => {
                $("#mostrar_mensaje").html("por enviar")
            },
            success: (mensaje) => {
                $("#mostrar_mensaje").html(mensaje)
                swal("Guardado", "El diseño "+disgin.nombre+" se guardo con exito", "success");
            }
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
}