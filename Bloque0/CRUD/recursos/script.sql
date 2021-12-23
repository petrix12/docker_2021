
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
SELECT `empleado`.`id_empleado`,
    `empleado`.`nombre`,
    `empleado`.`apellido`,
    `empleado`.`telefono`,
    `empleado`.`direccion`,
    `empleado`.`fecha_nacimiento`,
    `empleado`.`observacion`,
    `empleado`.`sueldo`
FROM `database_name`.`empleado`;
