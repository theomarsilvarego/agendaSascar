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

  case 'buscar':

    $clientes = $my->query("SELECT mv_id_linha, mv_nome FROM matriz WHERE mv_oid_sup = " . $_REQUEST['id']);

    $retorno = array();

    foreach ($clientes['dados'] as $cliente):
        $retorno[] = array(
            'id' => $cliente['mv_id_linha'],
            'nome' => ($cliente['mv_nome'])
        );
    endforeach;
    die(json_encode($retorno));

  break;

  case 'gravar':

      $date = $_REQUEST['diaVisita'];
      $date = str_replace('/', '-', $date);
      $date = date('Y-m-d', strtotime($date));
      $mes = date('m', strtotime($date));
      $hora = $_REQUEST['horaVisita'];
      $datetime = $date . ' ' . $hora;


      $var_1 = $_REQUEST['supervisor'];
      $var_2 = $_REQUEST['cliente'];
      $var_3 = $datetime;

      $pesquisa = $my->query("SELECT * FROM agenda WHERE idSupervisor = '".$var_1."' AND idCliente = '".$var_2."' AND dataVisita = '".$var_3."' ");

      if(count($pesquisa['dados'])){
        resposta("Já existe agendamento deste cliente esté horário: " . $var_3, false);
        exit;
      } 

      $query = $my->query("INSERT INTO agenda (idSupervisor, idCliente, dataVisita)
          VALUES ('". $var_1 ."', '". $var_2 ."', '". $var_3 ."') ");

      resposta("Dados cadastrados com sucesso!", true);

  break;

endswitch;

?>
