<?php
require_once ("conect/conect.php");
$link = conectar_db();

require_once 'config.php';
require_once 'google/Google_Client.php';
require_once 'google/contrib/Google_Oauth2Service.php';


$client = new Google_Client();
$client->setApplicationName("Monitor DTE");
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setApprovalPrompt(APPROVAL_PROMPT);
$client->setAccessType(ACCESS_TYPE);
$oauth2 = new Google_Oauth2Service($client);
try {

	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['token'] = $client->getAccessToken();
		echo '<script type="text/javascript">window.close();</script>'; exit;
	}
	if (isset($_SESSION['token'])) {
		$client->setAccessToken($_SESSION['token']);
	}
	if (isset($_REQUEST['error'])) {
		echo '<script type="text/javascript">window.close();</script>'; exit;
	}

	if ($client->getAccessToken()) {
		$acceso 	= true;
		$user 		= $oauth2->userinfo->get();
		$email 		= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
		$name  		= filter_var($user['given_name'], FILTER_SANITIZE_STRING);
		$apellidos 	= $user['family_name'];
		$img 		= trim(filter_var($user['picture'], FILTER_VALIDATE_URL));
		
		if (empty($img))
			$img = "img/photo.png";
		$_SESSION['token'] = $client->getAccessToken();

		if ($acceso) {
			session_start();
			$email = $email;
			$image = $img;
			$name = $name;
			$apellidos = $apellidos;
			$personalMarkup = "$img?sz=50";
			session_register("email");
			session_register("image");
			session_register("name");
			session_register("apellidos");
			session_register("personalMarkup");
			header('Location: '.$base_url.'/home.php');
		}
	} else {
		$authUrl = $client->createAuthUrl();
	}
} catch (Exception $e) {
		header('Location: '.$base_url.'/logout.php');
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Monitor DTE</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
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
	<script type="text/javascript" src="js/oauthpopup.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#login').oauthpopup({
				
				path: '<?php if(isset($authUrl)){echo $authUrl;}else{ echo '';}?>',
				width:650,
				height:450
			});
			$('#logout').googlelogout({
				redirect_url:'<?php echo $base_url; ?>/logout.php'
			});
		})
    </script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
            <div class="row clearfix">
                <div class="col-md-2 column">
                </div>
                <div class="col-md-8 column">
                    <img alt="140x140" src="img/header.jpg" width="750" />
                </div>
                <div class="col-md-2 column">
                </div>
            </div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-2 column">
		</div>
		<div class="col-md-8 column">
			<div class="carousel slide" id="carousel-696059">
				<ol class="carousel-indicators">
					<li data-slide-to="0" data-target="#carousel-696059">
					</li>
					<li data-slide-to="1" data-target="#carousel-696059" class="active">
					</li>
					<li data-slide-to="2" data-target="#carousel-696059">
					</li>
				</ol>
				<div class="carousel-inner">
					<div class="item">
						<img alt="" src="img/carrusel_1.png">
						<div class="carousel-caption">
							<h4>
								
							</h4>
							<p>
							
							</p>
						</div>
					</div>
					<div class="item active">
						<img alt="" src="img/carrusel_2.png">
						<div class="carousel-caption">
							<h4>
								
							</h4>
							<p>
								
							</p>
						</div>
					</div>
					<div class="item">
						<img alt="" src="img/carrusel_3.png">
						<div class="carousel-caption">
							<h4>
								
							</h4>
							<p>
								
							</p>
						</div>
					</div>
				</div> <a class="left carousel-control" href="#carousel-696059" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-696059" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			</div>
			<blockquote>
				<p>
					Monitor DTE
				</p> 
				<small>Para ingresar presione el botón entrar</small>
			</blockquote>
			<div class="row clearfix">
				<div class="col-md-5 column">
				  <div class="modal fade" id="modal-container-514069" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title" id="myModalLabel">
										SAP
									</h4>
								</div>
								<div class="modal-body">
									<div class="container">
                                        <div class="row clearfix">
                                            <div class="col-md-12 column">
                                                <form role="form">
                                                    <div class="form-group">
                                                    	<div class="col-md-4">
                                                         	<label for="exampleInputEmail1">Ingrese Usuario</label>
                                                         		<input type="email" placeholder="Ej: U1001001" class="form-control col-lg-2" id="exampleInputEmail1" />
                                                         </div>
                                                    </div>
                                                    <div class="form-group">
                                                         <label for="exampleInputFile">File input</label><input type="file" id="exampleInputFile" />
                                                        <p class="help-block">
                                                            Example block-level help text here.
                                                        </p>
                                                    </div>
                                                    <div class="checkbox">
                                                         <label><input type="checkbox" /> Check me out</label>
                                                    </div> <button type="submit" class="btn btn-default">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
							
						</div>
						
					</div>
					
				</div>
				<div class="col-md-4 column">
					<!--<a id="modal-100168" href="#modal-container-100168" role="button" class="btn" data-toggle="modal"><img alt="140x140" width="75%" height="75%" src="img/boton_entrar.png">
					 </a>
					-->
					<button type="button" class="btn btn-primary btn-lg" id="login">
					Iniciar sesión</button>	
					<div class="modal fade" id="modal-container-100168" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title" id="myModalLabel">
										Modal title
									</h4>
								</div>
								<div class="modal-body">
									...
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
							
						</div>
						
					</div>
					
				</div>
				<div class="col-md-4 column">
				  <div class="modal fade" id="modal-container-291968" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title" id="myModalLabel">
										Modal title
									</h4>
								</div>
								<div class="modal-body">
									...
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
							
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
		<div class="col-md-2 column">
		</div>
	</div>
</div>
</body>
</html>
