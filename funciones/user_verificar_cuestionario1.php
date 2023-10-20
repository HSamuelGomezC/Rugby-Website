<?php
    session_start();
    $res = $_SESSION["res"]; //Obtener el registro completo del usuario que se loggeo
    $codigo = $res["codigo"];

    //Obtener fecha local
    date_default_timezone_set('america/mexico_city');
    $date = date('y-m-d'); 

    require "conecta.php";
    $con = conecta();
    $sql = "SELECT * FROM cuestionario_1 WHERE fecha = '$date' AND codigo_usuario = '$codigo'";
    //Busca un registro que tenga la fecha local y el código loggeado
    $fecha = mysqli_query($con, $sql);
    $fecha = mysqli_fetch_assoc($fecha);
    $fecha = $fecha["fecha"];
    $_SESSION["fecha"] = $fecha;

    if($fecha)
        $_SESSION["mensaje"] = "";        
    else
        $_SESSION["mensaje"] = "No olvides contestar tu cuestionario de bienestar";
    
    header("Location: ../views/user_home.php");
?>