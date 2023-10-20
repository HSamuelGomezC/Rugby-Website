<?php
   error_reporting(0); //Evitar mensajes de error sql
   require "conecta.php";
   $con = conecta();

   $codigo    = $_POST['codigo'];

   //Comprobar disponibilidad
   $sql = "SELECT * FROM usuarios WHERE codigo = $codigo";
   $res   = mysqli_query($con, $sql);
   $filas = mysqli_num_rows($res); //Obtener numero de columnas
   session_start();

   if($filas) {
      $mensaje = "Código ya en uso";
   }
   else {
      $nombre    = $_POST['nombre'];
      $peso      = $_POST['peso'];
      $altura    = $_POST['altura'];
      $correo    = $_POST['correo'];
      $password  = $_POST['password'];
      
      $passwordC = md5($password);
      $anio_nac  = $_POST['anio_nac'];
      $rank      = $_POST['rank'];
      echo $rank;

      $sql = "INSERT INTO usuarios (codigo, nombre, peso, altura, correo, password, anio_nac, rank)
      VALUES ('$codigo', '$nombre', '$peso', '$altura', '$correo', '$passwordC', '$anio_nac', '$rank')";

      mysqli_query($con, $sql);
      mysqli_close($con);

      $mensaje = "¡Registro creado con éxito!";
   }

   $_SESSION["mensaje"] = $mensaje;
   header("Location: ../index.php");
   exit();
   
?>