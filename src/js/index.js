/**
 * @file index.js
 * @author Juan Manuel Toscano Reyes <jtoscanoreyes.guadalupe@alumnado.fundacionloyola.net>
 * @description Index file for the application.
 */

'use strict'
window.onload=iniciar()

function iniciar(){
    //Realizo la llamada ajax para obtener los datos desde el servidor
    let datos={
        accion:'listarCategorias',
    }
    let xhr = new XMLHttpRequest()
    xhr.open('POST', './php/index.php', true)
    xhr.setRequestHeader('Content-Type', 'applications/json')
    xhr.send( JSON.stringify(datos) )
    xhr.onreadystatechange=()=>{
        if(xhr.readyState==4 && xhr.status==200){
            let respuesta=JSON.parse(xhr.responseText)
            insertarDatos(respuesta)
        }
    }
    
}

function insertarDatos(respuesta) {
    //Inserto los datos en el html
    //let contador=0
    for(let i=0;i<respuesta.length;i++){
        let categoria=respuesta[i]
        let main=document.getElementsByTagName('main')[0]
        let div=document.createElement('div')
        let a=document.createElement('a')
        //console.log(contador);
        /* if(contador==0){
            main.appendChild(div)
            contador++
        }else{
            contador++
        }
        if(contador==3){
            contador=0
        } */
        main.appendChild(div);
        div.appendChild(a);
        a.innerHTML=categoria
        a.setAttribute('href', 'views/creargame.php?nombre='+categoria)
    }
}