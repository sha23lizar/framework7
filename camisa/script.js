
import { ItemsPersonalizaciones } from '../js/personalizaciones.js'
import { InserBtnColors, ToggleContents, ExtraFunctions, ModalSelectItems } from "../js/optionsEdit.js"
import { ModuloThree } from '../js/modulo-three.js';
import { ConcexionServidor } from '../js/conexionServidor.js';
import { Loader } from '../js/loader.js';

window.onload = async function () {
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
    var id = getParameterByName('id');

    // Tu código aquí
    var id_user = document.getElementById('id_user').getAttribute('data-id')
    if (!id_user) {
        let btnsSalir = document.querySelectorAll('#btn-header-opcion-personalizado, .btn-save, .btn-buy')
        
        btnsSalir.forEach(element => {
            element.addEventListener('click', () => {
                // e.preventDefault();
                
                swal("Debes de iniciar sesión para continuar", {
                    buttons: {
                      cancel: "Cerrar",
                      catch: {
                        text: "Iniciar sesión",
                        value: "catch",
                      }
                    },
                  })
                  .then((value) => {
                    switch (value) {
                   
                   
                      case "catch":
                        location.href = "../Sign-up/login.php";
                        break;
                   
                      default:
                        
                    }
                  });
            })
            
        })
    }
    const loader = new Loader();
    var guardado = true
    const conexionServidor = new ConcexionServidor()
    const modelos = await conexionServidor.getModel(1)
    const diseños = await conexionServidor.getDisign(id)
    const configuracionModelos = JSON.parse(modelos[0].configuracion)
    var shirtDisign;
    console.log(diseños)
    if (diseños === null) {
        shirtDisign = {
            personalizaciones: [],
            nombre: 'Nuevo Diseño',
            user_id: id_user,
            modelo:1
        }   
        var guardado = false
    } else {
        shirtDisign = diseños[0]
        shirtDisign.personalizaciones = JSON.parse(shirtDisign.personalizaciones)
    }
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
    const colorActive = shirtDisign.color ? shirtDisign.color : colors[0]

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

    const tituloDisign = document.querySelector('.texto-nombre-diseño')
    const btnEditarNombre = document.querySelector('.btn-editar-nombre')
    btnEditarNombre.addEventListener('click', (e) => {
        swal("Como quieres que se llame tu Diseño", {
            content: "input",

        }).then((value) => {
            if (value.trim().length > 0) {
                tituloDisign.innerText = value
                shirtDisign.nombre = value
            } else {
                swal("El nombre no puede estar vacio")
            }
            
          });
    })

    const btnDescargar = document.querySelector('.btn-download')
    btnDescargar.addEventListener('click', () => {
        // alert("Descargando")
        moduloThree.download(shirtDisign.nombre)

    })

    const btnSave = document.querySelector('.btn-save')
    btnSave.addEventListener('click', () => {
        shirtDisign.personalizaciones = itemsPersonalizaciones.personalizaciones
        shirtDisign.color = colorShirt.colorActive
        shirtDisign.preview = moduloThree.getImgData()
        // conexionServidor.enviarImagen(shirtDisign.preview)
        

        if (guardado) {
            conexionServidor.updateDisign(shirtDisign)
            return
        } else {
            swal("Como quieres que se llame tu Diseño", {
                content: "input",
              })
              .then((value) => {
                if (value.trim().length > 0) {
                    tituloDisign.innerText = value
                    shirtDisign.nombre = value
                    conexionServidor.postDisign(shirtDisign)
                } else {
                    swal("El nombre no puede estar vacio")
                }

                
              });
        }
    })
    window.addEventListener('beforeunload', (event) => {
        event.preventDefault();
        event.returnValue = '';
      });

};