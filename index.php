<?php


session_start();
session_unset();
session_destroy();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/estilos.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- Font Awesome CDN-->
    <link
      rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet"/>
    <!-- Stylesheet -->
</head>
<style>
.img-cover {
    display: flex;
    height: auto;
    width: 100%;
    border-radius: 10px;
    margin: 1em 20px;
    padding-top: 4em;
}

.section-about {
padding: 4% 10%;

}

.section-about-2 {
    border-radius: 10px;
}

.about-us {
width: 100%;
height: 80vh;
background-color: rgba(249, 177, 69, 0.749);
display: grid;
grid-template-columns: repeat(2,1fr);
gap: 4rem;
margin: auto;

padding: 45px;
border-radius: 10px;
margin-top: -40px;
}

.main-img img {
max-width: 100%;
width: 400px;
height: auto;
}

.text {
padding: 6% 0;
}

.text h4 {
color: rgb(0, 0, 0);
font-size: 16px;
font-weight: 600;
text-transform: uppercase;
margin-bottom: 10px;
}

.text h1 {
color: rgb(0, 0, 0);
font-size: 36px;
text-transform: capitalize;
font-weight: 700;
line-height: 46px;
margin-bottom: 30px;
}

hr {
width: 30%;
border: none;
height: 2px;
background-color: red;
margin-bottom: 50px;
}

.text p {
max-width: 600px;
color: black;
font-size: 15px;
font-weight: 400;
line-height: 1.7;
margin-bottom: 60px;
}


form {
    
    font-family: 'Roboto Condensed', sans-serif;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
    
}

form {
    
    height: auto;
    background-color: black;
    position: relative;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
    padding: 50px 35px;
    z-index: 1;
    margin: auto;
    justify-content: center;

}


form h3 {
    
    margin-left: 10em;
    font-size: 32px;
    font-weight: 400;
    line-height: 5px;
    text-align: center;
    
}

form h2 {
    
    font-size: 32px;
    font-weight: 400;
    text-align: center;
    margin-top: 10px;
}


@media(max-width:1385px) {
  .section-about {
      padding: 4% 4%;
      transition: .3s;
  }

  .main-img img {
      width: 500px;
      height: auto;
      transition: .3s;
  }
}

@media(max-width:1240px) {
  .text h1 {
      font-size: 30px;
      transition: .3s;
  }
}

@media(max-width:1040px) {
  .about-us {
      grid-template-columns: repeat(1, 1fr);
      height: auto;
      padding: 40px;
  }
}

</style>
<body>
    
    <header>

        <div class="container__header">	

            <div class="logo">
                <img src="./imagenes/fotos/3-removebg-preview.png" alt="">
            </div>

            <div class="menu">
                <nav>
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href=".\camisa\index.php">Diseñar camiseta</a></li>
                        <li><a href="#" style="color: transparent;">Productos</a></li>
                        <li><a href="#" style="color: transparent;">Nosotros</a></li>
                        <li><a href="#Contacto" style="color: transparent;">Contacto</a></li>
                    </ul>
                </nav>
            </div>
            <i class="fa-solid fa-bars" id="icon_menu"></i>
            <div class="header__register">
                <a href="./Sign-up/index.php" class="link"><img src="./imagenes/fotos/usuario.png" alt="" class="icon" style="display:none;"></a>
                <input type="button" class="btn__header-register" onclick="redireccionar2()" style="font-weight: bold; color:black; border:solid 1px black; background:transparent;"  value="Iniciar sesion">
                <input type="button" class="btn__header-register" onclick="redireccionar()" style="font-weight: bold;" value="Registrarse">
            </div>
        </div>

    </header>

    <main>

        <div class="cover">

            <div class="text__information-cover">
                <p class="h1">Bienvenido a Shalom Creative Design</p>

                <p>Transformando la ropa personalizada en una experiencia inolvidable. No sólo creamos ropa, sino que también creamos experiencias. Cada prenda que diseñas es única, personalizada para adaptarse a tu estilo y gusto individual.</p>

                <div class="buttons__cover" style="display: none;">
                    <input type="button" class="btn__readMore-cover" style="font-weight: bold;" value="Leer más">
                </div>

            </div>

            <div class="media__cover">
                <video src="media/animacion_cover.webm" autoplay playinline loop muted preload="auto" style="display: none;"></video>
                <img src="./imagenes/fotos/grafico.png" class="img-cover" alt="">
            </div>


        </div>

        <div class="container__banner">

            <div class="banner">
                <div class="banner__icon-heart">
                    <img src="media/heart_notify.png" id="icon_heart" alt="">
                </div>
                <div class="banner__icon-fire">
                    <img src="media/fire-dynamic-color.png" id="icon_fire" alt="">
                </div>
                <div class="banner__text">
                    <h2>En Shalom Creative Design te ofrecemos la oportunidad de poder diseñar tu propia camiseta de manera gratuita</h2>
                    <!-- <a href="#">Leer más</a> -->
                </div>
            </div>

        </div>


        
        <div class="carrusel-contenedor">
            <p class="carrusel-titulo">Diseños Creados</p>
            <br>
                <div class="contenedor-carrusel">
                    <div class="container">
                        <div class="slider-wrapper">
                          <button id="prev-slide" class="slide-button material-symbols-rounded">
                            chevron_left
                          </button>
                          <ul class="image-list">
                            <img class="image-item" src="./imagenes/fotos/camisetas/camisa 1.png" alt="img-1" />
                            <img class="image-item" src="./imagenes/fotos/camisetas/camisa 2.png" alt="img-2" />
                            <img class="image-item" src="./imagenes/fotos/camisetas/camisa 3.png" alt="img-3" />
                            <img class="image-item" src="./imagenes/fotos/camisetas/camisa 4.png" alt="img-4" />
                            <img class="image-item" src="./imagenes/fotos/camisetas/camisa 5.png" alt="img-5" />
                            <img class="image-item" src="./imagenes/fotos/camisetas/camisa 6.png" alt="img-6" />
                          </ul>
                          <button id="next-slide" class="slide-button material-symbols-rounded">
                            chevron_right
                          </button>
                        </div>
        
                        <div class="slider-scrollbar">
                          <div class="scrollbar-track">
                            <div class="scrollbar-thumb"></div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            
<section class="about-us section-about">
      <div class="main-img">
          <img src="./imagenes/fotos/diseño de camisetas.png" class="section-about-2" alt="">
      </div>

    <div class="text">
        <h4>Acerca de nosotros</h4>
        <h1 style="margin-bottom: 10px;">Somos Shalom Creative Design. Una empresa creada para ti</h1>
        <hr style="margin-bottom: 10px;">
        <p>
        En Shalom Creative Design, creemos en la innovación, la calidad y el estilo. Fabricamos ropa con materiales de primera calidad y técnicas innovadoras para garantizar la satisfacción de nuestros clientes. Nuestro servicio de atención al cliente eficiente facilita el proceso de compra y entrega, asegurando una experiencia de compra agradable. Nuestra visión es liderar el mercado de la moda personalizada, ofreciendo prendas de vestir de alta calidad y diseño exclusivo que se adapten a las preferencias de cada cliente. 
        </p>
    </div>
</section>

               <section class="seccion-2" id="Contacto" style="margin-top: 50px;">
                <div class="area">
                <div class="contenedor">
                    <div class="contacto">
                        <p class="titulo-2">Contactanos</p>
                        <p class="campo-de-texto-2">
                        En Shalom Creative Design, valoramos la comunicación abierta y directa con nuestros clientes. Si tienes alguna pregunta, comentario o sugerencia, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte.
                        </p>
                    </div>
                    <br><br>
                </div>
                
                      <div class="contenedor">
                        <form action="enviar.php" method="POST">
                            <div class="contenido-contacto">
                                
                                <h4 >Telefono:</h4>
                                <p>+58 426 791 4328</p>
                                <br>
                                <h4 >Gmail:</h4>
                                <p>shalom_creative_design@gmail.com</p>
                                <br>
                                <h4 >Dirección:</h4>
                                <p>Avenida perimetral, sector fortaleza, calle 7, Ciudad
Bolivar, Estado Bolivar, Venezuela</p>
                                <br>
                                <br>
            
                                <div class="footer-content">
                                    <div class="icon-social">
                                        <a href="https://wa.link/g09fl3"><img src="https://png.pngtree.com/element_our/md/20180509/md_5af2d4c95ac7b.jpg" class="boton-social" alt=""></a>
                                        <a href="https://www.instagram.com/shalom.creative.disign/"><img src="https://w7.pngwing.com/pngs/519/326/png-transparent-black-and-white-dark-grey-instagram-transparent-on-dark-grey-icon.png" class="boton-social" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </form>          
                    </div>
                </div>  
            </section> 
        </main>

    <footer>
        <li>©2023 ShalomCreativeDesign.Todos los derechos</li>
        <!-- <li><a href="#">Privacidad</a></li>
        <li><a href="#">Términos de venta</a></li>
        <li><a href="#">Términos de uso del sitio web</a></li>
        <li><a href="#">Adhesiones y vinculación con las redes sociales</a></li>
        <li><a href="#">Preferencias de cookies</a></li> -->
    </footer>

   

    <script src="js/script.js"></script>
    <script>
        const initSlider = () => {
            const imageList = document.querySelector(".slider-wrapper .image-list");
            const slideButtons = document.querySelectorAll(".slider-wrapper .slide-button");
            const sliderScrollbar = document.querySelector(".container .slider-scrollbar");
            const scrollbarThumb = sliderScrollbar.querySelector(".scrollbar-thumb");
            const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
            
            // Handle scrollbar thumb drag
            scrollbarThumb.addEventListener("mousedown", (e) => {
                const startX = e.clientX;
                const thumbPosition = scrollbarThumb.offsetLeft;
                const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;
                
                // Update thumb position on mouse move
                const handleMouseMove = (e) => {
                    const deltaX = e.clientX - startX;
                    const newThumbPosition = thumbPosition + deltaX;
        
                    // Ensure the scrollbar thumb stays within bounds
                    const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
                    const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;
                    
                    scrollbarThumb.style.left = `${boundedPosition}px`;
                    imageList.scrollLeft = scrollPosition;
                }
        
                // Remove event listeners on mouse up
                const handleMouseUp = () => {
                    document.removeEventListener("mousemove", handleMouseMove);
                    document.removeEventListener("mouseup", handleMouseUp);
                }
        
                // Add event listeners for drag interaction
                document.addEventListener("mousemove", handleMouseMove);
                document.addEventListener("mouseup", handleMouseUp);
            });
        
            // Slide images according to the slide button clicks
            slideButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const direction = button.id === "prev-slide" ? -1 : 1;
                    const scrollAmount = imageList.clientWidth * direction;
                    imageList.scrollBy({ left: scrollAmount, behavior: "smooth" });
                });
            });
        
             // Show or hide slide buttons based on scroll position
            const handleSlideButtons = () => {
                slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "flex";
                slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "flex";
            }
        
            // Update scrollbar thumb position based on image scroll
            const updateScrollThumbPosition = () => {
                const scrollPosition = imageList.scrollLeft;
                const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
                scrollbarThumb.style.left = `${thumbPosition}px`;
            }
        
            // Call these two functions when image list scrolls
            imageList.addEventListener("scroll", () => {
                updateScrollThumbPosition();
                handleSlideButtons();
            });
        }
        
        window.addEventListener("resize", initSlider);
        window.addEventListener("load", initSlider);


        /*funcion de redireccion del input*/
        function redireccionar () {
            location.href="Sign-up/login.php";
        }

        function redireccionar2 () {
            location.href="Sign-up/index.php";
        }
    </script>
</body>
</html>