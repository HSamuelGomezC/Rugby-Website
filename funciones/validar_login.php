<?php
//error_reporting(0); //Evitar mensajes sql
require "conecta.php";

$con = conecta();
//Obtener variables
$codigo    = $_POST["codigo"];
$password  = $_POST["password"];
//Evitar inyecciones SQL
$codigo   = str_replace("'","\\'",$codigo);
$password = str_replace("'","\\'",$password);

//No ciframos contraseña porque es el admin
$sql = "SELECT * FROM administradores WHERE codigo = '$codigo' AND password = '$password'";

$res   = mysqli_query($con, $sql);
$filas = mysqli_num_rows($res); //Obtener numero de columnas
$res = mysqli_fetch_assoc($res); //Obtener arreglo con los registros

if($filas) {
    session_start(); //
    $_SESSION['res'] = $res;
    header("Location: ../views/admin_home.php");
} else {
    //Cifrar password porque es usuario
    $passwordC = md5($password);
    $sql = "SELECT * FROM usuarios WHERE codigo = '$codigo' AND password = '$passwordC'";
    $res   = mysqli_query($con, $sql);
    $filas = mysqli_num_rows($res); //Obtener numero de columnas
    $res = mysqli_fetch_assoc($res); //Obtener arreglo con los registros
    mysqli_close($con);
    session_start();
    if($filas){
        $_SESSION['res'] = $res;
        //Verificar si contestó su cuestionario o no para mostrar el mensaje
        header("Location: ../funciones/user_verificar_cuestionario1.php");
    } else {
        $mensaje = "Datos no válidos";
        $_SESSION["mensaje"] = $mensaje;
        header("Location: ../index.php");
    }
}
//echo $sql;
mysqli_close($con);
?>