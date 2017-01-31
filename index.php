<?php
    require './controle/verifica.php';
    require './banco/MySQL.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sistema de Agenda Sascar">
	<meta name="author" content="AtivaWorks - Theomar Rego">

	<title>Agendamento SASCAR</title>

	<link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/jquery-ui.css" />
    <link rel="stylesheet" href="./css/fullcalendar.min.css"/>
    
    <script src="./js/moment.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery-ui.js"></script>
    <script src="./js/fullcalendar.min.js"></script>

</head>
<body>
	<header id="main">
		<nav class="navbar navbar-default navbar-fixed-top open-hover"
			role="navigation"
			style="box-shadow: 0 1px 2px rgba(43, 59, 93, 0.29);">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle"
								data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">Menu</span> <span class="icon-bar"></span>
								<span class="icon-bar"></span> <span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="./"><i class="fa fa-briefcase"></i>
								<b>Agendamento</b></a>
						</div>
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav navbar-right navbar-notificacoes">
								<li>
									<div style="padding: 17px 17px;"><?php echo $_SESSION["nome"] ?></div>
								</li>
								<li><a id="logout" href="./controle/Logout.php">Sair</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>

  <?php
    
    if(!isset($_GET['p'])){
        $_GET['p'] = "default";
    }
    
    switch ($_GET['p']) {
      case 'agenda': include('paginas/agenda.php');
        break;
      case 'atendimento': include('paginas/atendimento.php');
        break;
      default:
        include('paginas/matriz.php');
        break;
        }
      ?>
	<footer id="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<hr class="mt10 mb10">
					<span>Theomar Rego / Lúcio Lopes</span>
					<div class="clearfix">&nbsp;</div>
				</div>
			</div>
		</div>
	</footer>

</body>
</html>
