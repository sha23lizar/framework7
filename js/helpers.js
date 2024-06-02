export function renderImage(file) {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.onload = () => resolve(fileReader.result);
        fileReader.readAsDataURL(file);
    })
}

export class ImagenInteractiva {
    constructor(divId, imgId) {
        this.div = document.querySelector(divId);
        this.img = document.querySelector(imgId);
        this.mouseX = 0;
        this.mouseY = 0;
        this.imgX = 0;
        this.imgY = 0;
        this.isMouseDown = false;

        this.div.addEventListener('mousedown', (e) => this.handleMouseDown(e));
        this.div.addEventListener('mouseup', (e) => this.handleMouseUp(e));
        this.img.addEventListener('mousemove', (e) => this.handleMouseMove(e));
        this.img.addEventListener('wheel', (e) => this.handleWheel(e));

          // Verificar si ya existe un botón en el div
          this.btn = this.div.querySelector('button');

          // Si no existe, crear uno nuevo
          if (!this.btn) {
              // Crear el botón de restauración y agregarlo al div
              this.btn = document.createElement('button');
              this.btn.style.position = 'absolute';
              this.btn.style.top = '5px';
              this.btn.style.right = '5px';
              this.btn.style.display = 'none'; // inicialmente oculto
              this.btn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                </svg>`;
              this.btn.classList.add('btn-restaurar-cambios');
              this.btn.addEventListener('click', () => this.restaurar());
              this.div.appendChild(this.btn);
          }
    }

    handleMouseDown(e) {
        this.mouseX = e.clientX;
        this.mouseY = e.clientY;
        this.isMouseDown = true;
    }

    handleMouseUp(e) {
        this.isMouseDown = false;
    }

    handleMouseMove(e) {
        if (this.isMouseDown) {
            var dx = e.clientX - this.mouseX;
            var dy = e.clientY - this.mouseY;
            // console.log("antes:"+dx, dy);
            this.imgX += dx;
            this.imgY += dy;

            this.img.style.left = this.imgX + 'px';
            this.img.style.top = this.imgY + 'px';

            this.mouseX = e.clientX;
            this.mouseY = e.clientY;
            // console.log("mause:"+this.mouseX, this.mouseY);

            // Mostrar el botón de restauración cuando se mueve la imagen
            this.btn.style.display = 'block';
            // console.log("despues:"+this.imgX, this.imgY);
        }
    }

    handleWheel(e) {
        var scale = e.deltaY < 0 ? 1.1 : 0.9;
        
        var rect = this.img.getBoundingClientRect();
        var dx = (e.clientX - rect.left) * (scale - 1);
        var dy = (e.clientY - rect.top) * (scale - 1);

        this.imgX -= dx;
        this.imgY -= dy;
        
        this.img.style.left = this.imgX + 'px';
        this.img.style.top = this.imgY + 'px';

        this.img.style.width = (this.img.offsetWidth * scale) + 'px';
        this.img.style.height = (this.img.offsetHeight * scale) + 'px';

        // Mostrar el botón de restauración cuando se escala la imagen
        this.btn.style.display = 'block';
    }

    restaurar() {
        this.mouseX = 0;
        this.mouseY = 0;
        this.imgX = 0;
        this.imgY = 0;
        this.isMouseDown = false;
        this.img.style.width = "";
        this.img.style.height = "";
        this.img.style.left = "";
        this.img.style.top = "";

        // Ocultar el botón de restauración cuando se restaura la imagen
        this.btn.style.display = 'none';
    }
}