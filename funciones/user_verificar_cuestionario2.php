<?php
    session_start();
    $res            = $_SESSION["res"];
    $codigo_usuario = $res["codigo"]; 

    //Obtener fecha local
    date_default_timezone_set('america/mexico_city');
    $date = date('y-m-d');

    require "conecta.php";
    $con = conecta();
    $sql = "SELECT * FROM cuestionario_2 WHERE fecha = '$date' AND codigo_usuario = '$codigo_usuario'";
    $fecha    = mysqli_query($con, $sql);
    $fecha    = mysqli_fetch_assoc($fecha);
    $_SESSION["fecha2"] = $fecha;

    header("Location: ../users/cuestionario_2.php");
?>