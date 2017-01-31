<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sistema de Autenticação - Iperon">
	<meta name="author" content="COOSIST - Coordenadoria de Sistema">

	<title>Autenticação - Recadastramento Iperon <?php echo date('m'); ?></title>

	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body class="bg-pattern">
	<div class="container-fluid">
			<br />
			<br />
			<div class="row">
				<div class="col-md-offset-1 col-lg-4 col-lg-offset-4">
                    <div class="panel panel-default">
						<div class="panel-heading">
							<div class="panel-title text-center">
								<b class="text-primary">Autenticação</b>
							</div>
						</div>
						<div class="panel-body">
							<form id="login" method="post" autocomplete="off">
								<div class="form-group">
									<label for="CPF">Login</label>
									<div class="form-group">
										<input autofocus="" class="form-control" id="usuario"
											maxlength="11" name="usuario" tabindex="1" type="text" value="" />
									</div>
								</div>
								<div class="form-group">
									<label for="Senha">Senha</label>
									<div class="form-group">
										<input class="form-control" id="senha" name="senha"
											 tabindex="2" type="password" maxlength="8" />
									</div>
								</div>

								<input id="envia" class="btn btn-block btn-primary" type="submit" value="Entrar" />
								<div id="msg" title="Ocorreu um erro"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
	</div>
</body>
</html>
<script type="text/javascript">
    $('#envia').click(function() {
        $("#login").submit();
        return false;
    })

    $('#login').submit(function() {
        $.post(
                'controle/Login.php',
                {
                    'usuario': $('#usuario').val(),
                    'senha': $('#senha').val()
                },
        function(dados)
        {
            if (dados.resposta)
            {
                window.location = "index.php";
            }
            else
            {
                $("#msg").html(dados.dados);
            }
        },
                'json'
                );
        return false;
    });
</script>
