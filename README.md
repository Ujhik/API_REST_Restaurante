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


* #### Título:
    Obtener la lista de alérgenos de un plato
* #### Ruta
	/api/obtenerAlergenosDePlato
* #### Método
	GET
* #### Parametros URL
	* Obligatorios
		* Nombre=[string]
		
			_Ejemplo:_ Nombre=Merluza a las 3 salsas
	* Opcionales
* #### Parametros de datos POST
	* Obligatorios
	* Opcionales
* #### Respuesta satisfactoria
	* Código: 200
	* Contenido: 
* #### Respuestas de error
	* Código: 400
	* Contenido: Causa del error
		
		
* #### Ejemplo de uso

## Decisiones de diseño

### Tecnología

### Arquitectura
