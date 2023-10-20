<?php
    //error_reporting(0);
    $res = $_SESSION["res"];
    $title = $_SESSION["title"];
    if(!$res || $res['codigo'] == "admin") {
        header("Location: ../index.php");
        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title; ?> </title>
    <!--CSS-->
    <link rel="stylesheet" href="../views/styles/nav_user.css">
    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-md navbar-dark bg-danger" >
        <div class=" container-fluid">
            <!--Botón home-->
            <a class=" navbar-brand" href="../views/user_home.php">
                <img src="../images/leones.png" alt="logo-icon" style="height: 5rem"/>
                <span class="text-black"></span>
            </a>
            <!--Hamburger menu (responsive)-->
            <button class="navbar-toggler" type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#menu" 
                aria-controls="navbarSupportedContent" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--Elementos colapsables-->
            <div class="collapse navbar-collapse  " id="menu">
                <ul class=" navbar-nav mx-auto"> 
                    <!--Cuestionario 1-->
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="../users/cuestionario_1.php">Cuestionario 1</a>
                    </li>
                    <!--Cuestionario 2-->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../funciones/user_verificar_cuestionario2.php">Cuestionario 2</a>
                    </li>
                </ul>
                <ul class=" navbar-nav ml-auto ">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../funciones/cerrar_sesion.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Mensajes bienvenida-->
    <p class="bg-warning" id="bienvenida">Bienvenido, <?php echo $res["nombre"]; ?> </p>
    <!--Hamburger menu-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<!--
<body>
    <div class="nav-container">
        <nav class="nav">
            <ul>
                <li> <a href="../views/user_home.php">Inicio, aquí irá logo</a> </li>
                <li> <a href="../users/cuestionario_1.php">Cuestionario 1</a> </li>
                <li> <a href="../funciones/user_verificar_cuestionario2.php">Cuestionario 2</a> </li>
                <li> <a href="../funciones/cerrar_sesion.php">Cerrar sesión</a> </li>
            </ul>
        </nav>
    </div>
-->