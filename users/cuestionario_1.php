<?php
    session_start();
    $_SESSION['title'] = "User Cuestionario Bienestar";
    $fecha = $_SESSION["fecha"];
    include_once('../views/nav_user.php');
?>

<script>
    function MostrarMensaje() {
        alert("¡Cuestionario 1 contestado con éxito!");
    }
</script>

<?php
if(!$fecha) { //Si no han contestado el cuestionario, mostrar el cuestionario
?>
    <div class="container">
        <div class="row">
            <div class="col">               
                <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">                                    
                    <div class="p-3 mb-2 bg-danger bg-gradient fw-bold text-white">Cuestionario de Bienestar</div>
                    <form class="row g-3 needs-validation" id="cuestionario_1" method="post" action="../funciones/user_cuestionario1.php">
                        <!--Obtener código-->
                        <input name="codigo" id="codigo" style='display:none;' value="<?php echo $res['codigo']; ?>">
                        <!--Pregunta 1-->
                        <div class="col-md-12 position-relative">
                            <label class="form-label">¿Qué tan fatigado te sientes en este momento? (1 nada. 5 bastante)</label>
                            <select class="form-select" name="preg_1" id="preg_1" required>
                                <option selected disabled value="">Seleccione...</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <!--Pregunta 2-->
                        <div class="col-md-12 position-relative">
                            <label class="form-label">¿Qué tan bien has dormido la noche anterior? (1 muy bien. 5 muy mal)</label>
                            <select class="form-select" name="preg_2" id="preg_2" required>
                                <option selected disabled value="">Seleccione...</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <!--Pregunta 3-->
                        <div class="col-md-12 position-relative">
                            <label class="form-label">¿Cuál es tu sensación de dolor/rigidez muscular hoy? (1 nada. 5 bastante dolor)</label>
                            <select class="form-select" name="preg_3" id="preg_3" required>
                                <option selected disabled value="">Seleccione...</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <!--Pregunta 4-->
                        <div class="col-md-12 position-relative">
                            <label class="form-label">¿Qué tan estresado te encuentras previo al entrenamiento? (1 nada. 5 bastante)</label>
                            <select class="form-select" name="preg_4" id="preg_4" required>
                                <option selected disabled value="">Seleccione...</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <!--Pregunta 5-->
                        <div class="col-md-12 position-relative">
                            <label class="form-label">¿Cuál es tu sensación de bienestar? (1 Excelente. 5 pésima)</label>
                            <select class="form-select" name="preg_5" id="preg_5" required>
                                <option selected disabled value="">Seleccione...</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <!--Botón submit-->
                        <div class="col-6">
                            <button class="btn btn-warning fw-bold float-end" type="submit" onclick="MostrarMensaje();">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
}
else { //En caso de YA haber contestado el cuestionario
?>
    <p class="mensaje">Ya has contestado el cuestionario de bienestar hoy</p>
<?php
}
?>
</body>
</html>

<!--
    <form id="cuestionario_1" method="post" action="../funciones/user_cuestionario1.php">
        <input name="codigo" id="codigo" style='display:none;' value="<?php echo $res['codigo']; ?>">
        <label>Nombre: </label> <label><?php echo $res['nombre']; ?></label> <br>
        <label>¿Qué tan fatigado te sientes en este monento? (1 nada. 5 bastante)</label>
        <select name="preg_1" id="preg_1">
            <option value="0">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select> <br>
        <label>¿Qué tan bien has dormido la noche anterior? (1 muy bien. 5 muy mal)</label>
        <select name="preg_2" id="preg_2">
            <option value="0">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select> <br>
        <label>¿Cuál es tu sensación de dolor/rigidez muscular hoy? (1 nada. 5 bastante dolor)</label>
        <select name="preg_3" id="preg_3">
            <option value="0">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select> <br>
        <label>¿Qué tan estresado te encuentras previo al entrenamiento? (1 nada. 5 bastante)</label>
        <select name="preg_4" id="preg_4">
            <option value="0">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select> <br>
        <label>¿Cuál es tu sensación de bienestar? (1 Excelente. 5 pésima)</label>
        <select name="preg_5" id="preg_5">
            <option value="0">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select> <br>
        <input type="submit" name="enviar" value="Enviar" onclick="MostrarMensaje();">
    </form>
-->