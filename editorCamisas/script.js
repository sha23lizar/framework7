// ayudas
import { ImagenInteractiva } from '../js/helpers.js'
import data from '../js/data.js'
import { ModuloThree } from '../js/modulo-three.js';


class ItemPersonalizadoImage {
    constructor(name, imageRender) {
        this.type = 'image';
        this.id = `item-${Date.now()}`;
        this.datos = { name, imageRender };
        this.width = 0;
        this.height = 0;
        this.x = 0;
        this.y = 0;
        this.z = 0;
    }
}
// Principal
const body = document.querySelector('body')

// Personalizacion Item
// const PersonalizacionItems = data
const PersonalizacionItems = []

// Notificaciones
var colorNotificacionBuena = "linear-gradient(to right, #00b09b, #96c93d)"
var colorNotificacionMala = "linear-gradient(to right, #ff5f6d, #ff9800)"
var numeroNotificacion = 0;

// ExtraFunction
const btnReducir = document.querySelector('.btn-reducir')
const btnExpander = document.querySelector('.btn-expander')


// ContentEdit
const contentOptionsProduct = document.querySelector(".contenedor-opciones-producto")
const btnHeaderOpcionProducto = document.getElementById("btn-header-opcion-producto")

const contentOptionsPersonalize = document.querySelector(".contenedor-opciones-personalizacion")
const btnHeaderOpcionPersonalizado = document.getElementById("btn-header-opcion-personalizado")

// Colors
const contentColors = document.querySelector(".content-colors")
const colors = ["#fff", "#000", "#f44336", "#e91e63", "#9c27b0", "#673ab7",
    "#3f51b5", "#2196f3", "#03a9f4", "#00bcd4", "#009688", "#4caf50", "#8bc34a",
    "#cddc39", "#ffeb3b", "#ffc107", "#ff9800", "#ff5722", "#795548", "#607d8b"]
const colorActive = colors[0]

// Agregar Personalizacion
const btnAgregarPersonalizaciones = document.querySelector(".btn-agregar-personalizaciones")
const contenedorAgregarPersonalizaciones = document.querySelector(".conteiner-agregar-personalizaciones")
const btnCerrarConteinerPersonalizaciones = document.querySelector(".btn-cerrar-conteiner-personalizaciones")

// Agregar imagen
const inputAgregarFile = document.querySelector('#file-agregar-file')
const btnAgregarImagen = document.querySelector('.btn-agregar-imagen')
var imagenInteractiva = new ImagenInteractiva('.fondo-transparent', '.container-confirm-img-loader .img');
var imgloaded = ""
var imgloadedRender = ""
var nameImgloaded = ""
var addingImage = false


// Confirmar Imagen
const containerConfirmImgLoader = document.querySelector('.container-confirm-img-loader')
const contentImgLoader = document.querySelector('.container-confirm-img-loader .img')
const nameImgLoader = document.querySelector('.container-confirm-img-loader p')
const btnRechazarImagenLoader = document.querySelector('.btn-rechazar-imagen')
const btnAceptarImagenLoader = document.querySelector('.btn-aceptar-imgagen')


// ----------------------------------------------
// Three JS



const hdr = new URL('../assets/hdr/potsdamer_platz_1k-city.hdr', import.meta.url);
const shirt = new URL('../assets/models/shirt-optimize.glb', import.meta.url);

const contentEditorShirt = document.getElementById('content-editor');
const contentloader = document.getElementById('progress-bar-container');


const moduloThree = new ModuloThree(contentEditorShirt,contentloader); 
moduloThree.addModel(shirt,colorActive)
moduloThree.addEnviroment(hdr)











// ----------------------------------------------



//Render Imageloaded
function renderImage(file) {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.onload = () => resolve(fileReader.result);
        fileReader.readAsDataURL(file);
    })
}

btnRechazarImagenLoader.addEventListener('click', () => {
    containerConfirmImgLoader.classList.remove('active')
})

btnAceptarImagenLoader.addEventListener('click', () => {
    if (addingImage) {
        return
    }
    contentloader.style.setProperty('display', 'flex')
    addingImage = true
    var item = new ItemPersonalizadoImage(imgloaded.name, imgloadedRender)
    PersonalizacionItems.push(item);
    insertarPersonalizationItem(item)
    containerConfirmImgLoader.classList.remove('active')
    contenedorAgregarPersonalizaciones.classList.remove('active')
    addingImage = false
    
})

// confirmar Imagen
function confirmarImgLoader(image, funcion) {
    imagenInteractiva.restaurar()
    containerConfirmImgLoader.classList.add('active')
    nameImgLoader.innerText = imgloaded.name
    console.log(imgloaded)
    renderImage(imgloaded).then((result) => {
        imgloadedRender = result
        contentImgLoader.style.setProperty('background', `url(${imgloadedRender}) no-repeat center/contain`)
    })
    // Imagen interactiva
}

// Agregar Imagen
btnAgregarImagen.addEventListener('click', () => {
    inputAgregarFile.click()
})

inputAgregarFile.addEventListener('change', () => {
    imgloaded = inputAgregarFile.files[0]
    inputAgregarFile.value = null;
    if (imgloaded) {
        var tipoArchivo = imgloaded['type'];
        var tiposValidos = ['image/jpeg', 'image/png'];

        if (tiposValidos.indexOf(tipoArchivo) > -1) {
            // El archivo es una imagen
            var tamanoArchivo = imgloaded.size / 1024 / 1024; // Tamaño en MB

            if (tamanoArchivo > 2) {
                // El archivo es mayor a 2 MB
                Toastify({
                    text: "La imagen es mayor a 2 MB.",
                    duration: 4000,
                    close: 3 % 3 ? true : false,
                    style: {
                        background: colorNotificacionMala,
                    }
                }).showToast();

            } else {
                // El archivo es menor o igual a 2 MB
                confirmarImgLoader()
            }
        } else {
            // El archivo no es una imagen
            Toastify({
                text: "El archivo no es una imagen válida.",
                duration: 4000,
                close: 3 % 3 ? true : false,
                style: {
                    background: colorNotificacionMala,
                }
            }).showToast();
        }
    }
})


// Abirir y Cerrar Agregar Personalizaciones
btnAgregarPersonalizaciones.addEventListener('click', () => {
    contenedorAgregarPersonalizaciones.classList.add('active')
})

btnCerrarConteinerPersonalizaciones.addEventListener('click', () => {
    contenedorAgregarPersonalizaciones.classList.remove('active')
})

//Colors
function cambiarVariableCss(variable, valor) {
    document.documentElement.style.setProperty(variable, valor);
};

colors.forEach(element => {
    let button = document.createElement("button")
    button.style.setProperty("--btn-color", element)

    if (element == colorActive) {
        button.classList.add("active")
        cambiarVariableCss("--color-active", element)
    }

    button.classList.add("btn-color")
    button.addEventListener("click", () => {
        contentColors.childNodes.forEach((nodo) => {
            if (nodo.classList.contains("active")) {
                nodo.classList.remove("active")
            }
        })

        button.classList.add("active")
        moduloThree.changeColorModel(element)
        cambiarVariableCss("--color-active", element)
    })
    contentColors.appendChild(button)
});




// Funciones Estras

btnExpander.addEventListener('click', () => {
    body.classList.add('fullscreen')
})
btnReducir.addEventListener('click', () => {
    body.classList.remove('fullscreen')
})


// Funciones Content edit

btnHeaderOpcionProducto.addEventListener('click', () => {
    if (btnHeaderOpcionProducto.classList.contains('active')) {
        return
    } else {
        btnHeaderOpcionProducto.classList.add('active')
        contentOptionsProduct.classList.add('active')
        contentOptionsPersonalize.classList.remove('active')
        btnHeaderOpcionPersonalizado.classList.remove('active')
    }
})
btnHeaderOpcionPersonalizado.addEventListener('click', () => {
    if (btnHeaderOpcionPersonalizado.classList.contains('active')) {
        return
    } else {
        btnHeaderOpcionProducto.classList.remove('active')
        contentOptionsProduct.classList.remove('active')
        contentOptionsPersonalize.classList.add('active')
        btnHeaderOpcionPersonalizado.classList.add('active')
    }
})














// Personalizacion 
function editPersonalization(id) {
    const item = document.getElementById(id);
    item.remove();
}
function eliminarPersonalizacion(id) {
    const item = document.getElementById(id);
    item.remove();
}
function movePersonalization(id) {
    const item = document.getElementById(id);
    item.remove();
}

function insertarPersonalizationItem(item) {
    var itemId = item.id
    if (item.type === 'image') {
        var name = item.datos.name
        var imageRender = item.datos.imageRender
    }
    const itemDiv = document.createElement('div');
    itemDiv.classList.add('item-personalizacion', 'img', 'active');
    itemDiv.setAttribute('id', itemId);
    itemDiv.setAttribute("data-name", name);
    itemDiv.setAttribute("data-width", item.width);
    itemDiv.setAttribute("data-height", item.height);
    itemDiv.setAttribute("data-x", item.x);
    itemDiv.setAttribute("data-y", item.y);

    const datosDiv = document.createElement('div');
    datosDiv.classList.add('datos-item');

    const viewButton = createButton('btn-view');
    viewButton.addEventListener('click', () => {
        itemDiv.classList.toggle('active');
        itemDiv.classList.toggle('disable');
    })

    viewButton.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" class=" bi bi-eye-fill active"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-eye-slash disable"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" />
                                                <path
                                                    d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                                                <path
                                                    d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z" />
                                            </svg>
    `


    const img = document.createElement('img');
    img.classList.add('transparent');
    img.src = imageRender;
    img.alt = '';

    const title = document.createElement('p');
    title.classList.add('title');
    title.textContent = name;

    datosDiv.appendChild(viewButton);
    datosDiv.appendChild(img);
    datosDiv.appendChild(title);

    const btnsDiv = document.createElement('div');
    btnsDiv.classList.add('btns');

    const editButton = createButton('btn-edit');
    const deleteButton = createButton('btn-delete');
    const moveButton = createButton('btn-move');

    editButton.addEventListener('click', () => {
        editPersonalization(itemId);
    })
    deleteButton.addEventListener('click', () => {
        eliminarPersonalizacion(itemId);
    })
    moveButton.addEventListener('click', () => {
        movePersonalization(itemId);
    })
    

    editButton.innerHTML = `                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-pencil-square"
    viewBox="0 0 16 16">
    <path
        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
    <path fill-rule="evenodd"
        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
</svg>`

    deleteButton.innerHTML = `                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trash3-fill"
    viewBox="0 0 16 16">
    <path
        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
</svg>`

    moveButton.innerHTML = `
<svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-expand"
    viewBox="0 0 16 16">
    <path fill-rule="evenodd"
        d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708m0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708" />
</svg>`

    btnsDiv.appendChild(editButton);
    btnsDiv.appendChild(deleteButton);
    btnsDiv.appendChild(moveButton);

    itemDiv.appendChild(datosDiv);
    itemDiv.appendChild(btnsDiv);

    // Inserta itemDiv en el lugar deseado en tu página
    // Por ejemplo:
    document.querySelector(".content-personalizaciones .list-personalizaciones").appendChild(itemDiv);
    console.log(item);
    console.log(imgloaded);
    setTimeout(() => {
        moduloThree.createDecal(imageRender,item.id);
    }, 2000);
}

function createButton(className) {
    const button = document.createElement('button');
    button.classList.add(className, "btn-item-personalizacion");
    return button;
}

for (let index = 0; index < PersonalizacionItems.length; index++) {
    insertarPersonalizationItem(PersonalizacionItems[index]);   
}


