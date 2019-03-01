<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$id=$_POST['id'];
		$doc=$_POST['doc'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$direccion=$_POST['direccion'];
		$correo=$_POST['correo'];
		$telefono=$_POST['telefono'];

		if(!empty($doc) && !empty($nombre) && !empty($apellido) && !empty($direccion) && !empty($correo) && !empty($telefono) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO clientes(id,doc,nombre,apellido,direccion,correo,telefono ) VALUES(:id,:doc,:nombre,:apellido,:direccion,:correo,:telefono)');
				$consulta_insert->execute(array(
					':id' =>$id,
					':doc' =>$doc,
					':nombre' =>$nombre,
					':apellido' =>$apellido,
					':direccion' =>$direccion,
					':correo' =>$correo,
					':telefono' =>$telefono
				));
				header('Location: index.php');
			}
		}else{
			echo "Llena los campos";
		}

	}


?>
<!DOCTYPE html> 
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>INSERTAR NUEVOS DATOS</h2>
		<form action="" method="post">
			<div class="grupo">
			<div class="form-group">
				<input type="hidden" name="id" placeholder="id" min="1"  class="input-text"><br>
				<input type="number" name="doc" placeholder="Documento" min="1" maxlength="6" class="input-text" required><br>
				<input type="text" name="nombre" placeholder="Nombre" class="input-text"required>
				<input type="text" name="apellido" placeholder="Apellido" class="input-text"required>

			</div>
			<div class="form-group">
				<input type="text" name="direccion" placeholder="Direccion" class="input-text"required>
				<input type="tmail" name="correo" placeholder="Correo" class="input-text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" placeholder="Telefono" class="input-text"required>
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div></form>
</body>
</html>
