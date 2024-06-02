import { ModalSelectItems } from "./optionsEdit.js"
import { EditPosition } from './editPosition.js'

export class ItemsPersonalizaciones {
    constructor(contentPersonalizaciones, customDisign, contentAgregarPersonalizaciones, moduloThree) {

        this.moduloThree = moduloThree

        this.editPosition = new EditPosition(this.agregarPersonalization.bind(this), this.editPersonalization.bind(this))

        this.modalAgregarPersonalizaciones = new ModalSelectItems(contentAgregarPersonalizaciones, this.agregarPersonalizations.bind(this))

        this.personalizaciones = customDisign.personalizaciones
        this.contentPersonalizaciones = contentPersonalizaciones

        this.listaPersonalizaciones = document.createElement('div')
        this.listaPersonalizaciones.classList.add('list-personalizaciones')
        this.contentPersonalizaciones.appendChild(this.listaPersonalizaciones)

        this.btnAgregarPersonalizaciones = document.createElement('button')
        this.btnAgregarPersonalizaciones.classList.add('btn-agregar-personalizaciones')
        this.btnAgregarPersonalizaciones.innerText = 'Agregar personalizaciones'
        this.btnAgregarPersonalizaciones.addEventListener('click', () => {
            this.modalAgregarPersonalizaciones.active()
        })

        this.contentPersonalizaciones.appendChild(this.btnAgregarPersonalizaciones)
        this.colocarItems()
    }

    colocarItems() {
        this.listaPersonalizaciones.innerHTML = ""
        this.moduloThree.deleteAllDecals()

        if (this.personalizaciones.length == 0) {
            this.listaPersonalizaciones.innerHTML = ""
            this.contentPersonalizaciones.classList.add('no-personalizaciones')
        } else {
            this.contentPersonalizaciones.classList.remove('no-personalizaciones')
            for (let index = 0; index < this.personalizaciones.length; index++) {
                const nodeItem = this.createNodeItem(this.personalizaciones[index])
                this.listaPersonalizaciones.appendChild(nodeItem)

                // Crear Decals
                let indexDecal = this.personalizaciones.length - index
                this.moduloThree.createDecal(this.personalizaciones[index], indexDecal)
            }
        }
    }
    createNodeItem(item) {
        var itemId = item.id
        var name = item.name
        var hidden = item.hidden
        var urlImg = item.urlImg
        var position = item.position
        var size = item.size
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('item-personalizacion', 'img', 'active');
        itemDiv.setAttribute('id', itemId);
        itemDiv.setAttribute('data-url', item.urlImg);
        itemDiv.setAttribute("data-name", name);
        itemDiv.setAttribute("data-size", item.size.toString());
        itemDiv.setAttribute("data-x", item.position[0].toString());
        itemDiv.setAttribute("data-y", item.position[1].toString());

        const datosDiv = document.createElement('div');
        datosDiv.classList.add('datos-item');

        const viewButton = this.createButton('btn-view');

        viewButton.addEventListener('click', (e) => {
            this.toggleViewPersonalizacion(itemId, itemDiv)
        })
        // lo oculta si esta configurado asi
        if (hidden) {
            itemDiv.classList.toggle('active');
            itemDiv.classList.toggle('disable');
        }

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

        const title = document.createElement('input');
        title.classList.add('title');
        title.value = name;

        const img = document.createElement('img');

        if (item.type === 'image') {
            var preview = item.urlImg
            img.classList.add('transparent');
            img.src = preview;
            img.alt = '';
        } else if (item.type === 'text') {
            img.src = preview;
            img.alt = '';
        }

        datosDiv.appendChild(viewButton);
        datosDiv.appendChild(img);
        datosDiv.appendChild(title);

        const btnsDiv = document.createElement('div');
        btnsDiv.classList.add('btns');

        const editButton = this.createButton('btn-edit');
        const deleteButton = this.createButton('btn-delete');
        const upButton = this.createButton('btn-up');
        const downButton = this.createButton('btn-down');

        editButton.addEventListener('click', () => {
            this.editarPosicion(
                {
                    itemId,
                    urlImg,
                    position,
                    name,
                    size
                }
            );
        })
        deleteButton.addEventListener('click', () => {
            this.eliminarPersonalizacion(itemId);
        })
        upButton.addEventListener('click', () => {
            this.moveUpPersonalization(itemId);
        })
        downButton.addEventListener('click', () => {
            this.moveDownPersonalization(itemId);
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

        upButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
        </svg>`
        downButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
        </svg>`

        btnsDiv.appendChild(upButton);
        btnsDiv.appendChild(downButton);
        btnsDiv.appendChild(editButton);
        btnsDiv.appendChild(deleteButton);

        itemDiv.appendChild(datosDiv);
        itemDiv.appendChild(btnsDiv);

        // Inserta itemDiv en el lugar deseado en tu página
        // Por ejemplo:
        // document.querySelector(".content-personalizaciones .list-personalizaciones").appendChild(itemDiv);
        return itemDiv;
        setTimeout(() => {
            moduloThree.createDecal(preview, item.id);
        }, 2000);
    }
    createButton(className) {
        const button = document.createElement('button');
        button.classList.add(className, "btn-item-personalizacion");
        return button;
    }

    toggleViewPersonalizacion(idItem, itemDiv) {
        let indexItem = this.buscarIndexPersonalizaciones(idItem)
        itemDiv.classList.toggle('active');
        itemDiv.classList.toggle('disable');
        this.moduloThree.changeVisibility(idItem)
        if (this.personalizaciones[indexItem].hidden) {
            this.personalizaciones[indexItem].hidden = false
        } else {
            this.personalizaciones[indexItem].hidden = true

        }
    }
    eliminarPersonalizacion(idItem) {
        let indexItem = this.buscarIndexPersonalizaciones(idItem)
        this.personalizaciones.splice(indexItem, 1)
        this.moduloThree.deleteDecal(idItem)
        this.colocarItems()
    }
    moveUpPersonalization(idItem) {
        let indexItem = this.buscarIndexPersonalizaciones(idItem)
        if (indexItem == 0) return
        let item = this.personalizaciones[indexItem]
        this.personalizaciones.splice(indexItem, 1)
        this.personalizaciones.splice(indexItem - 1, 0, item)
        this.colocarItems()
    }
    moveDownPersonalization(idItem) {
        let indexItem = this.buscarIndexPersonalizaciones(idItem)
        if (indexItem == this.personalizaciones.length - 1) return
        let item = this.personalizaciones[indexItem]
        this.personalizaciones.splice(indexItem + 2, 0, item)
        this.personalizaciones.splice(indexItem, 1)
        this.colocarItems()
    }
    
    editarPosicion(imagenLoad) {
        var id = imagenLoad.itemId
        var name = imagenLoad.name
        var url = imagenLoad.urlImg
        var size = imagenLoad.size
        var position = imagenLoad.position
        this.editPosition.mode = 'edit'
        this.editPosition.cargarImg(url, name, id, size, position)
    }
    agregarPersonalization(Item) {
        this.personalizaciones.splice(0, 0, Item)
        this.colocarItems()
        document.querySelector('.conteiner-agregar-personalizaciones').classList.remove("active")
    }
    
    editPersonalization(item) {
        let indexItem = this.buscarIndexPersonalizaciones(item.id)
        this.personalizaciones.splice(indexItem, 1, item)
        this.colocarItems()
        document.querySelector('.conteiner-agregar-personalizaciones').classList.remove("active")
    }

    buscarIndexPersonalizaciones(idItem) {
        let indexItem;
        this.personalizaciones.forEach((element, index) => {
            if (element.id == idItem) {
                indexItem = index
            }
        })
        return indexItem
    }

    agregarPersonalizations(imagenLoad) {
        var name = imagenLoad.nameImg
        var url = imagenLoad.urlImg
        this.editPosition.modo = 'add'
        this.editPosition.cargarImg(url, name)
    }

    cambiarTamañoPersonalizacion(idItem, size) {

        let indexItem = this.buscarIndexPersonalizaciones(idItem)
        this.personalizaciones[indexItem].size = size
    }
}
