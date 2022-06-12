<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    require_once __DIR__. '/controller/controller.php';
    $controlador=new Controller();
    $json=file_get_contents('php://input');
    $data=json_decode($json,true);
    $accion=$data['accion'];
    //echo($accion);
    switch ($accion) {
        case 'listarCategorias':
            $controlador->listarCategorias();
            break;
        case 'cogerPalabras':
            $nombre=$data['nombre'];
            $controlador->cogerPalabras($nombre);
            break;
        
    }