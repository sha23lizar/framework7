
export const Models = [
    {
        id: "1",
        nombre: "Camisa Prototipo",
        url: "../assets/models/shirt-optimize.glb",
        colors: ["#fff", "#000", "#f44336", "#e91e63", "#9c27b0", "#673ab7",
        "#3f51b5", "#2196f3", "#03a9f4", "#00bcd4", "#009688", "#4caf50", "#8bc34a",
        "#cddc39", "#ffeb3b", "#ffc107", "#ff9800", "#ff5722", "#795548", "#607d8b"],
        imgPreview: "../assets/models/shirt-optimize.png",
        configuration: {
            maxPositionCamera: [0, 0.15, 0.3],
            minPositionCamera: [0, 0.15, 0.3],
            rotationCamera: [-0.17, 0, 0],
            decalPosition: [0, 0.05, 0.01],
            decalRotation: [0, 0, 0],
            decalSizeZ: [1],
        },
        environment:{
            hdr: "../assets/hdr/potsdamer_platz_1k-city.hdr",
            exposure: 0.7,
            ambienLightIntensiti: 0.5,
            ambienLightColor: 0xFFFFFF
        }
    }
]

export const disign = [{
    id:"1",
    model: "1",
    name: "Camisa Prueba",
    color: "#fff",
    customizations:[{
        id:"decal-14943",
        type: "image",
        name:"logo sion.png",
        urlImg: "../assets/img/logo_sion.png",
        position: [0, 0.05, 0.01],
        size: [0.1, 0.1, 1],
    }]

}]

