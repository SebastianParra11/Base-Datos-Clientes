<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM clientes WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$idc=$_POST['id'];
		$doc=$_POST['doc'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$direccion=$_POST['direccion'];
		$correo=$_POST['correo'];
		$telefono=$_POST['telefono'];
		$id=(int) $_GET['id'];

		if(!empty($id)  && !empty($doc) && !empty($nombre) && !empty($apellido) && !empty($direccion) && !empty($correo) && !empty($telefono) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE clientes SET  
					id=:id,
					doc=:doc,
					nombre=:nombre,
					apellido=:apellido,
					direccion=:direccion,
					correo=:correo,
					telefono=:telefono
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':id' =>$id,
					':doc' =>$doc,
					':nombre' =>$nombre,
					':apellido' =>$apellido,
					':direccion' =>$direccion,
					':correo' =>$correo,
					':telefono' =>$telefono,
					':id' =>$id
				));
				header('Location: index.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD EN PHP CON MYSQL</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php if($resultado) echo $resultado['id']; ?>" class="input__text">
				<input type="number" name="doc" value="<?php if($resultado) echo $resultado['doc']; ?>" class="input__text">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<input type="text" name="apellido" value="<?php if($resultado) echo $resultado['apellido']; ?>" class="input__text">

			</div>
			<div class="form-group">
				<input type="text" name="direccion" value="<?php if($resultado) echo $resultado['direccion']; ?>" class="input__text">
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" value="<?php if($resultado) echo $resultado['telefono']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
