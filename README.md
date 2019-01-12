# API_REST_Restaurante

1. [Descripción proyecto](#descripción-proyecto)
    1. [Enunciado prueba de código](#enunciado-prueba-de-código)
2. [Documentación base de datos MySQL](#documentación-base-de-datos-mysql)
3. [Documentación API REST](#documentación-api-rest)
4. [Decisiones de diseño](#decisiones-de-diseño)
    1. [Tecnología](#tecnología)
    2. [Arquitectura](#arquitectura)

## Descripción proyecto
Este proyecto es la implementación de la siguiente prueba de código, utilizando PHP, MySQL y Laravel:

### Enunciado prueba de código
Debido a una nueva legislación, los restaurantes necesitan tener información disponible acerca de los alérgenos que tiene cada plato que sirven. Un plato tiene varios ingredientes, y un ingrediente puede tener varios alérgenos.

Un restaurante ha contratado una aplicación movil que gestione para sus camareros cualquier duda de los clientes acerca de esta materia. La implementación de dicha app nos es transparente, salvo porque hace uso de una API Rest que le servirá la información que necesita.

Implementa un pequeño sistema que se componga de:

* - [x] Una base de datos que almacene los platos y sus alérgenos.
* - [x] Una API Rest que devuelva los alérgenos de un plato dado, o los platos en los que aparece un alérgeno concreto, y permita añadir ingredientes, platos y alérgenos.
* - [x] No será necesario un sistema de usuarios ni roles.
* - [x] Bonus: Supongamos que un cocinero puede realizar cambios sobre los ingredientes de un plato. Diseña y, si puedes, implementa un sistema para que quede un registro de cambios sobre los platos.

## Documentación base de datos MySQL

## Documentación API REST

1. [Obtener la lista de alérgenos de un plato](#obtener-la-lista-de-alérgenos-de-un-plato)
2. [Obtener la lista de platos de un alérgeno](#obtener-la-lista-de-platos-de-un-alérgeno)
3. [Dar de alta un alérgeno](#dar-de-alta-un-alérgeno)
4. [Dar de alta un ingrediente](#dar-de-alta-un-ingrediente)
5. [Dar de alta un plato](#dar-de-alta-un-plato)
6. [Modificar los ingredientes de un plato](#modificar-los-ingredientes-de-un-plato)

* ### Obtener la lista de alérgenos de un plato
    
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
	* Contenido: {"errores":{"nombre":["Causa del error"]}}
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

* ### Obtener la lista de platos de un alérgeno
    
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
	* Contenido: {"errores":{"nombre":["Causa del error"]}}
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

* ### Dar de alta un alérgeno
    
* #### Ruta
	/api/obtenerAlergenosDePlato
* #### Método
	GET
* #### Parametros URL o POST
	* Obligatorios
		* nombre=[string]
		
			_Ejemplo:_ nombre=Merluza a las 3 salsas
	* Opcionales
* #### Respuesta satisfactoria
	* Código: 200
	* Contenido: Lista de alérgenos en formato JSON

		_Ejemplo_: ["pescado","gluten"]
* #### Respuestas de error
	* Código: 400
	* Contenido: {"errores":{"nombre":["Causa del error"]}}
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

* ### Dar de alta un ingrediente
    
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
	* Contenido: {"errores":{"nombre":["Causa del error"]}}
	* Causas de error:
		* El atributo nombre es necesario
		* El atributo nombre no existe en la base de datos
		* El atributo nombre no es un string
		
		
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

* ### Dar de alta un plato
    
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
	* Contenido: Listado de errores en formato JSON
	* Causas de error:
		* El atributo nombre es necesario
		* El atributo nombre no existe en la base de datos
		* El atributo nombre no es un string
		
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
		
* ### Modificar los ingredientes de un plato
    
* #### Ruta
	/api/obtenerAlergenosDePlato
* #### Método
	GET
* #### Parametros URL o POST
	* Obligatorios
		* nombre=[string]
		
			_Ejemplo:_ nombre=Merluza a las 3 salsas
	* Opcionales
* #### Respuesta satisfactoria
	* Código: 200
	* Contenido: Lista de alérgenos en formato JSON

		_Ejemplo_: ["pescado","gluten"]
* #### Respuestas de error
	* Código: 400
	* Contenido: {"errores":{"nombre":["Causa del error"]}}
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
	

## Decisiones de diseño

### Tecnología

### Arquitectura
