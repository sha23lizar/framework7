<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/estilos2.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- Font Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->

    <!--Css Notificaciones -->
    <link rel="stylesheet" type="text/css" href="../css/toastify.css">

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
        grid-template-columns: repeat(2, 1fr);
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

<body class="">
<div hidden id="id_user" data-id=""></div>

    <header>

        <div class="container__header">

            <div class="logo">
                <img src="../imagenes/fotos/3-removebg-preview.png" alt="">
            </div>

            <div class="menu">
                <nav>
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="#">Productos</a></li>
                        <li><a href="#">Diseñar camiseta</a></li>
                        <li><a href="#">Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </nav>
            </div>
            <i class="fa-solid fa-bars" id="icon_menu"></i>
            <?php include("../includes/hederUser.php"); ?>

        </div>

    </header>

    <main class="editor">
        <div id="content-editor" class="content-Editor">

        </div>
        <div class="content-opciones-pc">
            <div class="extas-funcions">
                <!-- <button id="btn-share" class="btn-Extra-funcions">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-share" viewBox="0 0 16 16">
                        <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3" />
                    </svg>
                    <p>Compartir</p>
                </button> -->
                <button class="btn-save btn-Extra-funcions">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-floppy" viewBox="0 0 16 16">
                        <path d="M11 2H9v3h2z" />
                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                    </svg>
                    <p>guardar</p>
                </button>

                <button class="btn-download btn-Extra-funcions">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                    </svg>
                    <p>descargar</p>
                </button>

                <button class="btn-Extra-funcions btn-reducir">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrows-angle-contract" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M.172 15.828a.5.5 0 0 0 .707 0l4.096-4.096V14.5a.5.5 0 1 0 1 0v-3.975a.5.5 0 0 0-.5-.5H1.5a.5.5 0 0 0 0 1h2.768L.172 15.121a.5.5 0 0 0 0 .707M15.828.172a.5.5 0 0 0-.707 0l-4.096 4.096V1.5a.5.5 0 1 0-1 0v3.975a.5.5 0 0 0 .5.5H14.5a.5.5 0 0 0 0-1h-2.768L15.828.879a.5.5 0 0 0 0-.707" />
                    </svg>
                    <p>Reducir</p>
                </button>
                <button class="btn-Extra-funcions btn-expander">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrows-angle-expand" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707" />
                    </svg>
                    <p>Expandir</p>
                </button>

            </div>
            <div id="options-edit" class="options-edit">
                <div data-toggle="head" class="header-options-edit">
                    <button data-head="Producto" id="btn-header-opcion-producto" class="btn-header-options-edit active">
                        <span>Producto</span>
                    </button>
                    <button data-head="Personalizaciones" id="btn-header-opcion-personalizado" class="btn-header-options-edit ">
                        <span>Personalizacion</span>
                    </button>
                </div>

                <div data-toggle="content" class="content-opcions">
                    <div data-content="Producto" class="contenedor-opciones-producto active">
                        <h3 class="texto-tipo-producto">Franela Normal</h3>
                        <?php
                        include("../includes/conexion.php");
                        $sql = "SELECT nombre FROM diseños  WHERE id=13";
                        $result = mysqli_query($conexionMysqli, $sql);
                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                            <h4 class="texto-nombre-diseño"><?php echo $mostrar['nombre'] ?? 'Nuevo Diseño'; ?></h4>

                        <?php
                        } ?>
                        <h3 class="texto-color">Color de Franela:</h3>
                        <div class="content-colors"></div>
                    </div>
                    <div data-content="Personalizaciones" class="contenedor-opciones-personalizacion">
                        <div class="content-personalizaciones active">
                        </div>

                    </div>
                </div>
            </div>
            <button class="btn-buy" id="showFormBtn">
                Pedir Diseño
            </button>
        </div>
    </main>



    <div class="conteiner-agregar-personalizaciones">
        <button class="btn-cerrar-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="white" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
            </svg>
        </button>
        <div class="content-agregar-personalizaciones">
            <h3>Que Quieres Agregar</h3>
            <div class="opciones-agregar">
                <form method="POST" action="../includes/subirImagen.php" class="form-agregar-imagen" style="display: none;">
                    <input type="file" name="imgens" id="file-agregar-file" hidden>
                    <input type="text" name="id_user" value="7" hidden>
                    <input class="btn-submit" type="submit" value="" hidden>
                </form>
                <button class="btn-agregar-imagen">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                    </svg>
                    <h4>
                        Subir Imagen
                    </h4>
                </button>
               

            </div>
        </div>
        <div class="container-confirm-img-loader">
            <div class="content-img-loader">
                <h4>Quieres Subir Esta Imagen</h4>
                <div>
                    <div class="content-img fondo-transparent">
                        <div class="img"></div>
                    </div>
                    <p></p>
                    <div class="options">
                        <div class="btn-aceptar-imgagen ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                            </svg>
                            <h5>Aceptar</h5>
                        </div>
                        <div class="btn-rechazar-imagen">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                            <h5>Cancelar</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="container-edit-position">
        <button class="btn-cerrar-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="white" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
            </svg>
        </button>
        <div class="content-edit-position">
            <h3>Editar Posicion</h3>
            <div class="sub-content-edit-position">
                <div class="content-img">
                    <img src="../assets/models/preview/frontal-shirt.png" alt="" class=" transparent img-model">
                    <div class="img-edit-position"></div>
                </div>
                <div class="content-options-edit-position">
                    <div class="selector-tamaño">
                        <div id="numberSize">0</div>
                        <input type="range" id="input-tamaño" min="25" max="150" step="1" value="50" />
                    </div>
                </div>
            </div>
            <div class="btns">
                <button class="btn-cancelar">Cancelar</button>
                <button class="btn-aplicar">Aplicar</button>
            </div>

        </div>
    </div>


    <div class="shirt-sizes" id="shirtSizesForm">
        <h1>Seleccione</h1>
        <form id="orderForm" action="" method="POST">
            <div class="shirt-size">
                <label for="genero">Genero</label>
                <div class="boton">
                    <button type="button" class="btn-male" style="border-radius: 5px;"><i class='bx bx-male-sign'></i></button>
                    <input type="hidden" id="genero" name="genero" value="">
                    <button type="button" class="btn-female" style="border-radius: 5px;"><i class='bx bx-female-sign'></i></button>
                </div>
            </div>
            <div class="shirt-size">
                <label for="xs">XS</label>
                <div class="boton">
                    <button type="button" class="btn-minus">-</button>
                    <input type="number" id="xs" name="xs" value="0" min="0">
                    <button type="button" class="btn-plus">+</button>
                </div>
            </div>
            <div class="shirt-size">
                <label for="s">S</label>
                <div class="boton">
                    <button type="button" class="btn-minus">-</button>
                    <input type="number" id="s" name="s" value="0" min="0">
                    <button type="button" class="btn-plus">+</button>
                </div>
            </div>
            <div class="shirt-size">
                <label for="m">M</label>
                <div class="boton">
                    <button type="button" class="btn-minus">-</button>
                    <input type="number" id="m" name="m" value="0" min="0">
                    <button type="button" class="btn-plus">+</button>
                </div>
            </div>
            <div class="shirt-size">
                <label for="l">L</label>
                <div class="boton">
                    <button type="button" class="btn-minus">-</button>
                    <input type="number" id="l" name="l" value="0" min="0">
                    <button type="button" class="btn-plus">+</button>
                </div>
            </div>
            <div class="shirt-size">
                <label for="xl">XL</label>
                <div class="boton">
                    <button type="button" class="btn-minus">-</button>
                    <input type="number" id="xl" name="xl" value="0" min="0">
                    <button type="button" class="btn-plus">+</button>
                </div>
            </div>
            <button type="submit" class="button-pev">Realizar pedido</button>
            <div id="error-message" class="error hidden">Por favor, seleccione el género y al menos una cantidad de camisetas.</div>
        </form>
    </div>

    <footer>
        <li>©2023 ShalomCreativeDesign.Todos los derechos</li>
        <li><a href="#">Privacidad</a></li>
        <li><a href="#">Términos de venta</a></li>
        <li><a href="#">Términos de uso del sitio web</a></li>
        <li><a href="#">Adhesiones y vinculación con las redes sociales</a></li>
        <li><a href="#">Preferencias de cookies</a></li>
    </footer>

    <!-- Muy importante colocar la ubicacion de los archivos -->
    <script type="importmap">
        {
            "imports": {
                "three": "../build/three.module.js",
                "three/addons/": "../build/jsm/"
            }
        }
    </script>

    <!-- <script src="js/script.js"></script> -->

    <script src="../js/sweetalert.min.js"></script>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script type="module" src="script.js"></script>
    <!--Script Notificaciones -->
    <script type="text/javascript" src="../js/toastify.js"></script>
    <script>
        /*funcion de redireccion del input*/
        function redireccionar() {
            location.href = "../Sign-up/login.php";
        }

        function redireccionar2() {
            location.href = "../Sign-up/index.php";
        }
    </script>
</body>

</html>