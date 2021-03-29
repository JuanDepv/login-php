# login-php 🚀

_Realizacion de proyecto basico donde se realiza un login: con login de usuarios, registro de usuarios y recuperacion de contraseña_

### Instalación 🔧

_Ajustes del paso a paso para ejecutar el proyecto_

## Paso 1

Crear la base de datos que se encuentra en la raiz principal del proyecto

```
mydb.sql
```

## Paso 2

Después de la creacion de la db, ir a la carpeta/archivo **config/DataBase.php** y modificar la conexion

* [$host] - modicicar el host de conexión
* [$db_name] - modificar nombre de la base de datos
* [$db_user] - modificar nombre de su usuario de base de datos
* [$db_pass] - modificar la contraseña en caso de que se requiera o dejarla vacia


## Paso 3

Después del realizar los ajustes a la configuración DB, ir a la carpeta/archivo **config/Constants.php** y modificar la URL BASE

```
define("BASE_URL", "http://localhost/proyectos-juan/login-php"); / define("BASE_URL", "http://localhost/**nueva_url**");
```

## Paso 4

Lo siguiente es ir la la carpeta/archivo **public/js/app.js** y **public/js/usuarios.js** y modificar la constante URL

```
  const URL = "/proyectos-juan/login-php" - URL_BASE_NUEVA
```

## Ejecutar en un servidor como: ⚙️

_xampp, wampp, mamp o local con el servidor de php_

```
  php -S localhost:8080
```
