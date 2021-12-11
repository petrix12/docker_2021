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
1. Ingresar al contenedor de php:
2. mmm
3. Commit Video 06:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 07. Servicio Web para guardar
1. Commit Video 07:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 08. Servicio Web para consultar
1. Commit Video 08:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 09. Servicio Web para actualizar
1. Commit Video 09:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 10. Servicio Web para eliminar
1. Commit Video 10:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

## Sección 05: Diseño con HTML5 y Bootstrap 4

### 11. Instalar Bootstrap
1. Commit Video 11:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 12. Diseño de CRUD
1. Commit Video 12:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 13. Implementando jQuery
1. Commit Video 13:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 14. Consultado información con Ajax jQuery y PHP
1. Commit Video 14:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 15. Restructurando los archivos
1. Commit Video 15:
    + $ git add .
    + $ git commit -m ""
    + $ git push -u origin main

### 16. Guardando información con Ajax jQuery y PHP
1. Commit Video 16:
    + $ git add .
    + $ git commit -m ""
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