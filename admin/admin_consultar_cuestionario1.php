<?php
    session_start();
    $title = "Admin Cuestionario Bienestar";
    $_SESSION['title'] = $title;
    include_once('../views/nav_admin.php');

    $codigo = $_POST["codigo"];
    if($codigo){
        require "../funciones/conecta.php";
        $con = conecta();
        $sql = "SELECT * FROM cuestionario_1 WHERE codigo_usuario = $codigo ORDER BY id DESC";
        $usuario = $con->query($sql); //Query
        $filas = mysqli_num_rows($usuario); //Obtener numero de columnas

        if($filas){
            $exito = "si";
            //Obtener nombre del usuario con el código
            $sql = "SELECT nombre FROM usuarios WHERE codigo = $codigo";
            $res_nombre = mysqli_query($con, $sql);
            $res_nombre = mysqli_fetch_assoc($res_nombre); //Obtener arreglo con los registros
        }
        else
            $exito = "no";
    }
?>
<!--Buscar-->   
<label class="mx-2">Ingresa el código del alumno a buscar:</label>
<div class="d-flex align-items-center mt-2 mx-2">
    <form class="d-flex align-items-center mt-2" action="admin_consultar_cuestionario1.php" method="post" name="form_consulta">
        <input class="form-control col-6" type="text" name="codigo" id="codigo" placeholder="Código">
        <input class="btn btn-primary text-nowrap mx-3" type="submit" value="Buscar" placeholder="Código">
    </form>
</div>

<?php
    if($exito == "si"){
?>
    <div class="preguntas">
        <label>1-¿Qué tan fatigado te sientes en este monento? (1 nada. 5 bastante)</label> <br>
        <label>2-¿Qué tan bien has dormido la noche anterior? (1 muy bien. 5 muy mal)</label> <br>
        <label>3-¿Cuál es tu sensación de dolor/rigidez muscular hoy? (1 nada. 5 bastante dolor)</label> <br>
        <label>4-¿Qué tan estresado te encuentras previo al entrenamiento? (1 nada. 5 bastante)</label> <br>
        <label>5-¿Cuál es tu sensación de bienestar? (1 Excelente. 5 pésima)</label>
    </div>    

    <table class="table table-striped" border="2rem">
        <tr>
            <th colspan="8">Resultados cuestionario bienestar</th>
        </tr>
        <tr class="table-headers bg-warning">
        <td>Fecha</td>
         <td>Código</td>
         <td>Nombre</td>
         <td>Pregunta 1</td>
         <td>Pregunta 2</td>
         <td>Pregunta 3</td>
         <td>Pregunta 4</td>
         <td>Pregunta 5</td>
      </tr>
      <?php
        while($row = $usuario->fetch_array()): 
            $codigo  = $row["codigo_usuario"];
            //$nombre  = $row["nombre"];
            $fecha   = $row["fecha"];

            $fecha_formato_mex = "$fecha"; //Convertir a string
            $fecha_formato_mex = date("d-m-y", strtotime($fecha_formato_mex)); //Convertir de string a date en el formato dia/mes/año

            $preg_1  = $row["preg_1"];
            $preg_2  = $row["preg_2"];
            $preg_3  = $row["preg_3"];
            $preg_4  = $row["preg_4"];
            $preg_5  = $row["preg_5"];
      ?>
      <tr class="table_content">
         <td> <?php echo $fecha_formato_mex; ?> </td>
         <td> <?php echo $codigo; ?> </td>
         <td> <?php echo $res_nombre["nombre"]; ?> </td>
         <td> <?php echo $preg_1; ?> </td>
         <td> <?php echo $preg_2; ?> </td>
         <td> <?php echo $preg_3; ?> </td>
         <td> <?php echo $preg_4; ?> </td>
         <td> <?php echo $preg_5; ?> </td>
      </tr>      
      <?php endwhile; ?>
    </table>
<?php
    }
?>
<?php
    if($exito == "no") {
?>
    <script>alert("No existen cuestionarios con ese código");</script>
<?php
    $exito = null;
    }
?>

</body>
</html>