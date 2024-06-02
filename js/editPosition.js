export class EditPosition {
    constructor(agregarPersonalization, editPersonalization) {

        this.agregarPersonalization = agregarPersonalization
        this.editPersonalization = editPersonalization
        // es una escala referente para que este de acorde al modelo
        this.scaleModel = 0.09;
        // min y max del model
        this.positionModelX = [-0.267, 0.267];
        this.positionModelY = [-0.345, 0.25];

        

        this.id = ""
        this.div = ""
        this.img = ""
        this.size = 0;
        this.nameImg = "";
        this.urlImg = "";
        this.position = [0, 0];
        this.positionX = "";
        this.positionY = "";
        this.mode = "add"

        this.container = document.querySelector(".container-edit-position")
        this.imgModel = this.container.querySelector('.img-model')
        this.numberSize = document.getElementById('numberSize');
        this.inputTamaño = document.getElementById('input-tamaño');
        this.numberSize.innerHTML = this.inputTamaño.value;
        this.contentImgs = this.container.querySelector(".img-edit-position")


        this.inputTamaño.addEventListener('input', (event) => {
            this.setSize(event.target.value / 100)
        });

        this.container.querySelector(".btn-cerrar-modal")
            .addEventListener('click', () => { this.toggle() })

        this.container.querySelector(".btn-cancelar")
            .addEventListener('click', () => { this.toggle() })
        this.container.querySelector(".btn-aplicar")
            .addEventListener('click', () => {
                this.getCoords()
                var item = {
                    "id": this.id,
                    "type": "image",
                    "name": this.nameImg,
                    "urlImg": this.urlImg,
                    "size": this.size,
                    "position": [this.positionX, this.positionY],
                    "hidden": false
                }
                
                if (this.mode == "edit") {
                    this.mode = "add"
                    this.editPersonalization(item)
                } else if (this.mode == "add") {
                    this.agregarPersonalization(item)
                }
                this.toggle()

            })

        /// mover img
        const card = this.contentImgs
        let newX = 0, newY = 0, startX = 0, startY = 0;

        card.addEventListener('mousedown', mouseDown)


        function mouseDown(e) {
            startX = e.clientX
            startY = e.clientY

            document.addEventListener('mousemove', mouseMove)
            document.addEventListener('mouseup', mouseUp)
        }

        function mouseMove(e) {
            newX = startX - e.clientX
            newY = startY - e.clientY

            startX = e.clientX
            startY = e.clientY

            card.style.top = (card.offsetTop - newY) + 'px'
            card.style.left = (card.offsetLeft - newX) + 'px'
        }

        function mouseUp(e) {
            document.removeEventListener('mousemove', mouseMove)
        }
        document.addEventListener('mousemove', () => {
            this.getCoords()
        })
    }
    toggle() {
        this.container.classList.toggle('active')
    }
    cargarImg(url, name, id, size, position) {
        this.toggle()
        this.restaurar()
        this.position = position?position:[0,0];
        this.id = id?id:`decal-${Date.now()}`
        this.urlImg = url
        this.nameImg = name
        this.img = document.createElement('img')
        this.img.src = this.urlImg
        this.img.classList.add('img-edit-position')
        this.img.addEventListener('load', () => {
            this.contentImgs.appendChild(this.img)
            this.div = document.createElement('div')
            this.div.classList.add('point-tr')
            this.contentImgs.appendChild(this.div)
            this.img.setAttribute("data-width", this.img.offsetWidth)
            this.img.setAttribute("data-height", this.img.offsetHeight)
            this.setSize(size)
            this.setPosition()
        })
    }

    setPosition() {
        let x = this.reversarValor('x', this.position[0])
        let y = this.reversarValor('y', this.position[1])
        let heightModel = this.imgModel.offsetHeight;
        let widthModel = this.imgModel.offsetWidth;
        let heightImg = this.img.offsetHeight;
        let widthImg = this.img.offsetWidth;

        let left = (x / 100) * widthModel - (widthImg / 2);
        let top = heightModel - (y / 100) * heightModel - (heightImg / 2);

        this.contentImgs.style.left = `${left}px`;
        this.contentImgs.style.top = `${top}px`;

    }
    setSize(size) {
        if (size) {
            this.size = size
        } else {
            this.size = 0.50
        }
        this.tamañoImg = this.size * this.scaleModel

        this.img.width = this.img.getAttribute("data-width") * this.tamañoImg
        this.img.height = this.img.getAttribute("data-height") * this.tamañoImg
        // this.img.style.transform =`translate(${-(this.size - 0.5) * 25}%, ${-(this.size - 0.5) * 25}%)`

        this.inputTamaño.value = this.size * 100
        this.numberSize.innerHTML = this.inputTamaño.value;
        this.getCoords()
    }
    setFondo(url) {
        this.urlImg = url
        this.imgModel.src = this.urlImg

    }
    getCoords() {
        let heightModel = this.imgModel.offsetHeight;
        let widthModel = this.imgModel.offsetWidth;
        let heightImg = this.img.offsetHeight;
        let widthImg = this.img.offsetWidth;

        let left = parseFloat(this.contentImgs.style.left.replaceAll("px", "")) + (widthImg / 2);
        let top = parseFloat(this.contentImgs.style.top.replaceAll("px", "")) + (heightImg / 2);
        // let mitadWidth = this.img.offsetWidth / 2
        // let mitadHeight = this.img.offsetHeight / 2

        this.positionX = left / widthModel * 100;
        this.positionY = 100 - (top / heightModel * 100);
        this.positionX = this.calcularValor('x', this.positionX)
        this.positionY = this.calcularValor('y', this.positionY)
        // console.log("X:" , this.positionX)
    }

    calcularValor(mode, porcentaje) {
        let minimo;
        let maximo;
        if (mode == 'x') {
            minimo = this.positionModelX[0];
            maximo = this.positionModelX[1];
        } else if (mode == 'y') {
            minimo = this.positionModelY[0];
            maximo = this.positionModelY[1];
        }
        let rango = maximo - minimo;
        let valor = minimo + (rango * porcentaje / 100);
        return valor;
    }
    reversarValor(mode,result ) {
        let minimoMaximo = mode === 'x' ? this.positionModelX : this.positionModelY;
        let minimo = minimoMaximo[0];
        let maximo = minimoMaximo[1];
        let rango = maximo - minimo;
        let porcentaje = (result - minimo) / rango * 100;
        return porcentaje;
    }

    restaurar() {
        this.contentImgs.innerHTML = ""
        this.mouseX = 0;
        this.mouseY = 0;
        this.imgX = 0;
        this.imgY = 0;
        this.isMouseDown = false;
        this.contentImgs.style.left = "";
        this.contentImgs.style.top = "";

        // Ocultar el botón de restauración cuando se restaura la imagen
        // this.btn.style.display = 'none';
    }

}

