<?php
	include_once 'conexion.php';

	$seleccionar=$con->prepare('SELECT *FROM clientes ORDER BY id ASC');
	$seleccionar->execute();
	$resultado=$seleccionar->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT *FROM clientes WHERE doc LIKE :campo OR nombre LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();
	} 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>BASE DE DATOS CLIENTES</title>
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="fonts/iconos.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="contenedor">

		<h2>CLIENTES</h2>

		<div class="barra-buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="Buscar Documento o Nombre"
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input-text">
				<input type="submit" class="btn"  name="btn_buscar" value="Buscar">
				<a href="insert.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>


		<table>
			<tr class="head">
				<td>ID</td>
				<td>DOCUMENTO</td>
				<td>NOMBRE</td>
				<td>APELLIDO</td>
				<td>DIRECCION</td>
				<td>CORREO</td>
				<td>TELEFONO</td>
				
				<td colspan="2">Acción</td>
			</tr>

			<?php foreach($resultado as $fila):?>
				
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['doc']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellido']; ?></td>
					<td><?php echo $fila['direccion']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['id']; ?>"  class="icon icon-pencil iconosedit"></a></td>
					<td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="icon icon-bin2 iconosdelete"></a></td>
				</tr>
			<?php endforeach ?>

		</table>
	


	
</body>
</html>