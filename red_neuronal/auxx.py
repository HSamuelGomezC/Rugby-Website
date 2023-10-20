#Conexion de la BD

import pymysql
import tensorflow as tf
#import matplotlib.pyplot as plt #gráfica
import subprocess


def RedNeuronal():
    # Configurar la información de conexión
    host = '82.180.172.103'
    user = 'u292477693_root'
    password = 'LJwG?Ub7.'
    db_name = 'u292477693_rugby'

    # Conectar a la base de datos
    connection = pymysql.connect(
        host=host,
        user=user,
        password=password,
        db=db_name,
        cursorclass=pymysql.cursors.DictCursor
    )
    
    try:
     #datos = 0
     with connection.cursor() as cursor:
            # Ejecutar una consulta SQL
         sql_query = "SELECT peso, altura, anio_nac, rank FROM usuarios"
         cursor.execute(sql_query)
         features = [] #Arreglo de peso, altura y año de nacimiento
         targets = []#Arreglo de ranks

         results = cursor.fetchall()
         for row in results:
             features.append((row['peso'],row['altura'],row['anio_nac']))
             targets.append(row['rank'])
            
         mensaje = str(len(features)) + ': datos cargados de la BD'
         print("\n" + mensaje + '\n')
    finally:
    # Cerrar la conexión
        connection.close()


    capaEntrada = tf.keras.layers.Dense(units=3, input_shape=[3]) # Capa de entrada con 3 neuronas, una para cada entrada que en este caso son 3 (peso,altura,año de nacimiento)
    capaOculta  = tf.keras.layers.Dense(units=4) # Capa oculta con 3 neuronas para los calculos
    capaSalida  = tf.keras.layers.Dense(units=1) # Capa de salida con una sola neurona, que se encargara de mostrar la clasificacion (JP,JM o JB)

    modelo = tf.keras.Sequential([capaEntrada, capaOculta, capaSalida]) # Modelo secuencial para este sistema, e indicando el orden de las capas

    modelo.compile( #Compilar el modelo para preparar su aprendizaje
        optimizer = tf.keras.optimizers.Adam(0.1), # Optimizador, que recibe su tasa de aprendizaje, para que sea lo mas preciso posible
        loss = 'mean_squared_error' # Perdida, en este caso se utilizo el error cuadratico medio para obtener un resultado optimo
    )

    print('Inicio de entrenamiento...') # Print para iniciar el entrenamiento

    modelo.fit(features,targets, epochs = 500, verbose = False) # Almacenar el resulta dodel entrenamiento, que le pasaremos las entradas, salidas y la repeticion de entrenamiento
    
    loss = modelo.evaluate(features, targets)
    print("Pérdida en el conjunto de prueba:", loss)

    #Para gráfica
    '''
    historial = modelo.fit(features,targets, epochs = 600, verbose = False) # Almacenar el resulta dodel entrenamiento, que le pasaremos las entradas, salidas y la repeticion de entrenamiento
    
    plt.xlabel('#Época') # Graficar la magnitud de pertida ha decrecido
    plt.ylabel('Magnitud de perdida')
    plt.plot(historial.history['loss'])
    plt.show() #Mostrar la grafica 
    '''

    print('Modelo Entrenado!') # Print para termino del entrenamiento
    modelo.save('Datos_jugadores.h5') #Exportar el modelo en formato h5 

    comando = f"tensorflowjs_converter --input_format keras Datos_jugadores.h5 ." #Variable que se utiliza para guardar el comando que se quiere utilizar
    subprocess.run(comando, shell=True, check= True)#Utilizando la libreria subprocess se ejecuta el comando ya definido, 'shell' permite que el comando se ejecute en una shell y 'check' garantiza que el proceso se detenga si se encuentra algun error en la ejecucion del comando

RedNeuronal()
