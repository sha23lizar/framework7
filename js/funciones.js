const header = document.getElementById('header');
let scrolled = false;
            
// Función para mostrar u ocultar el header en función del tamaño de la ventana
const toggleHeader = () => {
    if (window.innerWidth < 1250 || window.scrollY > 50) {
        if (!scrolled) {
            header.classList.add('header-scrolled');
            scrolled = true;
        }
    } else {
        if (scrolled) {
            header.classList.remove('header-scrolled');
            scrolled = false;
        }
    }
};

window.addEventListener('scroll', toggleHeader);
window.addEventListener('resize', toggleHeader);

// Muestra el header al pasar el mouse por encima
header.addEventListener('mouseenter', () => {
    if (window.innerWidth >= 950) {
        header.classList.add('header-scrolled');
    }
});

// Oculta el header al quitar el mouse
header.addEventListener('mouseleave', () => {
    if (!scrolled) {
        header.classList.remove('header-scrolled');
    }
});

// Llama a la función inicialmente para ajustar el estado del header
toggleHeader();


let indice = 0; // Comenzamos desde 0 para que la primera imagen se muestre automáticamente
muestraSlides();

function avanzaSlide(n) {
    muestraSlides(indice += n);
}

function posicionSlide(n) {
    muestraSlides(indice = n);
}

setInterval(function tiempo() {
    muestraSlides(indice += 1);
}, 5000);

function muestraSlides() {
    let i;
    let slides = document.getElementsByClassName('miSlider');
    let barras = document.getElementsByClassName('barra');

    if (indice >= slides.length) {
        indice = 0; // Vuelve al principio si llega al final
    }
    if (indice < 0) {
        indice = slides.length - 1; // Muestra la última imagen si retrocedes desde la primera
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none'; // Oculta todos los slides
        barras[i].className = barras[i].className.replace(" active", "");
    }

    slides[indice].style.display = 'block'; // Muestra el slide actual
    barras[indice].className += ' active';
}
