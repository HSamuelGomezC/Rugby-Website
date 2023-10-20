<?php
    $codigo = $_POST['codigo'];

    $preg1  = $_POST['preg_1'];
    $preg2  = $_POST['preg_2'];
    $preg3  = $_POST['preg_3'];
    $preg4  = $_POST['preg_4'];
    $preg5  = $_POST['preg_5'];

    require "conecta.php";
    $con = conecta();

    session_start();
    //Obtener fecha local
    date_default_timezone_set('america/mexico_city');
    $date = date('y-m-d'); //Obtener fecha local

    $sql = "INSERT INTO cuestionario_1 (codigo_usuario, fecha, preg_1, preg_2, preg_3, preg_4, preg_5) 
    VALUES ('$codigo', '$date', '$preg1', '$preg2', '$preg3', '$preg4', '$preg5')";

    mysqli_query($con, $sql);

    header("Location: ../funciones/user_verificar_cuestionario1.php");

    mysqli_close($con);
?>