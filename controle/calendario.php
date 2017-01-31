<?php

    require_once '../banco/MySQL.php';

    $my = new MySQL;

    $eventos = $my->query("SELECT a.id as id, m.mv_nome as cliente, a.dataVisita as dataVisita, a.idCliente as idCliente
                           FROM agenda a
                            INNER JOIN matriz m on a.idCliente = m.mv_id_linha");

    $retorno = array();

    foreach ($eventos['dados'] as $evento):
        $retorno[] = array(
            'id' => $evento['id'],
            'title' => $evento['cliente'],
            'start' => $evento['dataVisita'],
            'end' => $evento['dataVisita'],
            'url' => './?p=atendimento&id='.$evento['id']
        );
    endforeach;
    die(json_encode($retorno));


?>