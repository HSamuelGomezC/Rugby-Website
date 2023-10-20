<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="obtener_rank.js"></script>
    <!--Tensorflow-->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script>
        var modelo = null;
        CargarModelo();
        function ValidarCodigo(){
            var codigo = registro.codigo.value;
            var codigo = registro.codigo.value;
            // En caso de que sea mayor o igual a 8 caracteres y sea completamente númerico, será válido
            if ((codigo.length >= 9) && (/^\d+$/.test(codigo))) {
                return true;
            } else {
                return false;
            }
        }
        function ValidarCorreo(){
            var correo = registro.correo.value;
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (regex.test(correo)) {
                return true;
            } 
            return false;
        }
        function ValidarContrasena(){
            if(registro.password.value.length >= 7) {
                return true;
            } else 
                return false;
        }
        function ValidarCampos() {
            var codigo_valido     = ValidarCodigo();
            var correo_valido     = ValidarCorreo();
            var contrasena_valida = ValidarContrasena();
            //Validar campos llenos
            if (!registro.codigo.value || !registro.nombre.value || !registro.peso.value || !registro.altura.value
                || !registro.correo.value || !registro.password.value || !registro.anio_nac.value) {
                alert("Faltan campos por llenar");
                return false; 
            }
            else if (!codigo_valido){
                alert("Ingrese un código UDG válido");
                return false;
            }
            else if (!correo_valido){
                alert("Ingrese un correo válido")
                return false;
            }
            else if (!contrasena_valida) {
                alert("Ingrese una contraseña con al menos 7 caracteres");
                return false; 
            }
            else 
                return ObtenerRank();
        }
        
        async function CargarModelo() {
            console.log("Cargando el modelo...");
            modelo = await tf.loadLayersModel("../red_neuronal/model.json");
            console.log("Modelo cargado :)");
        } 
        
        
        function ObtenerRank() {
            var año = document.getElementById('anio_nac').value;
            
            var añoParse = parseInt(año);

            if (año > 2005 || año < 1963){ //17 - 61 años
                alert("Edad no permitida para el entrenamiento");
                return false;
            }
            var pso = document.getElementById('peso').value;
            var altura = document.getElementById('altura').value;

            if (modelo != null) {
                //var tensor = tf.tensor2d([[parseInt(pso), parseInt(altura), parseInt(año)]]);
                var tensor = tf.tensor2d([[parseInt(pso), parseInt(altura)]]);
                var prediccion = modelo.predict(tensor).dataSync();

                //alert("prediccion antes del if: "+ prediccion);
                prediccion = parseFloat(prediccion); //Convertir texto a flotante

                if (año > 1999) //2000 para arriba
                    prediccion += 0.5;
                else if (año < 1999 && año > 1989) // 1990 - 1999
                    prediccion += 0.2;
                else if (año < 1989 && año > 1979) // 1980 - 1989
                    prediccion -= 0.5;
                else if (año < 1979) // > 1980
                    prediccion -= 1;

                prediccion = prediccion.toFixed(2); //Truncar 2 decimales
                //alert("prediccion después del IF: "+ prediccion);

                if (prediccion > 3)
                    prediccion = 3;
                if (prediccion < 0)
                    prediccion = 0;

                alert("Rank: "+ prediccion);

            } else {
                alert("Inténtalo de nuevo");
                return;
            }
            var rank = document.getElementById('rank');
            rank.value = prediccion;
            return true;
        }
    </script>
        <!-- Boostrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <!--Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--CSS-->
        <link rel="stylesheet" href="styles/user_registro.css">
</head>
<body class="bg-dark d-flex justify-content-center align-items-center vh-100 ">
    <!--Contenedor del form blanco-->
    <div class="bg-white p-5 rounded-5 text-secondary " style="width: 25rem;">
        <!--Texto: Registro-->
        <div class="text-center fs-1 fw-bold">Registro</div>
            <form action="../funciones/user_insertar_sql.php" method="POST" name="registro">
                    <!--Código-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"> </div>
                        <input class="form-control" type="number" name="codigo" placeholder="Código UDG">
                    </div>
                    <!--Nombre-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"> </div>
                        <input class="form-control" type="text" name="nombre" placeholder="Nombre">
                    </div>
                    <!--Peso-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="number" id="peso" name="peso" placeholder="Peso (kg)" step="any">
                    </div>
                    <!--Altura-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="number" id="altura" name="altura" placeholder="Altura (cm)">
                    </div>
                    <!--Correo-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="mail" name="correo" placeholder="Correo">
                    </div>
                    <!--Password-->
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="password" name="password" placeholder="Contraseña (7 min. Caracteres)" onblur="ValidarContrasena();">
                    </div>
                    <!--Año de nacimiento-->
                    <p class="text-center fw-bold" id="fecha_label">Año de nacimiento:</p>
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-warning"></div>
                        <input class="form-control" type="number" id="anio_nac" name="anio_nac" placeholder="Año de nacimiento">
                    </div>     
                    <!--RANK-->
                    <input type="hidden" id="rank" name="rank">
                <!--Botón enviar-->
                <input type="submit" class="btn btn-danger text-white w-100 mt-4 fw-semibold shadow-sm" 
                    name="registrar" value="Enviar" onclick="return ValidarCampos();"
                />                
            </form>
        <div class="d-flex gap-1 justify-content-center mt-1">
            <a href="../index.php" class="text-decoration-none text-danger fw-semibold ">Cancelar</a>
        </div>
    </div>
    <div id="resultado"></div>
</body>
</html>