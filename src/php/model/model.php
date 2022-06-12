<?php
/**
 * @file model.php
 * @description Modelo de la aplicación.
 * @author Juan Manuel Toscano Reyes
 */
    class Model{
        public $conexion;
        /**
         * @function __construct
         * Constructor de la clase donde realizo la conexion con la base de datos
         */
        function __construct(){
            require_once __DIR__. '/../configdb.php';
            $this->conexion=new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE);
        }
        /**
         * @function listadoCategorias
         * Funcion que llama a la base de datos para listar las categorias
         */
        function listadoCategorias(){
            $sql="SELECT * FROM tipos";
            $resultado=$this->conexion->query($sql);
            $categorias=array();
            while($fila=$resultado->fetch_assoc()){
                $categorias[]=$fila['nombreTipo'];
            }
            return $categorias;
        }
        /**
         * @function crearPartida
         * Funcion que llama a la base de datos para crear una partida
         */
        function crearPartida($nombre){
            $sql="SELECT idTipo FROM tipos where nombreTipo='$nombre'";
            $resultado=$this->conexion->query($sql);
            $fila=$resultado->fetch_assoc();
            $idTipo=$fila['idTipo'];
            $sql="INSERT INTO partidas (idUsuario,idTipo) VALUES (2,$idTipo)";
            $this->conexion->query($sql);
        }
        /**
         * @function captarPalabras
         * Funcion que llama a la base de datos para captar las palabras de una categoria
         */
        function captarPalabras($nombre){
            $sql="SELECT * FROM palabras WHERE idTipo=(SELECT idTipo FROM tipos where nombreTipo='$nombre');";
            $resultado=$this->conexion->query($sql);
            $palabras=array();
            while($fila=$resultado->fetch_assoc()){
                $palabras[]=$fila['palabraIngles'].",".$fila['palabraEspanol'].",".$fila['idPalabra'];
            }
            return $palabras;
        }
        /**
         * @function insertarRespuesta
         * Funcion que llama a la base de datos para insertar la respuesta de una palabra de la partida
         */
        function insertarRespuesta($idPalabra,$idPartida,$acertada){
            $sql="INSERT INTO partidas_palabras (idPartida,idPalabra,acertada) VALUES ($idPartida,$idPalabra,$acertada);";
            $this->conexion->query($sql);
        }
        /**
         * @function sacarInfoPalabra
         * Funcion que llama a la base de datos para sacar la informacion de una palabra
         */
        function sacarInfoPalabra($palabraEspanol){
            $sql="SELECT idPalabra,palabraIngles FROM palabras WHERE palabraEspanol='$palabraEspanol';";
            $resultado=$this->conexion->query($sql);
            $idPalabra=0;
            $palabraIngles="";
            while($fila=$resultado->fetch_assoc()){
                $idPalabra=$fila['idPalabra'];
                $palabraIngles=$fila['palabraIngles'];
            }
            return [$idPalabra,$palabraIngles];
        }
        function nAciertos($idPartida){
            $sql="SELECT COUNT(*) as nAciertos FROM partidas_palabras WHERE idPartida=$idPartida AND acertada=1;";
            $resultado=$this->conexion->query($sql);
            $fila=$resultado->fetch_assoc();
            return $fila['nAciertos'];
        }
        function nErrores($idPartida){
            $sql="SELECT COUNT(*) as nErrores FROM partidas_palabras WHERE idPartida=$idPartida AND acertada=0;";
            $resultado=$this->conexion->query($sql);
            $fila=$resultado->fetch_assoc();
            return $fila['nErrores'];
        }
        function acabarPartida($idPartida,$nAciertos,$nErrores,$puntuacion){
            $sql="UPDATE partidas SET nAciertos=$nAciertos,nErrores=$nErrores,puntuacion=$puntuacion,fechaHora=now() WHERE idPartida=$idPartida;";
            $this->conexion->query($sql);
        }
    }
?>