// ayudas
import { ImagenInteractiva } from '../js/helpers.js'
import { Models, disign } from '../js/data-base.js'
import { ItemsPersonalizaciones } from '../js/personalizaciones.js'
import { InserBtnColors, ToggleContents, ExtraFunctions, ModalSelectItems } from "../js/optionsEdit.js"
import { ModuloThree } from '../js/modulo-three.js';
import { ConcexionServidor } from '../js/conexionServidor.js';
import { Loader } from '../js/loader.js';

window.onload = async function () {
    // Tu código aquí
    const loader = new Loader();
    const conexionServidor = new ConcexionServidor()
    const modelos = await conexionServidor.getModel()
    const diseños = await conexionServidor.getDisign()
    const configuracionModelos = JSON.parse(modelos[0].configuracion)
    const shirtDisign = diseños[0]
    shirtDisign.personalizaciones = JSON.parse(shirtDisign.personalizaciones)
    loader.hide()


    class ItemPersonalizadoImage {
        constructor(name, imageRender) {
            this.type = 'image';
            this.id = `decal-${Date.now()}`;
            this.datos = { name, imageRender };
            this.width = 0;
            this.height = 0;
            this.x = 0;
            this.y = 0;
            this.z = 0;
        }
    }

    // Personalizacion Item
    // const PersonalizacionItems = data


    // ExtraFunction
    const contentExtraFunction = document.querySelector('.extas-funcions')

    // ContentEdit
    const optionsEdit = document.querySelector("#options-edit")

    // Colors
    const contentColors = document.querySelector(".content-colors")
    const colors = configuracionModelos.colors
    const colorActive = shirtDisign.color?shirtDisign.color: colors[0]

    // Agregar Personalizacion
    const contentAgregarPersonalizaciones = document.querySelector(".conteiner-agregar-personalizaciones")
    const contentPersonalizaciones = document.querySelector(".content-personalizaciones")


    // ----------------------------------------------
    // Three JS

    const contentEditorShirt = document.getElementById('content-editor');


    const moduloThree = new ModuloThree(contentEditorShirt, configuracionModelos, loader);
    await moduloThree.loadModel();


    const toggleContentEdit = new ToggleContents(optionsEdit)
    const colorShirt = new InserBtnColors(contentColors, colors, colorActive, moduloThree)
    // const modalSeclectItems = new ModalSelectItems(contentAgregarPersonalizaciones)
    const itemsPersonalizaciones = new ItemsPersonalizaciones(contentPersonalizaciones, shirtDisign, contentAgregarPersonalizaciones, moduloThree)
    const extraFuncions = new ExtraFunctions(contentExtraFunction);

    const btnDescargar = document.querySelector('.btn-download')
    btnDescargar.addEventListener('click', () => {
        // alert("Descargando")
        moduloThree.download(shirtDisign.nombre)
 
    })
    
    const btnSave = document.querySelector('.btn-save')
    btnSave.addEventListener('click', () => {
        shirtDisign.personalizaciones = itemsPersonalizaciones.personalizaciones
        shirtDisign.color = colorShirt.colorActive
        conexionServidor.updateDisign(shirtDisign)
    })
};