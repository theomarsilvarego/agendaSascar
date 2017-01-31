<?php
	//Inicia a sessão
	session_start();
	//verifica se existe dados da sessão login
	//if(!isset($_SESSION['logado']) || ($_SESSION['status'] == 1)){
	if(!isset($_SESSION['logado'])) {
	//Usuario não logado redireciona para o login
	header("Location: ./login.php");
	exit;
	}
?>