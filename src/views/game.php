<?php
    require_once __DIR__. '/../php/controller/controller.php';
    $controlador=new Controller();
    $nombre=$_GET['nombre'];
    $idPartida=$_GET['idPartida'];
    $resultado=$controlador->cogerPalabras($nombre);
    //echo json_encode($resultado);
    $palabra=$controlador->controlarPalabra($resultado);
    if(isset($_POST['comprobar'])){
        $controlador->comprobar($idPartida);
    }
    if(isset($_POST['terminar'])){
        $controlador->terminarPartida($idPartida);
        header("Location: ../index.html");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Juan Manuel Toscano Reyes <jtoscanoreyes.gudalupe@alumnado.fundacionloyola.com>">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../img/librooriginal.png">
        <title>LearningWords</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="img">
                    <img src="../img/librooriginal.png">
                </div>
                <div class="title">
                    <h1>Learning Words</h1>
                </div>
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
        <main>
            <div class="time">
                <img src="../img/tiempo.png">
                <div class="progress-container">
                    <div class="progress"></div>
                </div>
            </div>
            <div class="game">
                <form action="#" method="post">
                    <div class="words">
                        <div class="wordSpanish">
                            <input type="text" name="wordSpanish" id="wordSpanish" placeholder="Introduzca traduccion en Español" <?php echo "value=". $palabra['palabraEspanol'] ." readonly";?>>
                        </div>
                        <div class="arrow">
                            <img src="../img/flecha.png">
                        </div>
                        <div class="wordEnglish">
                            <input type="text" name="wordEnglish" id="wordEnglish" placeholder="Introduzca traducción en Inglés">
                        </div>
                        <input type="submit" value="Comprobar" name="comprobar" id="comprobar" >
                    </div>
                    <input type="submit" value="Terminar Juego" name="terminar" id="terminar">
                </form>
            </div>
        </main>
        <footer>
            <div class="socialmedias">
                <a href="#"><img src="../img/facebook.png"></a>
                <a href="#"><img src="../img/twitter.png"></a>
                <a href="#"><img src="../img/instagram.png"></a>
            </div>
            <p>&copy; Derechos reservados Colegio Virgen de Guadalupe</p>
        </footer>
    </body>
</html>

