<?php
    session_start();
    $title = "Admin Registro de pruebas";
    $_SESSION["title"] = $title; 
    include_once("../views/nav_admin.php");
    //Variables vía enlace desde "admin_ver_usuarios.php al dar clic en 'Editar'
    $codigo = $_GET["codigo"];
    $nombre = $_GET["nombre"];    
?>

<script>
    function MostrarMensaje(){
        alert("¡Prueba registrada con éxito!");
    }
</script>

<div class="container">
    <div class="row">
        <div class="col">               
            <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">                                    
                <div class="p-3 mb-2 bg-danger bg-gradient fw-bold text-white">Registro Pruebas Físicas para: <?php echo $nombre; ?> </div>
                <form class="row g-3 needs-validation" id="cuestionario_2" method="post" action="../funciones/admin_registro_pruebas_sql.php">
                    <!--Obtener código-->
                    <input name="codigo" id="codigo" style='display:none;' value="<?php echo $codigo; ?>">
                    <!--Prueba 1-->
                    <div class="col-md-6 position-relative">
                        <label class="form-label">Bronco Test</label>
                        <input type="number" placeholder="Minutos"  class="form-control" name="p1_minutos" id="p1_minutos">
                        <input type="number" placeholder="Segundos" class="form-control" name="p1_segundos" id="p1_segundos">
                    </div>
                    <!--Prueba 2-->
                    <div class="col-md-6 position-relative">
                        <label class="form-label">Sprint 60 metros</label>
                        <input type="number" placeholder="Minutos"  class="form-control" name="p2_minutos"  id="p2_minutos">
                        <input type="number" placeholder="Segundos" class="form-control" name="p2_segundos" id="p2_segundos">
                    </div>                        
                    <!--Botón submit-->
                    <div class="col-6">
                        <button class="btn btn-warning fw-bold float-end" type="submit" onclick="MostrarMensaje();"> Enviar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!--
<form action="../funciones/admin_registro_pruebas_sql.php" method="post">
    <input type="text" name="codigo" id="codigo" style='display:none;' value="<?php //echo $codigo; ?>">
    
    <h2>Prueba 1:</h2>
    <label>Bronco test</label> <br>
    <label>Minutos</label>
    <input type="number" name="p1_minutos" id="p1_minutos">
    <label>Segundos</label>
    <input type="number" name="p1_segundos" id="p1_segundos">

    <h2>Prueba 2:</h2>
    <label>Sprint 60 metros</label> <br>
    <label>Minutos</label>
    <input type="number" name="p2_minutos" id="p2_minutos">
    <label>Segundos</label>
    <input type="number" name="p2_segundos" id="p2_segundos">

    <br>
    <input type="submit" value="Enviar" onclick="MostrarMensaje();">
</form>
-->