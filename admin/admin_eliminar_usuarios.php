<?php
    require("../funciones/conecta.php");
    $con = conecta();
    $codigo = $_REQUEST["codigo"];
    $flag = false;
    
    if($codigo > 0) {
        $flag = true;
        $sql = "DELETE from usuarios WHERE codigo = $codigo";
        $res = $con->query($sql);
        $sql = "DELETE from pruebas_fisicas WHERE codigo_usuario = $codigo";
        $res = $con->query($sql);
        $sql = "DELETE from cuestionario_1 WHERE codigo_usuario = $codigo";
        $res = $con->query($sql);
        $sql = "DELETE from cuestionario_2 WHERE codigo_usuario = $codigo";
        $res = $con->query($sql);
    }
    echo $flag;
    /*header("Location: admin_ver_usuarios.php");
    exit();*/
?>