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