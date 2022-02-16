### DD3 Prueba Técnica - Carlos Alberto Benitez

Se adjunta documento pdf con los requerimientos: `Prueba técnica - Fullstack .pdf`

### Entorno

- Framework Laravel 7.0

### Requerimientos

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL 5.6+

### Instalación
- Clonar el repositorio en la carpeta pública del servidor web.
- Crear una base de datos llamada `dd3`
- importar la Base de datos mediante el dump `dump-db-2022-02-16.sql`
- Importar la colección de los enpoints de prueba mediante el siguiente link:
[Colección de Postman](https://www.getpostman.com/collections/a927e97c2861709c26bb)
- es recomendable crear un `host virtual` para ejecutar el sistema.

### Características

- Se dispone de tres endpoints para la intereación con el sistema mediante APIs.
- Cada endpoint contiene los datos de prueba asi como los parametros disponibles para cada uno:

### Endpoints

Request: `/api/signup`

Parametros: 
```
{
"name":"John Doe",
"email":"john@doe.com",
"password":"123456"
}
```
Response: 
```
{
    "access_token": "eyJ0eXAiOiJKV1Qi......",
    "token_type": "Bearer",
    "expires_at": "2023-02-16 10:03:44"
}
```

------------


Request: `/api/login`

Parametros: 
```
{
"email":"john@doe.com",
"password":"123456"
}
```
Response: 
```
{
    "access_token": "eyJ0eXAiOiJKV1Qi......",
    "token_type": "Bearer",
    "expires_at": "2023-02-16 10:03:44"
}
```

------------

Request: `/api/properties`

Requiere: `Authorization / Bearer Acces Token`

Parametros Opcionales: 
```
{
"name": "M1",
"cost": "10000000",
"type": "rent",
"page":2
}
```
Response: 
```
{
    "access_token": "eyJ0eXAiOiJKV1Qi......",
    "token_type": "Bearer",
    "expires_at": "2023-02-16 10:03:44"
}
```
### Frontend

Se disponen dos paginas, la principal que contiene el listado de las propiedades, un buscador y el paginador. Ambos realizan su función mediante Ajax.

La segunda página corresponde al detalle de una propiedad. En dicho caso se muesta mas información de la detallada en el listado.


> Todos los recursos fueron obtenidos de www.figma.com

------------


cabenitez83@gmail.com