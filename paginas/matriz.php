<div id="general-content" class="container-fluid">

	<br/><br/><br/>
	<div class="row">
		<div class="container-fluid">
			<form id="cadastrar" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-12 col-lg-12 col-sm-12">
						<div class="well">
							<legend class="m0">
								<i class="fa fa-envelope"></i> Agenda
							</legend>
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<input 
											id="uploadImage" name="uploadImage" type="file"  />
									</div>
								</div>
							</div>
                            <div class="box-footer">
                                <button id="envioFile" type="submit" class="btn btn-primary">Grava Matriz</button>
                                <button id="apagar" type="submit" class="btn btn-danger">Limpar base</button>
                            </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-lg-12 col-sm-12">
						<div class="well">
							<fieldset>
								<legend class="m0 text-success">
									<i class="fa fa-envelope"></i> Tabela de Supervisores
								</legend>
								<table id="listar" rel="ajax-list"
									class="table table-condensed table-hover m0">
									<thead>
                                        <tr>
                                          <th class="text-center">ID</th>
                                          <th class="text-center">Supervisor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td></td><td></td></tr>
                                    </tbody>
								</table>
							</fieldset>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

var atualizaTabela = function()
{
    var t = $('#listar tbody');
    $.post('./controle/matriz.php', {modulo: 'listar'}, function(data) {
        t.html(data);
    });
};

$("#cadastrar").submit(function(e){
    e.preventDefault();
  var formData = new FormData(this);
    formData.append('modulo', 'inserir');
  $.ajax({
    url: './controle/matriz.php',
    type: 'post',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(data){
      alert(data)
    }
  });
  atualizaTabela();
});

$("#enviar").click(function(){
    var nome = $("#nome").val();
    $.post('./controle/matriz.php', {modulo: 'gravar', nome: nome}, function(resposta){
      if(resposta != "OK"){
        alert('Erro na Operação realizada.')
      } else {
        alert('Operação realizada com sucesso.')
      }
    });
    return false;
});

$(".btn-danger").click(function(){
  confirm('Deseja realmente excluir a base de dados')
});

$("#apagar").click(function(){
  $.post('./controle/matriz.php', {modulo: 'apagar'});
  alert('Base limpa!')
});

atualizaTabela();
</script>