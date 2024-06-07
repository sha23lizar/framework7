export class ModuloBeforeUnloadHandler {
    constructor() {
        // const links = document.querySelectorAll('.nav-links li a:not(:last-child)');

        // links.forEach(link => {
        //     // Agrega el evento click a cada enlace
        //     link.addEventListener('click', function (event) {
        //         event.preventDefault();
        //         if (confirm("¿Estás seguro de que deseas salir, algunos cambios no se guardaran?")) {
        //             window.location.href = this.href;
        //         }
        //     });
        // })
        // document.querySelectorAll('.nav-links .a').forEach(link => {

        // })
        // addEventListener('click', function (event) {
        //     event.preventDefault(); // previene la redirección inmediata
        //     if (confirm("¿Estás seguro de que deseas ir a la configuración del usuario?")) {
        //         window.location.href = this.href; // redirige a la página de configuración
        //     }
        // });
    }
    activar() {
        // window.addEventListener('beforeunload', this.beforeUnloadHandler);
    }
    desactivar() {
        // window.removeEventListener('beforeunload', this.beforeUnloadHandler);
    }
}