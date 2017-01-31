<?php

class MySQL {
    var $host       = 'localhost';
    var $username   = 'root';
    var $pass       = '123456';
    var $db         = 'controle_agenda';
    private $conn;

//	function MySQL($host, $username, $pass, $db)
	function MySQL()
	{
		$this->conn = mysqli_connect($this->host, $this->username, $this->pass);
		mysqli_select_db($this->conn, $this->db);

		return $this->conn ? TRUE : FALSE;
	}

	function query($query)
	{
		$retorno = array();
		$busca = mysqli_query($this->conn, $query);

		$retorno['resposta'] = $busca ? TRUE : FALSE;
		if(!$busca) $retorno['erro'] = mysql_error();
		$retorno['dados'] = array();

		if(!($busca === TRUE OR $busca === FALSE)):
			while($dados = mysqli_fetch_array($busca, MYSQL_ASSOC)):
				$retorno['dados'][] = $dados;
			endwhile;
		endif;

		return $retorno;
	}
}

?>
