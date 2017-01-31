<?php

session_start();

require_once '../banco/MySQL.php';

$my = new MySQL;

foreach ($_REQUEST as $chaves => $request):
    $_REQUEST[$chaves] = addslashes($request);
endforeach;

function resposta($resp, $msg) {
    die(json_encode(array('resposta' => $resp, 'dados' => $msg)));
}

$usuario = $_REQUEST['usuario'];
$senha = $_REQUEST['senha'];

if($usuario != '' and $senha != ''):
    $db = new MySQL();
	$consulta = $db->query("SELECT * FROM usuario WHERE login = '".$usuario."' AND senha = '".$senha."' ");
		if(!count($consulta['dados'])):
			resposta(false, 'Usuario ou senha incorretos. Por favor confira os dados digitados e tente novamente.');
		else:
            $usuario = $consulta['dados'][0];
			$_SESSION["id"]	     = $usuario["id"];
			$_SESSION["nome"]	 = $usuario["nome"];			
			$_SESSION["status"]  = $usuario["status"];
			setcookie("logado", "ok", time() + 3600);
			$_SESSION["logado"] = "ok";
			resposta(true, $_SESSION);
        endif;
    else:
		resposta(false, "Você não preencheu todos os campos. Por favor entre com seu login e a senha.");
endif;

?>