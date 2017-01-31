<?php
	session_start();

	if(isset($_SESSION['logado']))
	{
	    $_SESSION = array();

	    if(isset($_COOKIE[session_name()]))
	    {
	        setcookie(session_name(),'',time() - 3600);
	    }
	    session_destroy();
	}

	setcookie('logado','',time() - 3600);
    echo 'Redirecionando...';
	header("Refresh: 1;url=../login.php");
?>