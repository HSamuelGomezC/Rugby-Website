<?php
    $id = $_REQUEST["id"]; //Código a eliminar

    require "../funciones/conecta.php";
    $con = conecta();
    $sql = "DELETE FROM pruebas_fisicas WHERE id = $id";
    mysqli_query($con, $sql);
    header("Location: ../admin/admin_consultar_pruebas.php");
?>