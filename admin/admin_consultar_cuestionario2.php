<?php
    session_start();
    $title = "Admin Cuestionario RPE";
    $_SESSION['title'] = $title;
    include_once("../views/nav_admin.php");

    $codigo = $_POST["codigo"];

    if($codigo){
        require "../funciones/conecta.php";
        $con     = conecta();
        $sql     = "SELECT * FROM cuestionario_2 WHERE codigo_usuario = $codigo ORDER BY id DESC";
        $usuario = mysqli_query($con, $sql);
        $filas   = mysqli_num_rows($usuario);

        if($filas){
            $exito = "si";
            //Obtener el nombre del codigo dentro de otra tabla
            $sql        = "SELECT nombre FROM usuarios WHERE codigo = $codigo";
            $res_nombre = mysqli_query($con, $sql);
            $res_nombre = mysqli_fetch_assoc($res_nombre); //Obtener arreglo de la consulta
        } else
            $exito = "no";
    }
?>
<!--Buscar-->
<label class="mx-2">Ingresa el código del alumno a buscar:</label>
<div class="d-flex align-items-center mt-2 mx-2">
    <form class="d-flex align-items-center mt-2" action="admin_consultar_cuestionario2.php" method="post">
        <input class="form-control col-6" type="text" name="codigo" id="codigo" placeholder="Código">
        <input class="btn btn-primary text-nowrap mx-3" type="submit" value="Buscar">
    </form>
</div>

<?php
    if($exito == "si"){
?>
    <!--Preguntas-->
    <div class="preguntas">
        <label>1-¿Cómo ha sido la sesión de hoy? (Evalúa del 1 al 10)</label> <br>
        <label>2-¿Sentiste alguna molestia o incomodidad de carácter muscular, tendinoso o ligamentoso?
            (Describe de forma breve si tu respuesta es SÍ)</label> <br>
        <label>3-¿Alguna actividad, ejercicio o movimiento te causó molestia o incomodidad?
            (Describe de forma breve si tu respuesta es SÍ)</label>
    </div>
    
    <!--Tabla--->
    <table class="table table-striped" border="2rem">
        <tr>
            <th colspan="6">Resultados cuestionario RPE</th>
        </tr>
        <tr class="table-headers bg-warning">
            <td>Fecha</td>
            <td>Código</td>
            <td>Nombre</td>
            <td>Pregunta 1</td>
            <td>Pregunta 2</td>
            <td>Pregunta 3</td>
        </tr>
        <?php
            while($row = $usuario->fetch_array()):
            $fecha  = $row["fecha"];

            $fecha_formato_mex = "$fecha"; //Convertir a string
            $fecha_formato_mex = date("d-m-y", strtotime($fecha_formato_mex)); //Convertir de string a date en el formato dia/mes/año

            $codigo =  $row["codigo_usuario"];
            $preg_1 = $row["preg_1"];
            $preg_2 = $row["preg_2"];
            $preg_3 = $row["preg_3"];
        ?>
        <tr class="table-content">
            <td> <?php echo $fecha_formato_mex; ?> </td>
            <td> <?php echo $codigo; ?> </td>
            <td> <?php echo $res_nombre["nombre"]; ?> </td>
            <td> <?php echo $preg_1; ?> </td>
            <td> <?php echo $preg_2; ?> </td>
            <td> <?php echo $preg_3; ?> </td>
        </tr>
        <?php endwhile ; ?>
    </table>
<?php
    }
    if($exito == "no") {
?>
    <script>alert("No existen cuestionarios con ese código");</script>
<?php
    $exito = null;
    }
?>

</body>
</html>