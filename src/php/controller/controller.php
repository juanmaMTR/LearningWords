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
        function terminarPartida($nombre){
            $palabras=[];
            $nAciertos=0;
            $nErrores=0;
            $nPalabras=$this->modelo->contarPalabras($nombre);
            for($i=0;$i<$nPalabras;$i++){
                $respuesta=$_POST['wordEnglish'.$i];
                $palabraEspanol=$_POST['wordSpanish'.$i];
                $infoPalabra=$this->modelo->sacarInfoPalabra($palabraEspanol);
                $palabraIngles=$infoPalabra[1];
                $idPalabra=$infoPalabra[0];
                if($respuesta==$palabraIngles){
                    $acertada=1;
                    $nAciertos++;
                }else{
                    $acertada=0;
                    $nErrores++;
                }
                $palabras[]=array('idPalabra'=>$idPalabra,'acertada'=>$acertada);
            }
            $puntuacion=$nAciertos-$nErrores;
            $idTipo=$this->modelo->sacarIdTipo($nombre);
            $idUsuario=2;
            $this->modelo->insertarDatos($idTipo,$nAciertos,$nErrores,$puntuacion,$idUsuario,$palabras);
        }
    }

?>