<?php
    require_once __DIR__. '/../php/controller/controller.php';
    $controlador=new Controller();
    $nombre=$_GET['nombre'];
    if(isset($nombre)){
        echo '
            <script>
                window.onload=()=>{
                    let opcion=confirm("Antes de jugar deber crear una partida pulsando en Aceptar.")
                    if(opcion==true){
                        '.$controlador->iniciarPartida($nombre).'
                        window.location.href="./game.php?nombre='.$nombre.'&idPartida='.$controlador->modelo->conexion->insert_id.'";
                    }else{
                        window.location.href="../index.html";
                    }
                }
            </script>
        ';
    }else{
        header("Location: ../index.html");
    }
    
?>