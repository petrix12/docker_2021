# CRUD con PHP MySQL Bootstrap jQuery Ajax y Docker
+ [URL del curso en Udemy](https://www.udemy.com/course/crud-con-php-mysql-bootstrap-jquery-ajax-y-docker)
+ [URL del repositorio en GitHub](https://github.com/petrix12/docker_2021.git)

## Antes de iniciar:
1. Crear proyecto en la página de [GitHub](https://github.com) con el nombre: **docker_2021**.
    + **Description**: Proyecto para seguir el curso de 'CRUD con PHP MySQL Bootstrap jQuery Ajax y Docker', creado por Werner Ovalle en Udemy.
    + **Public**.
2. En la ubicación raíz del proyecto en la terminal de la máquina local:
    + $ git init
    + $ git add .
    + $ git commit -m "Antes de iniciar"
    + $ git branch -M main
    + $ git remote add origin https://github.com/petrix12/docker_2021.git
    + $ git push -u origin main

## Sección 01: Introducción

### 01. Introducción
+ **Contenido**: Descripción del CRUD a desarrollar en el curso.
1. Commit Video 01:
    + $ git add .
    + $ git commit -m "Introducción"
    + $ git push -u origin main

### 02. Editor de código
+ Programas requeridos:
    + **VS Code** como editor de código.
    + **MySQL Workbench** como gestor de BD.
    + **Postman** para realizar peticiones http.
1. Commit Video 02:
    + $ git add .
    + $ git commit -m "Editor de código"
    + $ git push -u origin main

## Sección 02: Creando nuestro entorno de desarrollo

### 03. ¿Qué es Docker?
+ https://www.docker.com/products/docker-desktop
+ Ver todos los comandos de Docker:
    + $ docker help
+ Ejecutar un Dockerfile:
    + $ docker build -t primerdockerfile .
1. Commit Video 03:
    + $ git add .
    + $ git commit -m "¿Qué es Docker?"
    + $ git push -u origin main

### 04. Instalando PHP 7.3 + MySQL 5.6 a través de Docker
1. Crear carpeta **docker** para comenzar un nuevo proyecto.
2. Crear archivo docker-compose.yaml:
    ```yaml
    version: '3'

    services:
    mysql:
        image: mysql:5.6
        container_name: docker-mysql
        environment:
        MYSQL_DATABASE: database_name
        MYSQL_USER: my_username
        MYSQL_PASSWORD: my_password
        MYSQL_ROOT_PASSWORD: my_password
        ports:
        - "3306:3306"
        volumes:
        - ./mysqldata:/var/www/html  
        restart: always
        
    web:
        image: php:7.3-apache
        container_name: docker-php
        ports:
        - "80:80"
        volumes:
        - ./www:/var/www/html
        restart: always  
        links:
        - mysql
    ```
3. Ejecutar en una terminal en la raíz del proyecto para crear los nuevos contenedores:
    + $ docker-compose up -d
4. Verificar si se estan ejecutando los nuevos contenedores:
    + $ docker ps
5. Ejecutar MySQL Workbench y crear una nueva conexión:
    + Connection Name: Docker-MySQL
    + Username: my_username
    + Password: my_password
    + Default Schema: database_name
6. Crear archivo **www\index.php**:
    ```php
    <?php
        echo "Soluciones++";
    ?>
    ```
7. Commit Video 04:
    + $ git add .
    + $ git commit -m "Instalando PHP 7.3 + MySQL 5.6 a través de Docker"
    + $ git push -u origin main

## Sección 03: Base de datos con MySQL

### 05. Creación de tabla
1. Ejecutar el siguiente script en nuestra base de datos en MySQL Workbench para crear la tabla **empleado**:
    ```sql
    create table empleado(
        id_empleado int NOT NULL AUTO_INCREMENT primary key,
        nombre varchar(45), 
        apellido varchar(45),
        telefono int,
        direccion varchar(45),
        fecha_nacimiento date,
        observacion varchar(45),
        sueldo int(11)
    );
    ```
2. Commit Video 05:
    + $ git add .
    + $ git commit -m "Creación de tabla"
    + $ git push -u origin main

## Sección 04: Servicio Web con PHP 

### 06. Conexión con la base de datos
1. Ingresar a la terminal del contenedor **web**:
    + $ docker exec -it docker-php bash
2. Verificar si tenemos la utilidad **msqli**:
    + /var/www/html# docker-php-ext-enable mysqli
3. En caso de no tener instalado **msqli**, ejecutar:
    + /var/www/html# docker-php-ext-install mysqli
4. Modificar **www\index.php**:
    ```php
    <?php 
        $conexion = mysqli_connect("mysql", "my_username","my_password", "database_name","3306");

        //ver si la conexion es correcta
        if(mysqli_connect_errno()){
            echo "la conexion a la base de datos mysql ha fallado:" .mysqli_connect_error();
        }
        else{ 

            echo "conexion realizada correctamente!!";
        }
            
        //consulta para configurar la codifiacion de caracteres
        mysqli_query($conexion, "SET NAMES 'utf8'")
    ?>
    ```
    + **Nota**: en caso de error reiniciar los servicios web y de base de datos desde Docker.
5. Commit Video 06:
    + $ git add .
    + $ git commit -m "Conexión con la base de datos"
    + $ git push -u origin main

### 07. Servicio Web para guardar
1. Renombrar el archivo **www\index.php** a **www\conexion.php**.
2. Modificar **www\conexion.php**:
    ```php
    <?php 
        $conexion = mysqli_connect("mysql", "my_username","my_password", "database_name","3306");

        //ver si la conexion es correcta
        if(mysqli_connect_errno()){
            echo "la conexion a la base de datos mysql ha fallado:" .mysqli_connect_error();
        }
        else{ 
            echo "conexion realizada correctamente!!";echo '<br>';
        }
            
        //consulta para configurar la codifiacion de caracteres
        mysqli_query($conexion, "SET NAMES 'utf8'")
    ?>
    ```
3. Crear **www\guardar-empleado.php**:
    ```php
    <?php

    if (isset($_POST)) {
        require_once 'conexion.php';

        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : false;
        $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($conexion, $_POST['telefono']) : false;
        $direccion = isset($_POST['direccion']) ? mysqli_real_escape_string($conexion, $_POST['direccion']) : false;
        $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']) : false;
        $observacion = isset($_POST['observacion']) ? mysqli_real_escape_string($conexion, $_POST['observacion']) : false;
        $sueldo = isset($_POST['sueldo']) ? mysqli_real_escape_string($conexion, $_POST['sueldo']) : false;

        $errores = array();

        if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
            $nombre_validado = true;
        } else {
            $nombre_validado = false;
            $errores['nombre'] = "El nombre no es valido";
        }

        if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
            $apellido_validado = true;
        } else {
            $apellido_validado = false;
            $errores['apellido'] = "El apellido no es valido";
        }

        if (!empty($telefono) && is_numeric($telefono)) {
            $telefono_validado = true;
        } else {
            $telefono_validado = false;
            $errores['telefono'] = "El telefono no es valido";
        }

        if (!empty($direccion) && !is_numeric($direccion)) {
            $direccion_validado = true;
        } else {
            $direccion_validado = false;
            $errores['direccion'] = "direccion no es valido";
        }

        if (!empty($fecha_nacimiento)) {
            $fecha_nacimiento_validado = true;
        } else {
            $fecha_nacimiento_validado = false;
            $errores['fecha_nacimiento'] = "fecha_nacimiento no es valido";
        }

        if (!empty($observacion)) {
            $observacion_validado = true;
        } else {
            $observacion_validado = false;
            $errores['observacion'] = "observacion no es valido";
        }
        
        if (!empty($sueldo) && is_numeric($sueldo)) {
            $sueldo_validado = true;
        } else {
            $sueldo_validado = false;
            $errores['sueldo'] = "El sueldo no es valido";
        }

        if (count($errores) == 0) {
            $sql = "insert into empleado ( nombre, apellido, telefono, direccion, fecha_nacimiento, observacion, sueldo ) values ('$nombre','$apellido',$telefono,'$direccion','$fecha_nacimiento','$observacion',$sueldo)";
            $guardar = mysqli_query($conexion, $sql);
            echo "guardado exitosamente";
        } else {
            foreach ($errores as $val) {
                echo $val;
                echo '<br>';
            }
        }
    }
    ```
4. Realizar petición http:
    + URL: http://localhost/guardar-empleado.php
    + Método: POST
    + Body:
        + nombre: Pedro,
        + apellido: Bazó,
        + telefono: 4164832049,
        + direccion: Urb. Solidaridad,
        + fecha_nacimiento: 12-01-1972,
        + observacion: Ninguna",
        + sueldo: 3500
5. Commit Video 07:
    + $ git add .
    + $ git commit -m "Servicio Web para guardar"
    + $ git push -u origin main

### 08. Servicio Web para consultar
1. Crear archivo **www\mostrar-empleado.php**:
    ```php
    <?php

    require_once 'conexion.php';
    $query = mysqli_query($conexion, "select * from empleado");
    echo '
        <table >
            <thead>
            <tr>
                <th >nombre </th>
                <th >apellido</th>
                <th >telefono</th>
                <th >direccion</th>
                <th >fecha_nacimiento</th>
                <th >observacion</th>
                <th >sueldo</th>
            </tr>
            </thead>
            <tbody>
    ';
    
    while($empleado= mysqli_fetch_assoc($query)){
        //var_dump($empleado);
        echo '<tr>';
        echo '<td>'.$empleado['nombre'].'</td>';
        echo '<td>'.$empleado['apellido'].'</td>';
        echo '<td>'.$empleado['telefono'].'</td>';
        echo '<td>'.$empleado['direccion'].'</td>';
        echo '<td>'.$empleado['fecha_nacimiento'].'</td>';
        echo '<td>'.$empleado['observacion'].'</td>';
        echo '<td>'.$empleado['sueldo'].'</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';

    ?>
    ```
2. Realizar petición http:
    + URL: http://localhost/mostrar-empleado.php
    + Método: GET
3. Commit Video 08:
    + $ git add .
    + $ git commit -m "Servicio Web para consultar"
    + $ git push -u origin main

### 09. Servicio Web para actualizar
1. Crear archivo **www\actualizar-empleado.php**:
    ```php
    <?php

    if (isset($_POST)) {
        require_once 'conexion.php';

        $id_empleado = isset($_POST['id_empleado']) ? mysqli_real_escape_string($conexion, $_POST['id_empleado']) : false;
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($conexion, $_POST['apellido']) : false;
        $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($conexion, $_POST['telefono']) : false;
        $direccion = isset($_POST['direccion']) ? mysqli_real_escape_string($conexion, $_POST['direccion']) : false;
        $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']) : false;
        $observacion = isset($_POST['observacion']) ? mysqli_real_escape_string($conexion, $_POST['observacion']) : false;
        $sueldo = isset($_POST['sueldo']) ? mysqli_real_escape_string($conexion, $_POST['sueldo']) : false;

        $errores = array();

        if (!empty($id_empleado) && is_numeric($id_empleado)) {
            $id_empleado_validado = true;
        } else {
            $id_empleado_validado = false;
            $errores['id_empleado'] = "El id_empleado no es valido";
        }

        if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
            $nombre_validado = true;
        } else {
            $nombre_validado = false;
            $errores['nombre'] = "El nombre no es valido";
        }

        if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
            $apellido_validado = true;
        } else {
            $apellido_validado = false;
            $errores['apellido'] = "El apellido no es valido";
        }

        if (!empty($telefono) && is_numeric($telefono)) {
            $telefono_validado = true;
        } else {
            $telefono_validado = false;
            $errores['telefono'] = "El telefono no es valido";
        }

        if (!empty($direccion) && !is_numeric($direccion)) {
            $direccion_validado = true;
        } else {
            $direccion_validado = false;
            $errores['direccion'] = "direccion no es valido";
        }

        if (!empty($fecha_nacimiento)) {
            $fecha_nacimiento_validado = true;
        } else {
            $fecha_nacimiento_validado = false;
            $errores['fecha_nacimiento'] = "fecha_nacimiento no es valido";
        }

        if (!empty($observacion)) {
            $observacion_validado = true;
        } else {
            $observacion_validado = false;
            $errores['observacion'] = "observacion no es valido";
        }

        if (!empty($sueldo) && is_numeric($sueldo)) {
            $sueldo_validado = true;
        } else {
            $sueldo_validado = false;
            $errores['sueldo'] = "El sueldo no es valido";
        }

        if (count($errores) == 0) {
            $sql = "update empleado set nombre='$nombre', apellido='$apellido', telefono=$telefono, direccion='$direccion',fecha_nacimiento='$fecha_nacimiento',observacion='$observacion',sueldo=$sueldo where id_empleado=$id_empleado";
            $guardar = mysqli_query($conexion, $sql);
            echo "actualizado exitosamente";
        } else {
            foreach ($errores as $val) {
                echo $val;
                echo '<br>';
            }
        }
    }
    ```
2. Realizar petición http:
    + URL: http://localhost/actualizar-empleado.php
    + Método: POST
    + Body:
        + nombre: Petrix,
        + apellido: Canelón,
        + telefono: 4164832049,
        + direccion: Urb. Solidaridad,
        + fecha_nacimiento: 12-01-1972,
        + observacion: Ninguna",
        + sueldo: 3500
        + id_empleado: 1
3. Commit Video 09:
    + $ git add .
    + $ git commit -m "Servicio Web para actualizar"
    + $ git push -u origin main

### 10. Servicio Web para eliminar
1. Crear archivo **www\eliminar-empleado.php**:
    ```php
    if (isset($_POST)) {
        require_once 'conexion.php';
        $id_empleado = isset($_POST['id_empleado']) ? mysqli_real_escape_string($conexion, $_POST['id_empleado']) : false;
        $errores = array();

        if (!empty($id_empleado) && is_numeric($id_empleado)) {
            $id_empleado_validado = true;
        } else {
            $id_empleado_validado = false;
            $errores['id_empleado'] = "El id_empleado no es valido";
        }
    
        if (count($errores) == 0) {
            $sql = "delete from empleado where id_empleado=$id_empleado";
            $guardar = mysqli_query($conexion, $sql);
            echo "eliminado exitosamente";
        } else {
            foreach ($errores as $val) {
                echo $val;
                echo '<br>';
            }
        }
    }
    ```
2. Realizar petición http:
    + URL: http://localhost/eliminar-empleado.php
    + Método: POST
    + Body:
        + id_empleado: 1
3. Commit Video 10:
    + $ git add .
    + $ git commit -m "Servicio Web para eliminar"
    + $ git push -u origin main

## Sección 05: Diseño con HTML5 y Bootstrap 4

### 11. Instalar Bootstrap
1. Crear archivo www\index.html:
    ```html
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Document</title>
    </head>

    <body>
        <h1>Soluciones++</h1>
    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </html>
    ```
2. Commit Video 11:
    + $ git add .
    + $ git commit -m "Diseño con HTML5 y Bootstrap 4"
    + $ git push -u origin main

### 12. Diseño de CRUD
1. Rediseñar la página principal **www\index.html**:
    ```html
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
            crossorigin="anonymous"
        />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <title>Document</title>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <a class="btn btn-success" href="agregar-empleado.html" role="button">Agregar Empleado <i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
    >
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"
    >
    </script>
    <script src="script.js"></script>
    </html>
    ```
2. Crear archivo **www\agregar-empleado.html**:
    ```html
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
            crossorigin="anonymous"
        />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <title>Document</title>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
    >
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"
    >
    </script>
    </html>
    ```
3. Commit Video 12:
    + $ git add .
    + $ git commit -m "Diseño de CRUD"
    + $ git push -u origin main

### 13. Implementando jQuery
1. Crear archivo de script **www\script.js**:
    ```js
    $(document).ready(function(){
        alert("jQuery funcionando")
    })
    ```
2. Commit Video 13:
    + $ git add .
    + $ git commit -m "Implementando jQuery"
    + $ git push -u origin main

### 14. Consultado información con Ajax jQuery y PHP
1. Modificar script **www\script.js**:
    ```js
    $(document).ready(function(){
        /**/
        $.ajax({
            type: "GET",
            url: "mostrar-empleado.php",
        
            success: function(data) {
                $("#tabla").html(data)
            }
        });
    })
    ```
2. Modificar página principal **www\index.html**:
    ```html
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
            crossorigin="anonymous"
        />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <title>Document</title>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <a class="btn btn-success" href="agregar-empleado.html" role="button">Agregar Empleado <i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
            </div>
            <!-- -->
            <div class="row" id="tabla">
                
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!---->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"
    >
    </script>
    <script src="script.js"></script>
    </html>
    ```
3. Modificar **www\mostrar-empleado.php**:
    ```php
    <?php

    require_once 'conexion.php';
    $query = mysqli_query($conexion, "select * from empleado");
    //
    echo '
    <div class="table-responsive mt-5">
        <table  class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">nombre </th>
                    <th scope="col">apellido</th>
                    <th scope="col">telefono</th>
                    <th scope="col">direccion</th>
                    <th scope="col">fecha_nacimiento</th>
                    <th scope="col">observacion</th>
                    <th scope="col">sueldo</th>
                </tr>
            </thead>
            <tbody>
    ';
    
    while($empleado= mysqli_fetch_assoc($query)){
        //var_dump($empleado);
        echo '<tr>';
        echo '<td>'.$empleado['id_empleado'].'</td>';
        echo '<td>'.$empleado['nombre'].'</td>';
        echo '<td>'.$empleado['apellido'].'</td>';
        echo '<td>'.$empleado['telefono'].'</td>';
        echo '<td>'.$empleado['direccion'].'</td>';
        echo '<td>'.$empleado['fecha_nacimiento'].'</td>';
        echo '<td>'.$empleado['observacion'].'</td>';
        echo '<td>'.$empleado['sueldo'].'</td>';
        echo '</tr>';
    }
    echo '</tbody></table> </div>';

    ?>
    ```
4. Modificar **www\conexion.php**:
    ```php
    <?php 
        $conexion = mysqli_connect("mysql", "my_username","my_password", "database_name","3306");

        //ver si la conexion es correcta
        if(mysqli_connect_errno()){ 
            echo "la conexion a la base de datos mysql ha fallado:" .mysqli_connect_error();
        }
        else{ 
            //
            //echo "conexion realizada correctamente!!";echo '<br>';
        }
            
        //consulta para configurar la codifiacion de caracteres
        mysqli_query($conexion, "SET NAMES 'utf8'")
    ?>
    ```
5. Commit Video 14:
    + $ git add .
    + $ git commit -m "Consultado información con Ajax jQuery y PHP"
    + $ git push -u origin main

### 15. Restructurando los archivos
1. Reestructurar los archivos del proyecto:
    + www\backend\actualizar-empleado.php
    + www\backend\conexion.php
    + www\backend\eliminar-empleado.php
    + www\backend\guardar-empleado.php
    + www\backend\mostrar-empleado.php
    + www\frontend\js\script.js
    + www\frontend\agregar-empleado.html
    + www\frontend\index.html
2. Modificar página principal **www\frontend\index.html**:
    ```html
    ≡
    <script src="\frontend\js\script.js"></script>
    </html>
    ```
3. Modificar script www\frontend\js\script.js:
    ```js
    $(document).ready(function(){
        /**/
        $.ajax({
            type: "GET",
            url: "../../backend/mostrar-empleado.php",
        
            success: function(data) {
                $("#tabla").html(data)
            }
        });
    })
    ```
4. Commit Video 15:
    + $ git add .
    + $ git commit -m "Restructurando los archivos"
    + $ git push -u origin main

### 16. Guardando información con Ajax jQuery y PHP
1. Modificar **www\frontend\agregar-empleado.html**:
    ```html
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
            crossorigin="anonymous"
        />
        <link
            href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
            rel="stylesheet"
        />
        <title>CRUD con PHP MySQL Bootstrap jQuery Ajax y Docker</title>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-3 mb-5">
                    <a class="btn btn-warning" href="index.html" >Volver</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <form id="form_agregar">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nombre"
                                    name="nombre"
                                />
                                <div id="nombre_invalido" class="invalid-feedback">
                                    Campo nombre invalido
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellido">Apellido</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="apellido"
                                    name="apellido"
                                />
                                <div id="apellido_invalido" class="invalid-feedback">
                                    Campo apellido invalido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefono">Teléfono</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="telefono"
                                    name="telefono"
                                />
                                <div id="telefono_invalido" class="invalid-feedback">
                                    Campo Teléfono invalido
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="direccion">Dirección</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="direccion"
                                    name="direccion"
                                />
                                <div id="direccion_invalido" class="invalid-feedback">
                                    Campo Dirección invalido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="fecha_nacimiento"
                                    name="fecha_nacimiento"
                                />
                                <div id="fecha_nacimiento_invalido" class="invalid-feedback">
                                    Campo Fecha Nacimiento invalido
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sueldo">Sueldo</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="sueldo"
                                    name="sueldo"
                                />
                                <div id="sueldo_invalido" class="invalid-feedback">
                                    Campo Sueldo invalido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="observacion">Observación</label>
                                <textarea
                                    class="form-control"
                                    id="observacion"
                                    name="observacion"
                                >
                                </textarea>
                                <div id="observacion_invalido" class="invalid-feedback">
                                    Campo Observación invalido
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"
    >
    </script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"
    >
    </script>

    <script src="/frontend/js/script.js"></script>
    </html>
    ```
2. Modificar script **www\frontend\js\script.js**:
    ```js
    $(document).ready(function () {
        /**/
        $(".invalid-feedback").hide();

        if ($("#tabla")) {
            $.ajax({
                type: "GET",
                url: "../../backend/mostrar-empleado.php",

                success: function (data) {
                    $("#tabla").html(data);

                    $(".update").on("click", function (e) {
                        e.preventDefault();
                        $("#myModal").modal("show");
                        let id_empleado = $(this).attr("id_empleado");
                        let nombre = $(this).attr("nombre");
                        let apellido = $(this).attr("apellido");
                        let telefono = $(this).attr("telefono");
                        let direccion = $(this).attr("direccion");
                        let fecha_nacimiento = $(this).attr("fecha_nacimiento");
                        let sueldo = $(this).attr("sueldo");
                        let observacion = $(this).attr("observacion");
                        $("#id_empleado").val(id_empleado);
                        $("#nombre").val(nombre);
                        $("#apellido").val(apellido);
                        $("#telefono").val(telefono);
                        $("#direccion").val(direccion);
                        $("#fecha_nacimiento").val(fecha_nacimiento);
                        $("#sueldo").val(sueldo);
                        $("#observacion").val(observacion);
                            $("#Actualizar").on("click", function (e) {
                            $(".invalid-feedback").hide();
                            $("input").removeClass("is-invalid");
                            const expresiones = {
                                usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
                                nombre: /^[a-zA-ZÀ-ÿ\s]+$/, //
                                password: /^.{4,12}$/, // 4 a 12 digitos.
                                correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
                                telefono: /^\d{7,14}$/, // 7 a 14 numeros.
                            };

                            let nombre = $("#nombre");
                            let apellido = $("#apellido");
                            let telefono = $("#telefono");
                            let direccion = $("#direccion");
                            let fecha_nacimiento = $("#fecha_nacimiento");
                            let isValidDate = Date.parse(fecha_nacimiento.val());
                            let sueldo = $("#sueldo");
                            let observacion = $("#observacion");
                            if (
                                nombre.val().trim() == null ||
                                nombre.val().trim().length == 0 ||
                                !expresiones.nombre.test(nombre.val().trim())
                            ) {
                                nombre.addClass("is-invalid");

                                $("#nombre_invalido").show();
                            } else if (
                                apellido.val().trim() == null ||
                                apellido.val().trim().length == 0 ||
                                !expresiones.nombre.test(apellido.val().trim())
                            ) {
                                apellido.addClass("is-invalid");

                                $("#apellido_invalido").show();
                            } else if (
                                telefono.val().trim() == null ||
                                telefono.val().trim().length == 0 ||
                                !expresiones.telefono.test(telefono.val())
                            ) {
                                telefono.addClass("is-invalid");

                                $("#telefono_invalido").show();
                            } else if (
                                direccion.val().trim() == null ||
                                direccion.val().trim().length == 0
                            ) {
                                direccion.addClass("is-invalid");

                                $("#direccion_invalido").show();
                            } else if (isNaN(isValidDate)) {
                                fecha_nacimiento.addClass("is-invalid");

                                $("#fecha_nacimiento_invalido").show();
                            } else if (
                                sueldo.val().trim() == null ||
                                sueldo.val().trim().length <= 0
                            ) {
                                sueldo.addClass("is-invalid");

                                $("#sueldo_invalido").show();
                            } else if (
                                observacion.val().trim() == null ||
                                observacion.val().trim().length == 0
                            ) {
                                observacion.addClass("is-invalid");

                                $("#observacion_invalido").show();
                            } else {
                                $.ajax({
                                type: "POST",
                                data: $("#form_actualizar").serialize(),
                                url: "../../backend/actualizar-empleado.php",

                                success: function (data) {
                                    alert(data);
                                    location.reload();
                                },
                                error: function (request, status, error) {
                                    alert(request.responseText);
                                },
                                });
                            }
                        });
                    });
                    $(".delete").on("click", function (e) {
                        e.preventDefault();

                        var r = confirm("Esta seguro que desea eliminarlo!");
                        if (r == true) {
                            let id_empleado = $(this).attr("id_empleado");
                            $.ajax({
                                type: "POST",
                                data: "id_empleado=" + id_empleado,
                                url: "../../backend/eliminar-empleado.php",

                                success: function (data) {
                                    alert(data);
                                    location.reload();
                                },
                                error: function (request, status, error) {
                                    alert(request.responseText);
                                },
                            });
                        }
                    });
                },
                error: function (request, status, error) {
                alert(request.responseText);
                },
            });
        }

        $("#form_agregar").on("submit", function (e) {
            e.preventDefault();
            $(".invalid-feedback").hide();
            $("input").removeClass("is-invalid");
            const expresiones = {
                usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
                nombre: /^[a-zA-ZÀ-ÿ\s]+$/, //
                password: /^.{4,12}$/, // 4 a 12 digitos.
                correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
                telefono: /^\d{7,14}$/, // 7 a 14 numeros.
            };

            let nombre = $("#nombre");
            let apellido = $("#apellido");
            let telefono = $("#telefono");
            let direccion = $("#direccion");
            let fecha_nacimiento = $("#fecha_nacimiento");
            let isValidDate = Date.parse(fecha_nacimiento.val());
            let sueldo = $("#sueldo");
            let observacion = $("#observacion");
            if (
                nombre.val().trim() == null ||
                nombre.val().trim().length == 0 ||
                !expresiones.nombre.test(nombre.val().trim())
            ) {
                nombre.addClass("is-invalid");

                $("#nombre_invalido").show();
            } else if (
                apellido.val().trim() == null ||
                apellido.val().trim().length == 0 ||
                !expresiones.nombre.test(apellido.val().trim())
            ) {
                apellido.addClass("is-invalid");

                $("#apellido_invalido").show();
            } else if (
                telefono.val().trim() == null ||
                telefono.val().trim().length == 0 ||
                !expresiones.telefono.test(telefono.val())
            ) {
                telefono.addClass("is-invalid");

                $("#telefono_invalido").show();
            } else if (
                direccion.val().trim() == null ||
                direccion.val().trim().length == 0
            ) {
                direccion.addClass("is-invalid");

                $("#direccion_invalido").show();
            } else if (isNaN(isValidDate)) {
                fecha_nacimiento.addClass("is-invalid");

                $("#fecha_nacimiento_invalido").show();
            } else if (sueldo.val().trim() == null || sueldo.val().trim().length <= 0) {
                sueldo.addClass("is-invalid");

                $("#sueldo_invalido").show();
            } else if (
                observacion.val().trim() == null ||
                observacion.val().trim().length == 0
            ) {
                observacion.addClass("is-invalid");

                $("#observacion_invalido").show();
            } else {
                $.ajax({
                    type: "POST",
                    data: $("#form_agregar").serialize(),
                    url: "../../backend/guardar-empleado.php",

                    success: function (data) {
                        alert(data);
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    },
                });
            }
        });
    });
    ```
3. Commit Video 16:
    + $ git add .
    + $ git commit -m "Guardando información con Ajax jQuery y PHP"
    + $ git push -u origin main

### 17. Actualizando información con Ajax jQuery y PHP
1. Commit Video 17:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 18. Borrando información con Ajax jQuery y PHP
1. Commit Video 18:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main


## Sección 06: Palabras Finales

### 19. Palabras Finales
1. Commit Video 19:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main