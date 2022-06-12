<?php
/**
 * @file controller.php
 * @description Controlador de la aplicación.
 * @author Juan Manuel Toscano Reyes
 */
    class Controller{
        public $modelo;
        public $idPartida;
        /**
         * @function __construct
         * Constructor de la clase donde instancio el modelo
         */
        function __construct(){
            require_once __DIR__. '/../model/model.php';
            $this->modelo=new Model();
        }
        /**
         * @function listarCategorias
         * Función que llama al modelo para listar las categorias
         */
        function listarCategorias(){
            $categorias=$this->modelo->listadoCategorias();
            echo json_encode($categorias);
        }
        function iniciarPartida($nombre){
            $this->modelo->crearPartida($nombre);
        }
        /**
         * @function cogerPalabras
         * Función que llama al modelo para coger las palabras de una categoria
         */
        function cogerPalabras($nombre){
            $palabras=$this->modelo->captarPalabras($nombre);
            //echo json_encode($palabras);
            return $palabras;
        }
        /**
         * @function controlarPalabra
         * Función que controla las palabras de una partida
         */
        function controlarPalabra($palabras){
            $random=mt_rand(0,count($palabras)-1);
            $palabra=$palabras[$random];
            $palabra=explode(",",$palabra);
            $palabraIngles=$palabra[0];
            $palabraEspanol=$palabra[1];
            $idPalabra=$palabra[2];
            $respuesta=array("palabraIngles"=>$palabraIngles,"palabraEspanol"=>$palabraEspanol,"idPalabra"=>$idPalabra);
            return $respuesta;
        }
        /**
         * @function comprobar
         * Función que comprueba si la respuesta es correcta o no
         */
        function comprobar($idPartida){
            $respuesta=$_POST['wordEnglish'];
            $palabraEspanol=$_POST['wordSpanish'];
            $infoPalabra=$this->modelo->sacarInfoPalabra($palabraEspanol);
            $palabraIngles=$infoPalabra[1];
            $idPalabra=$infoPalabra[0];
            if($respuesta==$palabraIngles){
                $acertada=1;
            }else{
                $acertada=0;
            }
            $this->modelo->insertarRespuesta($idPalabra,$idPartida,$acertada);
        }
        function terminarPartida($idPartida){
            $nAciertos=$this->modelo->nAciertos($idPartida);
            $nErrores=$this->modelo->nErrores($idPartida);
            $puntuacion=$nAciertos-$nErrores;
            $this->modelo->acabarPartida($idPartida,$nAciertos,$nErrores,$puntuacion);
        }
    }

?>