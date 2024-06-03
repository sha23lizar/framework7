import * as THREE from 'three'; // Importa todo desde Three.js
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { RGBELoader } from 'three/addons/loaders/RGBELoader.js';
import { DecalGeometry } from 'three/addons/geometries/DecalGeometry.js';
import { KTX2Loader } from 'three/addons/loaders/KTX2Loader.js';


export class ModuloThree {
    constructor(content, db, loader) {

        this.content = content
        this.environment = db.environment
        this.decal = db.decal
        this.cameraConfig = db.camera
        this.modelConfig = db.model
        this.colors = db.colors
        this.model = null

        // Renderer Canvas
        this.renderer = new THREE.WebGLRenderer({
            antialias: true,
            preserveDrawingBuffer: true,
        });
        this.scene = new THREE.Scene();

        // content Cavas
        this.contentWidth = content.offsetWidth;
        this.contentHeight = content.offsetHeight;
        this.renderer.setSize(this.contentWidth, this.contentHeight);
        content.appendChild(this.renderer.domElement);

        // Loading Manager
        this.loadignManager = new THREE.LoadingManager();

        // Loaders
        this.loaderTexture = new THREE.TextureLoader(this.loadignManager);
        this.loaderGLTF = new GLTFLoader(this.loadignManager);
        this.loaderHDR = new RGBELoader(this.loadignManager);

        if (loader) {
            this.loadignManager.onStart = (url, itemsLoaded, itemsTotal) => {
                // alert('this.loadignManager.onLoad');
                loader.show()
            }
            this.loadignManager.onProgress = (url, itemsLoaded, itemsTotal) => {
                loader.progress(itemsLoaded / itemsTotal * 100)
                // console.log(itemsLoaded, itemsTotal);
                // console.log(url);
            }
            this.loadignManager.onLoad = (url, itemsLoaded, itemsTotal) => {
                loader.hide()
            }
        } else alert("no load")

        // Camara
        this.camera = new THREE.PerspectiveCamera(
            75,
            this.contentWidth / this.contentHeight,
            0.1, 1000);
        this.camera.position.set(
            this.cameraConfig.position[0],
            this.cameraConfig.position[1],
            this.cameraConfig.position[2]
        );
        this.camera.rotation.set(
            this.cameraConfig.rotation[0],
            this.cameraConfig.rotation[1],
            this.cameraConfig.rotation[2]
        );


        // Lights
        const ambientLight = new THREE.AmbientLight(
            this.environment.ambientColor,
            this.environment.ambientIntensity);
        this.scene.add(ambientLight);

        // Color de fondo
        this.renderer.setClearColor(0x000000, 0);

        // Enviroment
        const hdr = new URL(this.environment.hdr, import.meta.url);

        this.loaderHDR.load(hdr.href, (texture) => {
            texture.mapping = THREE.EquirectangularReflectionMapping;
            this.scene.environment = texture;
        })

        //Configuracion HDRI
        this.renderer.outputEncoding = THREE.sRGBEncoding;
        this.renderer.toneMapping = THREE.ACESFilmicToneMapping;
        this.renderer.toneMappingExposure = this.environment.exposure;


        // Modelo
        // const glb = new URL(this.modelConfig.gltf, import.meta.url);
        // this.loaderGLTF.load(glb.href, (gltf) => {
        //     this.model = gltf.scene.children[0];
        //     this.model.position.set(
        //         this.modelConfig.position[0],
        //         this.modelConfig.position[1],
        //         this.modelConfig.position[2]
        //     );
        //     this.model.material.color.set(this.colors[0]);
        //     this.scene.add(this.model);
        // })

        // Evento cuando cambio de tamaño
        this.resizeObserver = new ResizeObserver(entries => {
            for (let entry of entries) {
                // console.log('El tamaño del elemento ha cambiado:', entry.target);
                this.renderer.setSize(entry.contentRect.width, entry.contentRect.height);
            }
        });
        this.resizeObserver.observe(content);



        // Evento Mause
        this.mousePosition = new THREE.Vector2();
        this.rayCaster = new THREE.Raycaster();
        this.mousePosition.x = -1;
        this.mousePosition.y = -1;
        this.mouseX = 0;
        this.mouseY = 0;
        this.isMouseDown = false;
        this.decalSection = null;
        content.addEventListener('mousemove', (event) => {
            this.mousePosition.x = (event.clientX / content.offsetWidth) * 2 - 1;
            this.mousePosition.y = -(event.clientY / content.offsetHeight) * 2 + 1;
            if (this.isMouseDown) {
                var dx = this.mousePosition.x - this.mouseX;
                var dy = this.mousePosition.y - this.mouseY;
                if (this.decalSection) {
                    this.decalSection.material.map.offset.x += dx / -30;
                    this.decalSection.material.map.offset.y += dy / -30;
                    // console.log(this.mousePosition)
                }

                // Mostrar el botón de restauración cuando se mueve la imagen
                // this.btn.style.display = 'block';
            }
            // console.log(this.mousePosition.x, this.mousePosition.y)
        })
        // content.addEventListener('mousedown', (e) => this.handleMouseDown(e));
        // this.content.addEventListener('mouseup', (e) => this.handleMouseUp(e));
        // this.content.addEventListener('mousemove', (e) => this.handleMouseMove(e));
        // this.content.addEventListener('wheel', (e) => this.handleWheel(e));

        // render y loop
        this.renderer.render(this.scene, this.camera);
        this.renderer.setAnimationLoop(() => {
            // this.rayCaster.setFromCamera(this.mousePosition, this.camera);
            // const intersects = this.rayCaster.intersectObjects(this.scene.children);
            // // console.log(intersects)
            // if (this.isMouseDown) {   
            //     for (let index = 0; index < intersects.length; index++) {
            //         // console.log(intersects[index].object.name)
            //         if (intersects[index].object.name.includes("item")) {
            //             this.decalSection = intersects[index].object;
            //             // console.log(intersects[index].object)
            //             console.log(this.decalSection.material.map.offset.x)
            //             console.log(this.decalSection.material.map.offset.y)
            //             // intersects[index].object.material.color.set(0x00ff00);
            //         }    
            //     }
            // }
            this.renderer.render(this.scene, this.camera);
        });
        // --------------------------------------------
    }

    addEnviroment(hdr, exposure) {

    }

    addModel(glb, color) {
        // this.loaderGLTF.load(glb.href, (gltf) => {
        //     this.model = gltf.scene.children[0];
        //     this.model.position.set(0, 0, 0);
        //     this.model.material.color.set(color);
        //     this.scene.add(this.model);
        // })
    }

    changeColorModel(color) {
        this.model.material.color.set(color);
    }
    getColor(){
        let decimalNumber = this.model.material.color.getHex();
        let hexadecimalNumber = decimalNumber.toString(16);
        return hexadecimalNumber
    }

    async createDecal(customizations, zIndex) {
        // TEXTURA
        const texture = await this.loaderTextureAsync(customizations.urlImg);
        const decalMaterial = new THREE.MeshStandardMaterial({
            map: texture,
            depthTest: true,
            depthWrite: false,
            polygonOffset: true,
            polygonOffsetFactor: - 4,
            transparent: true
        });

        // GEOMETRY
        // Decal size
        const aproximacionSize = 1600
        const w = texture.image.width
        const h = texture.image.height
        const maximo = Math.max(w, h);
        const x = (w * customizations.size) * 0.00015;
        const y = (h * customizations.size) * 0.00015;
        const size = new THREE.Vector3(x, y, 1);

        // Decal position 
        const position = new THREE.Vector3(
            customizations.position[0],
            customizations.position[1], 0
        )
        const decalGeometry = new DecalGeometry(
            this.model,
            position,
            [0, 0, 0],
            size
        )

        // MESH
        const decal = new THREE.Mesh(decalGeometry, decalMaterial);
        decal.position.set(
            this.decal.position[0],
            this.decal.position[1],
            this.decal.position[2] * zIndex
        );
        decal.name = customizations.id;

        // lo oculta si esta configurado asi
        if (customizations.hidden) {
            decal.material.opacity = 0;
        }

        this.scene.add(decal);


    }

    async loaderTextureAsync(url) {
        return new Promise((resolve, reject) => {
            this.loaderTexture.load(url, resolve, undefined, reject);
        });
    }

    deleteDecal(name) {
        this.scene.remove(this.buscarDecal(name));
    }

    deleteAllDecals() {
        
        let decals = this.scene.children.filter((element) => element.name.includes("decal-"))
        decals.forEach((element) => {
            this.scene.remove(element)
        })
        this.renderer.render(this.scene, this.camera);
    }

    changeVisibility(name) {
        let decal = this.buscarDecal(name)
        if (decal.material.opacity == 0) {
            decal.material.opacity = 1;
        } else {
            decal.material.opacity = 0;
        }
    }


    buscarDecal(name) {
        let decal
        this.scene.children.forEach((element) => {
            if (element.name == name) {
                decal = element
            }
        })
        return decal
    }

    async loadModel() {
        const glb = new URL(this.modelConfig.gltf, import.meta.url);
        let gltf = await this.loaderGLTF.loadAsync(glb.href)
        this.model = gltf.scene.children[0];
        this.model.position.set(
            this.modelConfig.position[0],
            this.modelConfig.position[1],
            this.modelConfig.position[2]
        );

        this.model.material.color.set(this.colors[0]);
        this.scene.add(this.model);
        return
    }

    //// Eventos Mouses
    handleMouseDown(e) {
        this.mouseX = (e.clientX / this.content.offsetWidth) * 2 - 1;
        this.mouseY = -(e.clientY / this.content.offsetHeight) * 2 + 1;
        this.isMouseDown = true;
    }

    handleMouseUp(e) {
        this.isMouseDown = false;
    }

    handleMouseMove(e) {
        if (this.isMouseDown) {
            var dx = e.clientX - this.mouseX;
            var dy = e.clientY - this.mouseY;

            this.decalPositionx += dx;
            this.decalPositiony += dy;

            this.img.style.left = this.imgX + 'px';
            this.img.style.top = this.imgY + 'px';

            this.mouseX = e.clientX;
            this.mouseY = e.clientY;

            // Mostrar el botón de restauración cuando se mueve la imagen
            this.btn.style.display = 'block';
        }
    }

    // handleWheel(e) {
    //     var scale = e.deltaY < 0 ? 1.1 : 0.9;

    //     var rect = this.img.getBoundingClientRect();
    //     var dx = (e.clientX - rect.left) * (scale - 1);
    //     var dy = (e.clientY - rect.top) * (scale - 1);

    //     this.imgX -= dx;
    //     this.imgY -= dy;

    //     this.img.style.left = this.imgX + 'px';
    //     this.img.style.top = this.imgY + 'px';

    //     this.img.style.width = (this.img.offsetWidth * scale) + 'px';
    //     this.img.style.height = (this.img.offsetHeight * scale) + 'px';

    //     // Mostrar el botón de restauración cuando se escala la imagen
    //     this.btn.style.display = 'block';
    // }

    restaurarEventMouse() {
        this.mouseX = 0;
        this.mouseY = 0;
        this.imgX = 0;
        this.imgY = 0;
        this.isMouseDown = false;
        this.img.style.width = "";
        this.img.style.height = "";
        this.img.style.left = "0px";
        this.img.style.top = "0px";

        // Ocultar el botón de restauración cuando se restaura la imagen
        this.btn.style.display = 'none';
    }

    download(name) {
        var imgData = this.renderer.domElement.toDataURL();
        var img = new Image();
        img.src = imgData;
        // To download the image
        var link = document.createElement('a');
        link.download = name + '.png';
        link.href = imgData;
        link.click();
    }
    getImgData() {
        var imgData = this.renderer.domElement.toDataURL();
        return imgData;
    }
    
    getPreview() {
        var imgData = this.renderer.domElement.toDataURL();
        return imgData;
    }

}
