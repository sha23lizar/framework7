import { ImagenInteractiva, renderImage} from './helpers.js'
import {Loader} from './loader.js'
 
export class ToggleContents {
    constructor(contentTogle) {
        this.headers = contentTogle.querySelectorAll("[data-head]")
        this.contains = contentTogle.querySelectorAll("[data-content]")

        this.headers.forEach((header) => {
            header.addEventListener("click", () => {
                this.toggle(header.getAttribute("data-head"))
            })
        })
    }
    toggle(header) {
        this.headers.forEach((nodo) => {
            if (nodo.getAttribute("data-head") == header) {
                nodo.classList.add("active")
            } else {
                nodo.classList.remove("active")
            }
        })
        this.contains.forEach((nodo) => {
            if (nodo.dataset.content == header) {
                nodo.classList.add("active")
            } else {
                nodo.classList.remove("active")
            }
        })
    }
}


export class InserBtnColors {
    constructor(contentColors, colors, colorActive, moduloThree, mode) {
        this.contentColors = contentColors
        this.moduloThree = moduloThree
        this.colorActive = colorActive
        this.mode = mode

        colors.forEach(element => {
            let button = document.createElement("button")
            button.style.setProperty("--btn-color", element)
            button.classList.add("btn-color")
            if (element == colorActive) {
                button.classList.add("active")
                this.setColorModel(button.style.getPropertyValue("--btn-color"))
            }
            button.addEventListener("click", (e) => {
                this.setColorActive(e.target.style.getPropertyValue("--btn-color"))
            })
            contentColors.appendChild(button)
        });
    }
    setColorActive(color) {
        this.contentColors.childNodes.forEach((nodo) => {
            if (nodo.classList.contains("active")) {
                nodo.classList.remove("active")
            }
            if (nodo.style.getPropertyValue("--btn-color") == color) {
                nodo.classList.add("active")
            }
        })
        this.cambiarVariableCss("--color-active", color)
        this.setColorModel(color, this.mode)
        this.colorActive = color
    }

    cambiarVariableCss(variable, valor) {
        document.documentElement.style.setProperty(variable, valor);
    };

    setColorModel(color, modo) {
        this.moduloThree.changeColorModel(color)

    }
}


// Modal para agregar personalizaciones
export class ModalSelectItems {
    constructor(contentModalSelectItems, funcionAgregarPersonalizaciones) {
        
        this.funcionAgregarPersonalizaciones = funcionAgregarPersonalizaciones
        this.urls = {
            agregarImg :"../includes/subirImagen.php",
        }  

        this.content = contentModalSelectItems
        // Btn para cerrar Modal
        this.content.querySelector('.btn-cerrar-modal').addEventListener('click', () => {
            this.content.classList.toggle('active')
        })


        //img variables necesarias
        this.imgloaded = ""
        this.imgloadedRender = ""
        this.nameImgloaded = ""
        this.addingImage = false
        this.form = document.querySelector('.form-agregar-imagen')
        this.inputAgregarFile = this.content.querySelector('#file-agregar-file')
        this.btnAgregarImagen = this.content.querySelector('.btn-agregar-imagen')
        // variables necesaras para content confirmar Imagen
        this.containerConfirmImgLoader = this.content.querySelector('.container-confirm-img-loader')
        this.nameImgLoader = this.content.querySelector('.container-confirm-img-loader p')
        this.contentImgLoader = this.content.querySelector('.container-confirm-img-loader .img')
        this.btnRechazarImagenLoader = this.content.querySelector('.btn-rechazar-imagen')
        this.btnAceptarImagenLoader = this.content.querySelector('.btn-aceptar-imgagen')


        // codigo usar las imagenes del usuario
        this.btnsContentUserImg = document.querySelectorAll('.btns-content-user-img')
        this.btnsContentUserImg.forEach((btn) => {
            btn.addEventListener('click', () => {
                var imagenLoad = {
                    id_user : btn.id,
                    urlImg : btn.getAttribute('data-url'),
                    nameImg : btn.getAttribute('data-name'),
                }
                this.funcionAgregarPersonalizaciones(imagenLoad)
            })
        })
        // funciones abrir buscador para IMG
        this.btnAgregarImagen.addEventListener('click', () => {
            this.inputAgregarFile.click()     
        })

        // funcioncuando sube una imagenn
        this.inputAgregarFile.addEventListener('change', (e) => this.addInputImage(e))

    
        // para que se pueda mover la imagen
        this.imagenInteractiva = new ImagenInteractiva('.fondo-transparent', '.container-confirm-img-loader .img')


        // cando se rechaza la imagen
        this.btnRechazarImagenLoader.addEventListener('click', () => {
            this.containerConfirmImgLoader.classList.remove('active')
        })
        
        // accion al aceptar imagen
        this.btnAceptarImagenLoader.addEventListener('click', () => {
            if (this.addingImage) {
                return
            }
            this.addingImage = true
            // this.contentloader.style.setProperty('display', 'flex')
            // var item = new ItemPersonalizadoImage(imgloaded.name, imgloadedRender)
            // this.PersonalizacionItems.push(item);
            // this.insertarPersonalizationItem(item)
            // this.containerConfirmImgLoader.classList.remove('active')
            // this.contenedorAgregarPersonalizaciones.classList.remove('active')
            this.addingImage = false
            console.log("hola")
        })

    }

    // Funcion para cuando sube un archivo
    addInputImage(e) {
        // seleccionar 1er archivo
        this.imgloaded = e.target.files[0]
        // resetear el input

        // confirmar que es una imagen
        if (this.imgloaded) {
            this.tipoArchivo = this.imgloaded['type'];

            // tipos de archivos validos
            this.tiposValidos = ['image/jpeg', 'image/png'];
    
            if (this.tiposValidos.indexOf(this.tipoArchivo) > -1) {

                // Tamaño de imagen valido
                this.tamanoArchivo = this.imgloaded.size / 1024 / 1024; // Tamaño en MB
    
                if (this.tamanoArchivo > 2) {
                    // Si el archivo es mayor al tamaño valido
                    Toastify({
                        text: "La imagen es mayor a 2 MB.",
                        duration: 4000,
                        close: 3 % 3 ? true : false,
                        style: {
                            background: "linear-gradient(to right, #ff5f6d, #ff9800)",
                        }
                    }).showToast();
                    
                } else {
                    // El archivo es menor o igual al tamaño valido
                    Toastify({
                        text: "Imagen subida con exito",
                        duration: 4000,
                        close: 3 % 3 ? true : false,
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        }
                    }).showToast();

                    // document.querySelector('.form-agregar-imagen').addEventListener('submit', (event) => {
                    //     event.preventDefault();
                    // })
                    
                    var loader = new Loader()
                    loader.show()
                    fetch(this.urls.agregarImg, {
                        method: 'POST',
                        body: new FormData(document.querySelector('.form-agregar-imagen'))
                    })
                        .then(response => {
                            if (response.ok) {
                                return response.text();
                            } else {
                                throw new Error('Algo salió mal en la petición fetch');
                            }
                        })
                        .then(data => {
                            loader.hide()
                            var imgload = JSON.parse(data) // parsear data
                              const html = `
                                <div class="btns-content-user-img" id="${imgload.id_user}" data-url="${imgload.urlImg}" data-name="${imgload.nameImg}">
                                  <!-- <button type="button" class="btn btn-outline-danger btn-delete-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="80%" height="80%" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1.5-.5m2.5 0a.5.5 0 0 1.5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1.5-.5m3.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                  </button> -->
                                  <div>
                                    <img src="${imgload.urlImg}" alt="">
                                  </div>
                                  <p class="title">${imgload.nameImg}</p>
                                </div>
                              `;
                              document.querySelector('.opciones-agregar').innerHTML += html
                            this.funcionAgregarPersonalizaciones(imgload)
                            // this.confirmarImgLoader(imgload)
                        })
                        .catch(error => console.error('Error:', error));
                    console.log("por enviar");

                }
            } else {
                // Si el archivo no es una imagen valida 
                Toastify({
                    text: "El archivo no es una imagen válida.",
                    duration: 4000,
                    close: 3 % 3 ? true : false,
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ff9800)",
                    }
                }).showToast();
            }
        }
        e.target.value = null;

    }

    // Cuando se sube una imagen  valida se abre el panel de confirmacion
    confirmarImgLoader(imgload){
        // se restaura el modo initeractivo(para que use los valores de esta imagen)
        this.imagenInteractiva.restaurar()
        // se activa el panel de confirmacion
        this.containerConfirmImgLoader.classList.add('active')
        this.nameImgLoader.innerText = imgload.nameImg
        // se renderiza la imagen con el modulo que viene de helpers
       
        this.contentImgLoader.style.setProperty('background', `url(${imgload.urlImg}) no-repeat center/contain`)

    }

    /// Funciones de activar y desactivar el modal
    active() {
        this.content.classList.toggle('active')
    }

}


export class ExtraFunctions {
    constructor(contentExtrafunction) {
        // Fullscreen
        this.content = contentExtrafunction
        const btnReducir = this.content.querySelector('.btn-reducir')
        const btnExpander = this.content.querySelector('.btn-expander')
        btnExpander.addEventListener('click', () => {
            document.body.classList.add('fullscreen')
        })
        btnReducir.addEventListener('click', () => {
            document.body.classList.remove('fullscreen')
        })

        // Descargar
        // const btnDescargar = this.content.querySelector('.btn-download')
        // btnDescargar.addEventListener('click', () => {
            
        //     const canvas = document.querySelector("canvas");
        //     console.log(canvas);
        //     const dataURL = canvas.toDataURL();
        //     console.log(dataURL);
        //     const link = document.createElement("a");
        //     link.href = dataURL;
        //     link.download = "canvas.png";
        //     document.body.appendChild(link);
        //     link.click();
        //     document.body.removeChild(link);
        // })
    }
}
