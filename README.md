# API_REST_Restaurante

1. [Descripción proyecto](#descripción-proyecto)
    1. [Enunciado prueba de código](#enunciado-prueba-de-código)
2. [Documentación API REST](#documentación-api-rest)
	1. [Obtener la lista de alérgenos de un plato](#obtener-la-lista-de-alérgenos-de-un-plato)
	2. [Obtener la lista de platos de un alérgeno](#obtener-la-lista-de-platos-de-un-alérgeno)
	3. [Dar de alta un alérgeno](#dar-de-alta-un-alérgeno)
	4. [Dar de alta un ingrediente](#dar-de-alta-un-ingrediente)
	5. [Dar de alta un plato](#dar-de-alta-un-plato)
	6. [Modificar los ingredientes de un plato](#modificar-los-ingredientes-de-un-plato)
3. [Decisiones de diseño](#decisiones-de-diseño)
	1. [Base de datos MySQL](#base-de-datos-mysql)
	2. [Tecnología](#tecnología)
	3. [Arquitectura](#arquitectura)
		1. [Casos de uso](#casos-de-uso)
		2. [Capas](#capas)

## Descripción proyecto
Este proyecto es la implementación de la siguiente prueba de código, utilizando __PHP__, __MySQL__ y __Laravel__:

### Enunciado prueba de código
Debido a una nueva legislación, los restaurantes necesitan tener información disponible acerca de los alérgenos que tiene cada plato que sirven. Un plato tiene varios ingredientes, y un ingrediente puede tener varios alérgenos.

Un restaurante ha contratado una aplicación movil que gestione para sus camareros cualquier duda de los clientes acerca de esta materia. La implementación de dicha app nos es transparente, salvo porque hace uso de una API Rest que le servirá la información que necesita.

Implementa un pequeño sistema que se componga de:

* - [x] Una base de datos que almacene los platos y sus alérgenos.
* - [x] Una API Rest que devuelva los alérgenos de un plato dado, o los platos en los que aparece un alérgeno concreto, y permita añadir ingredientes, platos y alérgenos.
* - [x] No será necesario un sistema de usuarios ni roles.
* - [x] Bonus: Supongamos que un cocinero puede realizar cambios sobre los ingredientes de un plato. Diseña y, si puedes, implementa un sistema para que quede un registro de cambios sobre los platos.

Se valorará positivamente:
* - [x] Tests automáticos
* - [x] Seguir principios de clean code
* - [x] Uso de principios arquitectónicos y patrones para el desacoplamiento entre capas


## Documentación API REST

1. [Obtener la lista de alérgenos de un plato](#obtener-la-lista-de-alérgenos-de-un-plato)
2. [Obtener la lista de platos de un alérgeno](#obtener-la-lista-de-platos-de-un-alérgeno)
3. [Dar de alta un alérgeno](#dar-de-alta-un-alérgeno)
4. [Dar de alta un ingrediente](#dar-de-alta-un-ingrediente)
5. [Dar de alta un plato](#dar-de-alta-un-plato)
6. [Modificar los ingredientes de un plato](#modificar-los-ingredientes-de-un-plato)

### Obtener la lista de alérgenos de un plato
    
* #### Ruta
	/api/obtenerAlergenosDePlato
* #### Método
	GET
* #### Parametros URL o POST
	* Obligatorios
		* nombre=[string] : El nombre del plato del que se obtendrán sus alérgenos.
		
			_Ejemplo:_ nombre=Merluza a las 3 salsas
	* Opcionales
* #### Respuesta satisfactoria
	* Código: 200
	* Contenido: Lista de alérgenos en formato JSON o lista vacía.

		_Ejemplo_: ["pescado","gluten"]
* #### Respuestas de error
	* Código: 400
	* Contenido: {"errores":{"nombreVariable1":["Causa del error1"], ...}}
	* Causas de error:
		* El atributo nombre es necesario
		* El atributo nombre no existe en la base de datos
		* El atributo nombre no es un string
		
		
* #### Ejemplo de uso
	* Llamada
		```
		GET localhost:8000/api/obtenerAlergenosDePlato?nombre=merluza a las 3 salsas
		```
	* Resultado
		```
		[
		    "pescado",
		    "crustáceos",
		    "sésamo",
		    "frutos secos",
		    "gluten",
		    "leche",
		    "mostaza",
		    "soja",
		    "sulfitos"
		]
		```

### Obtener la lista de platos de un alérgeno
    
* #### Ruta
	/api/obtenerPlatosDeAlergeno
* #### Método
	GET
* #### Parametros URL o POST
	* Obligatorios
		* nombre=[string] : El nombre del plato del que se obtendrán sus alérgenos.
		
			_Ejemplo:_ nombre=Merluza a las 3 salsas
	* Opcionales
* #### Respuesta satisfactoria
	* Código: 200
	* Contenido: Lista de platos en formato JSON o lista vacía.

		_Ejemplo_: ["merluza a las 3 salsas","tosta de tomate"]
* #### Respuestas de error
	* Código: 400
	* Contenido: {"errores":{"nombreVariable1":["Causa del error1"], ...}}
	* Causas de error:
		* El atributo nombre es necesario
		* El atributo nombre no existe en la base de datos
		* El atributo nombre no es un string
* #### Ejemplo de uso
	* Llamada
		```
		GET localhost:8000/api/obtenerPlatosDeAlergeno?nombre=leche
		```
	* Resultado
		```
		[
		    "gambas al roquefort",
		    "merluza a las 3 salsas",
		    "revuelto de gambas con merluza"
		]
		```
### Dar de alta un alérgeno
    
* #### Ruta
	/api/altaAlergeno
* #### Método
	PUT
* #### Parametros URL o POST
	* Obligatorios
		* nombre=[string]
		
			_Ejemplo:_ nombre=lactosa
	* Opcionales
* #### Respuesta satisfactoria
	* Código: 201
	* Contenido: Nombre del alérgeno dado de alta en formato JSON

		_Ejemplo_: {"nombre": "lactosa"}
* #### Respuestas de error
	* Código: 400
	* Contenido: {"errores":{"nombreVariable1":["Causa del error1"], ...}}
	* Causas de error:
		* El atributo nombre es necesario
		* El atributo nombre no existe en la base de datos
		* El atributo nombre no es un string
* #### Ejemplo de uso
	* Llamada
		```
		GET localhost:8000/api/altaAlergeno?nombre=fructosa
		```
	* Resultado
		```
		{
		    "nombre": "fructosa"
		}
		```
### Dar de alta un ingrediente
    
* #### Ruta
	/api/altaIngrediente
* #### Método
	PUT
* #### Parametros URL o POST
	* Obligatorios
		* nombre=[string]
		
			_Ejemplo:_ nombre=Merluza a las 3 salsas
	* Opcionales
		* alergenos=[string1,...,stringN]

			_Ejemplo:_ alergenos[0]=leche&alergenos[1]=huevo
* #### Respuesta satisfactoria
	* Código: 201
	* Contenido: Nombre de ingrediente y alérgenos en formato JSON

		_Ejemplo_: ["pescado","gluten"]
* #### Respuestas de error
	* Código: 400
	* Contenido: {"errores":{"nombreVariable1":["Causa del error1"], ...}}
	* Causas de error:
		* El atributo nombre es necesario
		* El atributo nombre ya existe en la base de datos
		* El atributo <atributo> no es un string
		* El atributo alergenos debe ser un array
		* Los elementos del atributo alergenos.i no pueden estar duplicados
		* El atributo alergenos.i no existe en la base de datos
* #### Ejemplo de uso
	* Llamada
		```
		PUT localhost:8000/api/altaIngrediente?nombre=nueces&alergenos[0]=frutos secos
		```
	* Resultado
		```
		{
		    "nombre": "nueces",
		    "alergenos": [
			"frutos secos"
		    ]
		}
		```
### Dar de alta un plato
    
* #### Ruta
	/api/altaPlato
* #### Método
	PUT
* #### Parametros URL o POST
	* Obligatorios
		* nombre=[string]
		
			_Ejemplo:_ nombre=Pudin
		* ingredientes=[string1,...,stringN]
			
			_Ejemplo:_ ingrediente[0]=patatas&ingrediente[1]=gambas
	* Opcionales
* #### Respuesta satisfactoria
	* Código: 201
	* Contenido: Plato creado en formato JSON

		_Ejemplo_: {"nombre": "puré de patata y gambas","ingredientes": ["patatas","gambas"]}
* #### Respuestas de error
	* Código: 400
	* Contenido: {"errores":{"nombreVariable1":["Causa del error1"], ...}}
	* Causas de error:
		* El atributo <atributo> es necesario
		* El atributo nombre ya existe en la base de datos
		* El atributo <atributo> no es un string
		* El atributo ingredientes debe ser un array
		* Los elementos del atributo ingredientes.i no pueden estar duplicados
		* El atributo ingredientes.i no existe en la base de datos
		
		_Ejemplo_: {"errores": {"nombre": ["El atributo nombre es necesario."],"ingredientes.0": ["Los elementos del atributo ingredientes.0 no pueden estar duplicados"],"ingredientes.1": ["Los elementos del atributo ingredientes.1 no pueden estar duplicados"]}}
* #### Ejemplo de uso
	* Llamada
		```
		PUT localhost:8000/api/altaPlato?nombre=puré de la casa&ingredientes[0]=patatas&ingredientes[1]=merluza
		```
	* Resultado
		```
		{
		    "nombre": "puré de la casa",
		    "ingredientes": [
			"patatas",
			"merluza"
		    ]
		}
		```
### Modificar los ingredientes de un plato
    
* #### Ruta
	/api/modificarIngredientesDePlato
* #### Método
	POST
* #### Parametros URL o POST
	* Obligatorios
		* nombre=[string]
		
			_Ejemplo:_ nombre=Merluza a las 3 salsas
			
		* ingredientes=[string1,...,stringN]
			
			_Ejemplo:_ ingrediente[0]=patatas&ingrediente[1]=gambas&ingrediente[2]=merluza
	* Opcionales
* #### Respuesta satisfactoria
	* Código: 200
	* Contenido: Lista de alérgenos en formato JSON

		_Ejemplo_: {"nombre":"patatas cocidas","ingredientes":["tomate", "patatas"]}
* #### Respuestas de error
	* Código: 400
	* Contenido: {"errores":{"nombreVariable1":["Causa del error1"], ...}}
	* Causas de error:
		* El atributo <atributo> es necesario
		* El atributo <atributo> no existe en la base de datos
		* El atributo <atributo> no es un string
		* El atributo ingredientes debe ser un array
		* Los elementos del atributo ingredientes.i no pueden estar duplicados
* #### Ejemplo de uso
	* Llamada
		```
		GET localhost:8000/api/modificarIngredientesDePlato?nombre=merluza a las 3 salsas&ingredientes[0]=salsa vino&ingredientes[1]=merluza&ingredientes[2]=salsa gamba&ingredientes[3]=salsa queso
		```
	* Resultado
		```
		{
		    "nombre": "merluza a las 3 salsas",
		    "ingredientes": [
			"salsa vino",
			"merluza",
			"salsa gamba",
			"salsa queso"
		    ]
		}
		```
## Decisiones de diseño

### Base de datos MySQL
<img src="https://github.com/Ujhik/API_REST_Restaurante/blob/master/documentacion/imagenes/base%20datos%20restaurante.PNG?raw=true" alt="diseño base de datos" width="700">

Para diseñar el sistema de registro de cambios de ingredientes en platos he analizado y descartado varias posibilidades:
* No registrar alérgenos: Descartado porque en caso de que un ingrediente cambie de alérgenos en un futuro, no quedaría el registro. Otra opción sería no permitir en el futuro que los ingredientes cambien de alérgeno, creando ingredientes nuevos, pero la solución más limpia y resistente a posibles borrados de datos es incluir el registro de los alérgenos por ingrediente.
* Almacenar ingredientes y alérgenos como campos de tablas con referencias a las tablas de ingredientes y alérgenos. Surgen varios problemas de este enfoque:
	* La explosión combinacional que se da en caso de que en el futuro los ingredientes puedan tener cambios en los alergenos.
	* La pesadez de las consultas que va en aumento con el aumento del histórico.
	* El problema de pérdida de referencias en caso de que en el futuro se borren ingredientes y alérgenos, lo cual se podría solucional añadiendo un campo booleano a las tablas de ingredientes y alérgenos que se llamase borrado, indicando si ese campo se ha borrado o no para no mostrarlo en consultas pero si tenerlo como histórico. Esto me parece, unido a los otros problemas, complicar en exceso el sistema sin una ventaja significativa frente a la solución por la que he optado.
* Almacenar las instrucciones de alta y baja de ingredientes. Esto conlleva por cada cambio almacenar muchas tuplas sin que ello ofrezca una ventaja significativa al sistema por el que he optado.
	
Al final he decidido crear una tabla de CambiosPlatos. En ella se mantiene una referencia a platos, ya que esta es necesaria puesto que los históricos en el sistema actual y en previsión de futuro siempre dependerán de un plato concreto. En caso de que en el futuro se quieran poder eliminar platos de la lista, se podría hacer un campo booleano de borrado en la tabla platos y no tener esos en cuenta. También tiene un campo datetime para almecenar cuando se ha cambiado el plato, y después un campo de texto en el que se almacenan los ingredientes y sus alérgenos en JSON. El campo se puede hacer JSON para que la base de datos lo valide y aumentar la seguridad, pero como este tipo de dato JSON no es soportado en algunas bases de datos, he decidido hacerlo de texto. Las ventajas que supone este sistema:
* Consultas sencillas sin necesidad de joins que elentezcan el sistema.
* Una vez que se guarda un histórico, toda la información actual sobre el mismo queda almacenada sin que la modificación de otras tablas perjudique a su integridad.
* Es sencillo cambiar el formato de almacenamiento, ya que si en el futuro se quiere por ejemplo añadir o eliminar información, esto no afecta a registros anteriores ni al resto de tablas del sistema.
* Su funcionamiento queda aislado y desacoplado del resto del sistema, excepto por la clave foranea a platos, pero se siguen pudiendo utilizar las claves de los ingredientes y alérgenos utilizándolas como referencias, aunque con la precaución de que puede que se encuentren esas referencias en las tablas o no.

### Tecnología
He utilizado __PHP__, __MySQL__ y el framework __Laravel__.

He descartado hacer todo el sistema sin framework, debido a que no solo supone más consumo de tiempo sino peores resultados en varias áreas como seguridad, modularidad del código, unidades de testeo, etc...

En cuanto a frameworks he tenido en cuenta varias posibilidades y elegido __Laravel__, ya que cuenta con: soporte para ORM, tests automáticos, migrations, seeders, validación de parámetros en rutas, modelo MVC, una buena documentación, una gran comunidad (es el framework PHP más usado en 2019), seguridad, etc...
 Debido a los requisitos del ejercicio y comparándolo con otros frameworks como __Slim__, __CodeIgniter__, __Symfony__, __Epiphany__, etc... me ha parecido una buena opción.

Por tanto he utilizado en este proyecto:
* __Migrations__: En la ruta _database/migrations_ está el código que permite regenerar la base de datos completa de forma automática. Para ejecutar todas es tan fácil como ejecutar _php artisan migrate_.
* __Seeders__: En la ruta _database/seeds_ está el código que rellena la base de datos con datos de prueba. Para ejecutar todos se ejecuta _php artisan db:seed_.
* __ORM(Object Relational mapping)__: El acceso a la base de datos se abstrae a través de un sistema ORM gestionado por laravel y que hace uso de PDO por debajo. El código se encuentra en _app/model_, y en el se definel las relaciones de 1:N y N:M.
* __MVC(Modelo Vista Controlador__: Laravel hace sencillo dividir siguiendo este patrón, por lo que he seguido su esquema.
* __Validación de parámetros__: Laravel cuenta con un mecanismo de validación semi-automático que permite validar de forma sencilla controlando los errores y de forma que el código queda muy ordenado y legible.
* __Testeo automático__: Con PhpUnit, el código se encuentra en _tests/feature_. He generado un archivo por cada endpoint, con una función para funcionamiento correcto y otra para fallos de parámetros. En total 61 assertions, comprobando también que la base de datos se gestione correctamente.
* __CRUD(Create, Read, Update and Delete)__: Me he basado en la plantilla que proporciona Laravel en los controladores para implementarlo de forma estructurada.

### Arquitectura

#### Casos de uso
<img src="https://github.com/Ujhik/API_REST_Restaurante/blob/master/documentacion/imagenes/Casos%20de%20uso%20API%20REST.png?raw=true" alt="casos de uso" width="400">

#### Capas
<img src="https://github.com/Ujhik/API_REST_Restaurante/blob/master/documentacion/imagenes/Arquitectura%20capas%20API%20REST.png?raw=true" alt="capas" width="700">

* En el diagrama se muestran los archivos/clases en las que se dividen los modelos y controladores. Lo he diseñado así para que, como se ve en el diagrama, haya el menor acoplamiento posible, de forma que cada controlador acceda al menor número posible de modelos.

* PlatosController, IngredientesController y AlergenosController gestionan los CRUD. Actualmente solo cuentan con las funciones de crear debido a que es lo que especifica el enunciado, pero si en un futuro aumentase el sistema se utilizarían para toda la funcionalidad de CRUD.

* He dedicado especial atención a la nomenclatura, para que se pueda entender la mayor parte sin necesidad de comentarios o explicaciones.

* No he creado vistas ya que al ser una API REST para servir a una aplicación móvil me ha parecido innecesario.
