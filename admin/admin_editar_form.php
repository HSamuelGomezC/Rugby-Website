<?php
    session_start();
    $title = "Admin Editar Usuarios";
    $_SESSION['title'] = $title;
    include_once('../views/nav_admin.php');

    require "../funciones/conecta.php";
    $con = conecta();
    $codigo = $_REQUEST["codigo"];
    $sql = "SELECT * FROM usuarios WHERE codigo = $codigo";
    $res = $con->query($sql);
    $res = mysqli_fetch_assoc($res); //Convertir a arreglo tipo diccionario
?>

<script>
    var mensaje = "Faltan campos por llenar";
    function ValidarCampos() {
        if(!registro.nombre.value || !registro.peso.value || !registro.altura.value
        || !registro.correo.value || !registro.password.value || !registro.anio_nac.value) {
            alert(mensaje);
        } else
            registro.submit();
    }
</script>

<body class=" bg-dark d-flex justify-content-center align-items-center vh-100 ">
    <!--Contenedor del form blanco-->
    <div class="bg-white p-5 rounded-5 text-secondary " style="width: 25rem;">
        <!--Texto: Registro-->
        <div class="text-center fs-1 fw-bold">Editar alumno</div>
            <form action="../funciones/admin_editar_sql.php?codigo=<?= $codigo; ?>" method="POST" name="registro">
                    <!--Nombre-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"> </div>
                        <input class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $res['nombre']; ?>">
                    </div>
                    <!--Peso-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="number" name="peso" placeholder="Peso" step="any" value="<?php echo $res['peso']; ?>">
                    </div>
                    <!--Altura-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="number" name="altura" placeholder="Altura (CM)" value="<?php echo $res['altura']; ?>">
                    </div>
                    <!--Correo-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="mail" name="correo" placeholder="Correo" value="<?php echo $res['correo']; ?>">
                    </div>
                    <!--Fecha-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="date" name="anio_nac" placeholder="Fecha de nacimiento" value="<?php echo $res['anio_nac']; ?>">
                    </div>         
                <!--Botón enviar-->
                <input type="submit" class="btn btn-danger text-white w-100 mt-4 fw-semibold shadow-sm" 
                    name="registrar" value="Enviar" onclick="ValidarCampos(); return false;"
                />
            </form>
        <div class="d-flex gap-1 justify-content-center mt-1">
            <a href="../admin/admin_ver_usuarios.php" class="text-decoration-none text-danger fw-semibold ">Cancelar</a>
        </div>
    </div>
</body>
</html>