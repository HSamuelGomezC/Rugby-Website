<?php
    $codigo = $_POST["codigo"];
    $preg1 = $_POST["preg_1"];
    
    $preg2 = $_POST["preg_2"];
    $preg2_txt = $_POST["describir_preg_2"];
    
    $preg3 = $_POST["preg_3"];
    $preg3_txt = $_POST["describir_preg_3"];

    require "conecta.php";
    $con = conecta();

    if(!$preg2_txt)
        $preg2_txt = $preg2;
    if(!$preg3_txt)
        $preg3_txt = $preg3;
        
    session_start();
    //Obtener fecha local
    date_default_timezone_set('america/mexico_city');
    $date = date('y-m-d'); //Obtener fecha local

    $sql = "INSERT INTO cuestionario_2 (codigo_usuario, fecha, preg_1, preg_2, preg_3) 
    VALUES ('$codigo', '$date', '$preg1', '$preg2_txt', '$preg3_txt')";

    mysqli_query($con, $sql);

    header("Location: ../views/user_home.php");
    
    mysqli_close($con);
?>