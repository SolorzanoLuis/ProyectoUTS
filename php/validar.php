<?php
include_once('../bd/db.php');
session_start();


if (isset($_GET['cerrar_sesion'])) {
	# code...
	session_unset();
	session_destroy();
}

if (isset($_SESSION['rol'])) {
	# code...
	switch ($_SESSION['rol']) {
		case 1:
			# code...
			header('location: administrador/admin.php');
		break;

		case 1:
			# code...
			header('location: usuario/index.php');
		break;
		
		default:
	}
}

if (isset($_POST['nombre']) && isset($_POST['passwd'])) {
	$nombre=$_REQUEST['nombre'];
	$passwd=$_REQUEST['passwd'];

	$db = new Database();
	$consulta= $db->connect()->prepare('SELECT*FROM users where nombre = :nombre and passwd= :passwd');
	$consulta->execute(['nombre'=> $nombre, 'passwd'=>$passwd]);

	$row = $consulta->fetch(PDO::FETCH_NUM);

	if ($row==true) {
		# code...
		$rol = $row[7];
		$_SESSION['rol']=$rol;

		switch ($_SESSION['rol']) {
		case 1:
			# code...
			header('location: administrador/admin.php');
		break;

		case 2:
			# code...
			header('location: usuario/index.php');
		break;
		
		default:
	}

	}else{
		include('login.php');	
	}
}
