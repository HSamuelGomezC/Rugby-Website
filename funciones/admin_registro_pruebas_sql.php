<?php
    $codigo      = $_POST["codigo"];

    $p1_minutos  = $_POST["p1_minutos"];
    $p1_segundos = $_POST["p1_segundos"];
    $p1_tiempo   = strval($p1_minutos). "." . strval($p1_segundos);

    $p2_minutos  = $_POST["p2_minutos"];
    $p2_segundos = $_POST["p2_segundos"];
    $p2_tiempo   = strval($p2_minutos). "." . strval($p2_segundos);

    require_once "../funciones/conecta.php";
    $con = conecta();
    $sql = "INSERT INTO pruebas_fisicas (codigo_usuario, fecha, prueba_1, prueba_2)
    VALUES ($codigo, now(), $p1_tiempo, $p2_tiempo)";
    
    //echo $sql;
    $res = mysqli_query($con, $sql);
    mysqli_close($con);

    header("Location: ../admin/admin_ver_usuarios.php");    
?>