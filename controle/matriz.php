<?php

require_once '../banco/MySQL.php';

$my = new MySQL;

foreach ($_REQUEST as $chaves => $request):
    $_REQUEST[$chaves] = addslashes($request);
endforeach;

function resposta($resp, $msg) {
    die(json_encode(array('resposta' => $resp, 'dados' => $msg)));
}

if(!isset($_REQUEST['modulo'])){
        $_REQUEST['modulo'] = "dafault";
    }

switch ($_REQUEST['modulo']):

  case 'gravar' :

    $var_1 = utf8_decode($_REQUEST['nome']);

    $query = $my->query("INSERT INTO matriz (nome) VALUES ('" . $var_1 . "') ");

    die($query['resposta'] ? "OK" : "ERRO");

  break;

  case 'apagar':

    $query = $my->query("TRUNCATE TABLE matriz");
      $query = $my->query("TRUNCATE TABLE agenda");
        $query = $my->query("TRUNCATE TABLE atendimento");

    die($query['resposta'] ? "OK" : "ERRO");

  break;

  case 'inserir':

    $target_dir = "../arquivo/";
    $target_file = $target_dir . basename($_FILES["uploadImage"]["name"]);

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if($imageFileType != "csv") {
        echo "Extensão do arquivo invalida!";
      exit;
    }

    if ($_FILES["uploadImage"]["size"] > 2000000){
        echo "Tamanho do arquivo maior de 2M";
      exit;
    }

    if (file_exists("../arquivo/" . $_FILES["uploadImage"]["name"])) {
        echo $_FILES["uploadImage"]["name"] . " já existe o arquivo na base";
      exit;
    }

    if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"] , $target_file)) {
      $arquivo = fopen ($target_file, "r");
      while(($data = fgetcsv($arquivo, 10000, ";")) !== false){
        if($data[0] != 'mv_id_linha' && $data[8] == '1294'){
          $query = $my->query("INSERT INTO matriz
            (mv_id_linha, mv_stakeholder, mv_nome, mv_cidade, mv_uf, mv_oid_sup, mv_supervisor, mv_Coordenador, termos,
            assist15, assist30, contatos, mv_frequencia, mv_vcto_1, mv_vcto_2, mv_vcto_3)
          VALUES
            ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[9]."'
            ,'".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[16]."',
            '".date("Y-m-d", strtotime(implode("-", array_reverse(explode("/", $data[17])))))."',
            '".date("Y-m-d", strtotime(implode("-", array_reverse(explode("/", $data[18])))))."',
            '".date("Y-m-d", strtotime(implode("-", array_reverse(explode("/", $data[19])))))."')");
        }
      }
        echo "Matriz carregada com sucesso!";
    } else {
        echo "Não foi possivél gravar a matriz";
    }

  break;

  case 'listar':

    $lista = $my->query("SELECT mv_oid_sup, mv_supervisor FROM matriz WHERE mv_oid_sup != '' GROUP BY mv_oid_sup, mv_supervisor");

    $retorno = '';

    foreach ($lista['dados'] as $c):
        
        $retorno .= '<tr>
                <td class="text-center">'.$c['mv_oid_sup'].'</td>
                <td class="text-left"><a href="?p=agenda&id='.$c['mv_oid_sup'].'">'.$c['mv_supervisor'].'</a></td></tr>';
                
    endforeach;

    die(utf8_encode($retorno));

  break;

endswitch;

?>
