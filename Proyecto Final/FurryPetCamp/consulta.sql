SELECT citas.id, citas.hora, citas.canino, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente,
usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio FROM citas
LEFT OUTER JOIN usuarios
ON citas.usuario_id=usuarios.id
LEFT OUTER JOIN citaservicio 
ON citaservicio.citaid=citas.id
LEFT OUTER JOIN servicios 
ON servicios.id=citaservicio.servicioid
WHERE citaservicio.servicioid = "2"