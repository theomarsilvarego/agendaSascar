<?php

require_once '../banco/MySQL.php';

$my = new MySQL;

foreach ($_REQUEST as $chaves => $request):
    $_REQUEST[$chaves] = addslashes($request);
endforeach;

function resposta($resp, $msg) {
    die(json_encode(array('resposta' => $resp, 'dados' => $msg)));
}

switch ($_REQUEST['modulo']):

  case 'gravar':

  $var_1 = $_REQUEST['idAgenda'];
  $var_2 = $_REQUEST['descResumo'];
  $var_3 = $_REQUEST['descRealizado'];
  $var_4 = $_REQUEST['descPendente'];
  $var_5 = $_REQUEST['tipoAtendimento'];



  $fp = fopen("../arquivo/FPA".$var_1.".txt", "a+",0);
  $texto = "**********************************************************"."\r\n";
  $texto .= "Empresa: " . $_REQUEST['descEmpresa'] . " \r\n";
  $texto .= "Atendimento realizado para: " . $_REQUEST['tipoAtendimento'] . "\r\n";
  $texto .= "**********************************************************"."\r\n";
  $texto .= "Resumo do atendimento: \r\n";
  $texto .= wordwrap($_REQUEST['descResumo'], 58,"\r\n", true);
  $texto .= "\r\n"."**********************************************************"."\r\n";
  $texto .= "Ações realizadas: \r\n";
  $texto .= wordwrap($_REQUEST['descRealizado'], 58,"\r\n", true);
  $texto .= "\r\n"."**********************************************************"."\r\n";
  $texto .= "Ações pendentes: \r\n";
  $texto .= wordwrap($_REQUEST['descPendente'], 58,"\r\n", true);
  $texto .= "\r\n"."**********************************************************"."\r\n";
  $texto .= "Atendimento realizado por: \r\n";
  $texto .= "Lucio Lopes \r\n";
  $texto .= "Supervisor Regional de Serviços ao Cliente - NORTE/NORDESTE \r\n(69) 9220-2066 \r\nlucio.lopes@sascar.com.br \r\n";
  $texto .= "**********************************************************"."\r\n";
  $texto .= "Você receberá uma pesquisa de satisfação para avaliar este ". "\r\n" ."atendimento. Contamos com sua colaboração na participação ". "\r\n" ."desta pesquisa, ela é importante para aprimorar nossos serviços. \r\n";
  $texto .= "**********************************************************"."\r\n";
  $texto .= "SASCAR Paixão pela Inovação \r\nCentral de atendimento 0800 648 6004 / 4002 6004 \r\nCentral de roubos 0800 648 6003 \r\nTelevendas 0300 789 6004";
  $escreve = fwrite($fp, "$texto");

  $pesquisa = $my->query("SELECT * FROM atendimento WHERE idAgenda = " . $_REQUEST['idAgenda']);
  if(count($pesquisa['dados'])){
    $query = $my->query("UPDATE atendimento SET tipoAtendimento = '".$var_5."', descResumo = '".$var_2."', descRealizado = '".$var_3."', descPendente = '".$var_4."' WHERE idAgenda = " . $_REQUEST['idAgenda']);
    resposta("Atualização realizado com sucesso!", true);
  } else {
    $query = $my->query("INSERT INTO atendimento (idAgenda, tipoAtendimento, descResumo, descRealizado, descPendente)
                  VALUES ('". $var_1 ."', '". $var_5 ."', '". $var_2 ."', '". $var_3 ."', '". $var_4 ."') ");
    resposta("Cadastro realizado com sucesso!", true);
  }


  break;

endswitch;


?>
