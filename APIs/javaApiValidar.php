<?php
    $correo=$_POST['user'];
    $password=$_POST['password'];
  
     if(
        $user=="Alan" &&
        $password=="123"
     ){
         $respuesta=3;
        echo $respuesta;
        
        session_start();
        $_SESSION['admin']=$user;

     }else{
        $ch = curl_init('http://localhost:8080/ProyectoAvali/ValidarUsuario');
 
        //especificamos el POST (tambien podemos hacer peticiones enviando datos por GET
        curl_setopt ($ch, CURLOPT_POST, 1);
         
        //le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)
        curl_setopt ($ch, CURLOPT_POSTFIELDS, "user=$user&password=$password");
         
        //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
         
        //recogemos la respuesta
        $respuesta = curl_exec ($ch);
        
        //o el error, por si falla
        $error = curl_error($ch);
        //y finalmente cerramos curl
        curl_close ($ch);
        echo $respuesta;

        $val = json_decode($respuesta, true);
    
        session_start();
        $_SESSION['user']=$val[0]["id"];
     }
    
    
?>