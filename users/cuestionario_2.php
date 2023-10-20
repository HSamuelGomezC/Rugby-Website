<?php
    session_start();
    $_SESSION['title'] = "User Cuestionario RPE";
    $fecha = $_SESSION["fecha2"];
    include_once('../views/nav_user.php');
?>
<script>
    function Otros(val, nombre){
        var describir = document.getElementById(nombre);
        
        if(val == "1"){ //Si la opción fue "Describir... Mostrará el input para obtener el valor"
            describir.style.display='block';
        } else {
            describir.style.display='none';
        }
    }
    function MostrarMensaje() {
        alert("¡Cuestionario 2 contestado con éxito!");
    }
</script>

<?php
if(!$fecha){ //Si no han contestado el cuestionario, mostrar el cuestionario
?>
    <div class="container">
        <div class="row">
            <div class="col">               
                <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">                                    
                    <div class="p-3 mb-2 bg-danger bg-gradient fw-bold text-white">Cuestionario RPE</div>
                    <form class="row g-3 needs-validation" id="cuestionario_2" method="post" action="../funciones/user_cuestionario2.php">
                        <!--Obtener código-->
                        <input name="codigo" id="codigo" style='display:none;' value="<?php echo $res['codigo']; ?>">
                        <!--Pregunta 1-->
                        <div class="col-md-12 position-relative">
                            <label class="form-label">¿Cómo ha sido la sesión de hoy? (Evalúa del 1 al 10)</label>
                            <select class="form-select" name="preg_1" id="preg_1" required>
                                <option selected disabled value="">Seleccione...</option>
                                <option value="1"> 1. Nada</option>
                                <option value="2"> 2. Muy Fácil</option>
                                <option value="3"> 3. Fácil</option>
                                <option value="4"> 4. Confortable</option>
                                <option value="5"> 5. Un poco difícil</option>
                                <option value="6"> 6. Difícil</option>
                                <option value="7"> 7. Más que dífícil</option>
                                <option value="8"> 8. Muy difícil</option>
                                <option value="9"> 9. Extremadamente difícil</option>
                                <option value="10">10. Máxima Exhaustiva</option>
                            </select>
                            <!-- Mensajes para validación   -->
                            <div class="valid-tooltip">¡Campo válido!</div>
                            <div class="invalid-tooltip">Debe completar los datos.</div>
                        </div>
                        <!--Pregunta 2-->
                        <div class="col-md-12 position-relative">
                            <label class="form-label">¿Sentiste alguna molestia o incomodidad de carácter muscular, tendinoso o ligamentoso? (Describe de forma breve si tu respuesta es SÍ)</label>
                            <select class="form-select" name="preg_2" id="preg_2" onchange='Otros(this.value, "describir_"+this.id);'> <!-- 1Param = valor del select, 2Param = 'preg_2' -->
                                <option value="0"> No </option>
                                <option value="1"> Describir... </option>
                            </select>
                            <input type="text" class="form-control" name="describir_preg_2" id="describir_preg_2" style='display:none;'/>
                        </div>
                        <!--Pregunta 3-->
                        <div class="col-md-12 position-relative">
                            <label class="form-label">¿Alguna actividad, ejercicio o movimiento te causó molestia o incomodidad? (Describe de forma breve si tu respuesta es SÍ)</label>
                            <select class="form-select" name="preg_3" id="preg_3" onchange='Otros(this.value, "describir_"+this.id);'>
                                <option value="0"> No </option>
                                <option value="1"> Describir... </option>
                            </select>
                            <input type="text" class="form-control" name="describir_preg_3" id="describir_preg_3" style='display:none;'/>
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

<?php
}
else {
?>
    <p class="mensaje">Ya has contestado el cuestionario RPE hoy</p>
<?php
}
?>
</body>
</html>

<!--
<form class="cuestionario_2" method="post" action="../funciones/user_cuestionario2.php">
        <input name="codigo" id="codigo" style='display:none;' value="<?php //echo $res['codigo']; ?>">
        <label>Nombre: </label> <label><?php //echo $res['nombre']; ?></label> <br>
        <label>¿Cómo ha sido la sesión de hoy? (Evalúa del 1 al 10)</label>
        <select name="preg_1" id="preg_1">
            <option value="0">Seleccionar</option>
            <option value="1"> 1. Nada</option>
            <option value="2"> 2. Muy Fácil</option>
            <option value="3"> 3. Fácil</option>
            <option value="4"> 4. Confortable</option>
            <option value="5"> 5. Un poco difícil</option>
            <option value="6"> 6. Difícil</option>
            <option value="7"> 7. Más que dífícil</option>
            <option value="8"> 8. Muy difícil</option>
            <option value="9"> 9. Extremadamente difícil</option>
            <option value="10">10. Máxima Exhaustiva</option>
        </select> <br>
        <label>¿Sentiste alguna molestia o incomodidad de carácter muscular, tendinoso o ligamentoso?
            (Describe de forma breve si tu respuesta es SÍ)</label>
        <select name="preg_2" id="preg_2" onchange='Otros(this.value, "describir_"+this.id);'> 
        <option value="0">No</option>
            <option value="1">Describir...</option>
        </select> <br>
        <input type="text" name="describir_preg_2" id="describir_preg_2" style='display:none;'/>
        <label>¿Alguna actividad, ejercicio o movimiento te causó molestia o incomodidad?
            (Describe de forma breve si tu respuesta es SÍ)</label>
        <select name="preg_3" id="preg_3" onchange='Otros(this.value, "describir_"+this.id);'>
            <option value="0">No</option>
            <option value="1">Describir...</option>
        </select>
        <input type="text" name="describir_preg_3" id="describir_preg_3" style='display:none;'/>
        
        <br>
        <input type="submit" name="enviar" value="Enviar" onclick="MostrarMensaje();">
    </form>
-->