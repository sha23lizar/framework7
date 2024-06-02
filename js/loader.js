export class Loader {
    constructor() {
        // Crear el elemento div principal
        this.divPrincipal = document.createElement('div');

        // Crear el elemento div secundario
        this.divSecundario = document.createElement('div');
        this.divSecundario.id = 'progress-bar-container';

        // Crear el elemento label
        this.texto = document.createElement('label');
        this.texto.id = 'progress-bar-label';
        this.texto.htmlFor = 'progress-bar';
        this.texto.textContent = 'loading....';

        // Crear el elemento progress
        this.barraProgreso = document.createElement('progress');
        this.barraProgreso.id = 'progress-bar';
        this.barraProgreso.value = 0;
        this.barraProgreso.max = 100;

        // Agregar los elementos al div secundario
        this.divSecundario.appendChild(this.texto);
        this.divSecundario.appendChild(this.barraProgreso);

        // Agregar el div secundario al div principal
        this.divPrincipal.appendChild(this.divSecundario);

        // Agregar el div principal al cuerpo del documento
        document.body.appendChild(this.divPrincipal);

        let estilo = document.createElement('style');

        // Agregar las reglas CSS al elemento de estilo
        estilo.innerHTML = `
            #progress-bar-container{
                position: absolute;
                display: flex;
                left: 50%;
                z-index: 1000;
                top: 50%;
                transform: translate(-50%, -50%);
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.589);
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        
            #progress-bar{
                width: 30%;
                height: 2%;
                margin-top: 0.5%;
            }
            #progress-bar-label{
                color: white;
                font: 2em sans-serif;
            }
        `;
        
        // Agregar el elemento de estilo al encabezado del documento
        document.head.appendChild(estilo);


    }

    hide() {
        this.divPrincipal.style.display = 'none'
    }

    progress(value,text) {
        this.barraProgreso.value = value
        if(text){
            this.barraProgreso.textContent = text
        }
    }
    show() {
        this.barraProgreso.value = 0
        this.divPrincipal.style.display = 'flex'
    }
}