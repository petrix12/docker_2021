<?php


require_once 'conexion.php';


$query = mysqli_query($conexion, "select * from empleado");


echo '<table >
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
  <tbody>';
   
  

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