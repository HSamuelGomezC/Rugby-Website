<?php
    error_reporting(0);
    session_start();
    $res = $_SESSION["res"];
    $mensaje = $_SESSION["mensaje"];

    if($res) { //Si llegaste al login y ya habías iniciado sesión NO muestres mensaje
        $mensaje = null;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="index.css">
    <script>
        function ValidarCampos() {
            if(!ingreso.codigo.value || !ingreso.password.value) {
                alert("Faltan campos por llenar");
            } else {
                ingreso.submit();
            }
        }
    </script>
</head>
<body class=" bg-dark d-flex justify-content-center align-items-center vh-100 ">
    <div class="bg-white p-5 rounded-5 text-secondary " style="width: 25rem;">
        <!-- Escudo leones negros -->
        <div class="d-flex justify-content-center">
            <img src="images/leones.png" alt="login-icon" style="height: 7rem"/>
        </div>
        <!--Texto: Login-->
        <div class="text-center fs-1 fw-bold"> Login </div>

        <form action="funciones/validar_login.php" method="post" name="ingreso">
            <?php
            if ($mensaje) {
            ?>
                <p class="mensaje">
                    <?php
                        echo $mensaje;
                        session_destroy();
                    ?>
                </p>
            <?php
            }
            ?>
            <!--Código-->
            <div class="input-group mt-5">
                <!--Color amarillo en el ícono-->
                <div class="input-group-text bg-warning">
                    <i class="fa-solid fa-user"></i>
                </div>
                <input class="form-control" type="text" name="codigo" placeholder="Código" />
            </div>
            <!--Contraseña-->
            <div class="input-group mt-1">
                <!--Color amarillo en el ícono-->
                <div class="input-group-text bg-warning">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <input class="form-control" type="password" name="password" placeholder="Contraseña">
            </div>
            <!--Botón login-->
            <input type="submit" class="btn btn-danger text-white w-100 mt-4 fw-semibold shadow-sm" 
                name="ingresar" value="Log in" onclick="ValidarCampos(); return false;"
            />
        </form>     
        <!--Registrarse-->
        <div class="d-flex gap-1 justify-content-center mt-1">
            <div>¿No tienes una cuenta?</div>
            <a href="users/user_registro_form.php" class="text-decoration-none text-danger fw-semibold ">Regístrate</a>
        </div>
    </div>
</body>
</html>