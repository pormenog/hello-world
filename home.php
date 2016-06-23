<?
session_start();
if (!isset($email)) {
 header('Location: index.php');
}

include ("conect/conect.php");
$link = conectar_db();

$admins = array();
$administrador = false;
$perfil = 0;
$sql = " SELECT email, perfil FROM usuario ";
$cur = mssql_query($sql,$link);

while ($row = mssql_fetch_array($cur))
	array_push($admins,$row["email"]);

if (!in_array($email,$admins)) 
	header('Location: logout.php');
else {
	$sql = " SELECT perfil FROM usuario WHERE email = '$email' ";
	$cur = mssql_query($sql,$link);
	$row = mssql_fetch_array($cur);
	$perfil = $row["perfil"];
	if($perfil == 1)
		$administrador = true;
}
session_register("perfil");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Monitor DTE</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
	<![endif]-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
        	<div class="page-header">
				<div class="row">
					<div class="col-md-10">
						<h1>
							Monitor DTE <small>Seleccione la opción que desee</small>
						</h1>
					
					</div>
					<div class="col-md-1">
						<a href="logout.php">
							<button type="button" class="btn btn-primary btn-lg" >
							Cerrar sesión</button>
						</a>	
					</div>
				</div>
			</div>
			<div class="row">
<?				
			if ($administrador) 
			{
?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="300x200" src="img/admin.png">
						<div class="caption">
							<h3>
								Administración</h3>
							<p>
								Ingrese a este módulo para poder agregar o eliminar usuarios
							</p>
							<p>
								<a class="btn btn-primary" href="modulos/administracion.php">Entrar</a>
							</p>
						</div>
					</div>	
				</div>
<?
			} else {
?>
				<div class="col-md-2">&nbsp;</div>
<?
			}
?>				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="300x200" src="img/documentos_enviados.png">
						<div class="caption">
							<h3>
								Documentos emitidos
							</h3>
							<p>
								Ingrese a este módulo para visualizar los documentos emitidos por el Holding KCC.
							</p>
							<p>
								<a class="btn btn-primary" href="modulos/documentos_emitidos.php">Entrar</a> 
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="thumbnail">
						<img alt="300x200" src="img/documentos_recibidos.jpg">
						<div class="caption">
							<h3>
								Documentos recibidos
							</h3>
							<p>
								Ingrese a este módulo para visualizar los documentos recibidos.
							</p>
							<p>
								<a class="btn btn-primary" href="modulos/documentos_recibidos.php">Entrar</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
