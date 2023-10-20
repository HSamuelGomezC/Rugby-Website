<?php
//////////////Código PHP Backend//////////////////
   session_start();
   $title = "Admin Ver Usuarios";
   $_SESSION['title'] = $title;
   include_once('../views/nav_admin.php');

   $codigo = $_POST["codigo"];
   require "../funciones/conecta.php";
   $con     = conecta();

   $exito = null;
   $mostrar_todo = true;
   if($codigo){ //En caso de que se haya decidido filtrar resultados
      $orden   = $_POST["orden"]; //Decidir cómo filtrarlo
      if($orden == 0 || $orden == 1)
         $sql     = "SELECT * FROM pruebas_fisicas WHERE codigo_usuario = $codigo
         ORDER BY id DESC";
      else if($orden == 2)
         $sql     = "SELECT * FROM pruebas_fisicas WHERE codigo_usuario = $codigo
         ORDER BY prueba_1 ASC";
      else if($orden == 3)
         $sql     = "SELECT * FROM pruebas_fisicas WHERE codigo_usuario = $codigo
         ORDER BY prueba_2 ASC";
         
      $usuario = mysqli_query($con, $sql);
      $filas   = mysqli_num_rows($usuario);
      if($filas){
         $mostrar_todo = null; //Como se buscó un resultado entonces no mostraremos todo
         $exito      = "si";
         $sql        = "SELECT nombre FROM usuarios WHERE codigo = $codigo";
         $res_nombre = mysqli_query($con, $sql);
         $res_nombre = mysqli_fetch_assoc($res_nombre); 
      } else
         $exito = "no";
   } else { //Decidir orden
      $orden   = $_POST["orden"]; //Decidir cómo filtrarlo
      if($orden == 0 || $orden == 1)
         $sql   = "SELECT * FROM pruebas_fisicas ORDER BY id DESC";
      else if ($orden == 2)
         $sql   = "SELECT * FROM pruebas_fisicas ORDER BY prueba_1 ASC";
      else if ($orden == 3)
         $sql   = "SELECT * FROM pruebas_fisicas ORDER BY prueba_2 ASC";
      $mostrar_todo  = mysqli_query($con, $sql);
   }
?>
<script src="../funciones/jquery-3.3.1.min.js"></script>
<script>
///////////////Función para eliminar pruebas físicas de JavaScript//////////////////
   function Eliminar(id){
      var mensaje = "¿Estás seguro que deseas eliminar esta prueba?";
      var respuesta = confirm(mensaje);
      if(respuesta) {
      $.ajax({
      url      : '../funciones/admin_eliminar_prueba.php?id='+id,
      type     : 'post',
      dataType : 'text',
      data     : 'id='+id,
      success : function(res) {
         if(res) {
            $('#fila'+id).remove(); //Eliminar la fila sin necesidad de actualizar navegador
            alert("Prueba eliminada con éxito");
         } else {
            alert("Ocurrió un error, intenta más tarde");
         }
      }, error: function() {
         alert('Error, archivo no encontrado...');
      }
      });
   }
}
</script>
<!--Buscar-->
<label class="mx-2">Ingresa el código del alumno a buscar:</label>
<div class="d-flex align-items-center mt-2 mx-2">
   <form class="d-flex align-items-center mt-2" action="admin_consultar_pruebas.php" method="post">
      <input class="form-control col-6" type="text" name="codigo" id="codigo" placeholder="Código"
      value="<?php if($exito == "si") echo $codigo; ?>">
      <select name="orden" id="orden" class="form-select" style="width: 10rem;">
         <option value="0">Seleccionar</option>
         <option value="1">Orden por fecha</option>
         <option value="2">Orden por prueba 1</option>
         <option value="3">Orden por prueba 2</option>
      </select>
      <input class="btn btn-primary text-nowrap mx-3" type="submit" value="Enviar">
   </form>
</div>

<?php
   if($mostrar_todo && $exito != "no"){
?>
<!--!!!!!!!!!!!!!!!! Tabla de todas las pruebas  !!!!!!!!!!-->
   <table class="table table-striped" border="2rem">
      <tr>
         <th colspan="6">Resultados pruebas físicas</th>
      </tr>
      <tr class="table-headers bg-warning">
         <td style="display: none;">ID</td> <!--Solo para eliminaciones, por lo tanto no se muestra-->
         <td>Fecha</td>
         <td>Nombre</td>
         <td>Código</td>
         <td>Prueba 1</td>
         <td>Prueba 2</td>
         <td>Acciones</td>
      </tr>
      <?php
         while($row = $mostrar_todo->fetch_array()):
            $id       = $row["id"]; //Código de prueba solo para eliminaciones
            $fecha    = $row["fecha"];
            $codigo   = $row["codigo_usuario"];

            $sql = "SELECT nombre FROM usuarios WHERE codigo = $codigo";
            $nombre = mysqli_query($con, $sql);
            $nombre = mysqli_fetch_assoc($nombre);

            $prueba_1 = $row["prueba_1"];
            $prueba_2 = $row["prueba_2"];

            $fecha_formato_mex = "$fecha"; //Convertir a string
            $fecha_formato_mex = date("d-m-y", strtotime($fecha_formato_mex)); //Convertir de string a date en el formato dia/mes/año
      ?>
      <tr class="table-content" id="fila<?=$id;?>">
         <td style="display: none;"> <?php echo $id; ?> </td>
         <td> <?php echo $fecha_formato_mex; ?> </td>
         <td> <?php echo $nombre["nombre"]; ?> </td>
         <td> <?php echo $codigo; ?> </td>
         <td> <?php echo $prueba_1; ?> </td>
         <td> <?php echo $prueba_2; ?> </td>
         <!--Botón para eliminar mandando llamar la función con AJAX-->
         <td> <a href="javascript:void(0);" onClick="Eliminar(<?=$id;?>);">Eliminar</a> </td>
      </tr>
      <?php endwhile; ?>
   </table>
<?php
   }
?>

<?php
   if($exito == "si"){
?>
<!--!!!!!!!!!!! Tabla de pruebas filtradas por código !!!!!!!!!!!-->
   <table class="table table-striped" border="2rem">
      <tr>
         <th colspan="6">Resultados pruebas físicas</th>
      </tr>
      <tr class="table-headers bg-warning">
         <td style="display: none;">ID</td> <!--Solo para eliminaciones, por lo tanto no se muestra-->
         <td>Fecha</td>
         <td>Código</td>
         <td>Nombre</td>
         <td>Prueba 1</td>
         <td>Prueba 2</td>
         <td>Acciones</td>
      </tr>
      <?php
         while($row = $usuario->fetch_array()):
            $id       = $row["id"]; //Solo para eliminaciones
            $fecha    = $row["fecha"];
            $codigo   = $row["codigo_usuario"];
            $prueba_1 = $row["prueba_1"];
            $prueba_2 = $row["prueba_2"];

            $fecha_formato_mex = "$fecha"; //Convertir a string
            $fecha_formato_mex = date("d-m-y", strtotime($fecha_formato_mex)); //Convertir de string a date en el formato dia/mes/año
      ?>
      <tr class="table-user-content" id="fila<?=$id;?>">
         <td style="display: none;"> <?php echo $id; ?> </td> <!--No lo mostramos porque solo será para eliminación-->
         <td> <?php echo $fecha_formato_mex; ?> </td>
         <td> <?php echo $codigo; ?> </td>
         <td> <?php echo $res_nombre["nombre"]; ?> </td>
         <td> <?php echo $prueba_1; ?> </td>
         <td> <?php echo $prueba_2; ?> </td>
         <td> <a href="javascript:void(0);" onClick="Eliminar(<?=$id;?>);">Eliminar</a> </td>
      </tr>
      <?php endwhile; ?>
   </table>
<?php
   }
   if($exito == "no"){
?>
   <script>alert("No existen pruebas con ese código");</script>
<?php
   $exito = null;
   }
?>

</body>
</html>