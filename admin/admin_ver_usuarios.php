<?php
session_start();
$title = "Admin Ver Usuarios";
$_SESSION['title'] = $title;
include_once('../views/nav_admin.php');

require "../funciones/conecta.php";

// Verificar si el formulario ha sido enviado y obtener el valor del filtro
if (isset($_POST["filtro"])) {
   $filtro = $_POST["filtro"];
} else {
   $filtro = "";
}

function MostrarTabla($filtro) {
   $con = conecta();
   // Construir la consulta SQL de acuerdo con el filtro proporcionado
   $sql = "SELECT * FROM usuarios";

   if ($filtro) {
      $filtro = $con->real_escape_string($filtro); // Evitar inyección SQL
      $sql .= " WHERE codigo LIKE '%$filtro%' OR nombre LIKE '%$filtro%' OR anio_nac LIKE '%$filtro%' OR rank LIKE '%$filtro%'";
   }

   $sql .= " ORDER BY nombre ASC";

   $res = $con->query($sql);
   return $res;
}

$res = MostrarTabla($filtro);
?>

<script src="../funciones/jquery-3.3.1.min.js"></script>
<script>
function Eliminacion(codigo) {
   var mensaje = "¿Estás seguro que deseas eliminar este registro?";
   var respuesta = confirm(mensaje);
   if(respuesta) {
      $.ajax({
         url: 'admin_eliminar_usuarios.php?codigo='+codigo,
         type: 'post',
         dataType: 'text',
         data: 'codigo='+codigo,
         success: function(res) {
            if(res) {
               $('#fila'+codigo).remove(); //Eliminar la fila sin necesidad de actualizar navegador
               alert("Registro eliminado con éxito");
            } else {
               alert("Ocurrió un error, intenta más tarde");
            }
         },
         error: function() {
            alert('Error, archivo no encontrado...');
         }
      });
   }
}
</script>

<div class="table_container">
   <!--Botón-->
   <a class="btn btn-primary mr-2 text-nowrap" role="button" href="../users/user_registro_form.php" id="btn_new">
      Agregar nuevo usuario
   </a>
   <!--Filtro-->   
   <div class="d-flex align-items-center mt-2">
      <form action="admin_ver_usuarios.php" method="post" class="mx-2 d-flex">
         <input type="text" class="form-control col-6" name="filtro" placeholder="Filtrar:" value="<?= htmlspecialchars($filtro); ?>">
         <button class="btn btn-primary text-nowrap mx-3" type="submit">Filtrar</button>
      </form>
   </div>
   <!--Table-->
   <table class="table table-striped" border="2rem">
      <tr>
         <th colspan="10" id="title">Listado de usuarios</th>
      </tr>
      <tr class="table-headers bg-warning">
         <td>Código</td>
         <td>Nombre</td>
         <td>Peso</td>
         <td>Altura</td>
         <td>Correo</td>
         <td>Año de nacimiento</td>
         <td>Rank</td>
         <td colspan="3">Acciones</td>
      </tr>
      <?php
         while ($row = $res->fetch_array()): 
            $codigo   = $row["codigo"];
            $nombre   = $row["nombre"];
            $peso     = $row["peso"];
            $altura   = $row["altura"];
            $correo   = $row["correo"];
            $anio_nac = $row["anio_nac"];
            $rank     = $row["rank"]; 
      ?>
      <tr class="table_content" id="fila<?=$codigo;?>">
         <td> <?php echo $codigo; ?> </td>
         <td> <?php echo $nombre; ?> </td>
         <td> <?php echo $peso; ?> </td>
         <td> <?php echo $altura; ?> </td>
         <td> <?php echo $correo; ?> </td>
         <td> <?php echo $anio_nac; ?> </td>
         <td> <?php echo $rank; ?> </td>
         <td> <a href="admin_editar_form.php?codigo=<?=$codigo;?>">Editar</a><br> </td>
         <td> <a href="javascript:void(0);" onClick="Eliminacion(<?=$codigo;?>);">Eliminar</a> </td>
         <td> <a href="../admin/admin_registrar_pruebas.php?codigo=<?=$codigo;?>&nombre=<?=$nombre;?>">Registrar pruebas</a> </td>
      </tr>      
      <?php endwhile; ?>  
   </table>
</div>
</body>
</html>
