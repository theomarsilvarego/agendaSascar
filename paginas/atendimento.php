<?php
  $id = $_GET['id'];
  $my = new MySQL;
  $query = $my->query("SELECT * FROM atendimento WHERE idAgenda = " . $id);
  $r = $query['dados'][0];
?>
<div id="general-content" class="container-fluid">

	<br/><br/><br/>
	<div class="row">
		<div class="container-fluid">
			<form id="cadastrar" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-12 col-lg-12 col-sm-12">
						<div class="well">
							<legend class="m0">
								<i class="fa fa-envelope"></i> Atendimento
							</legend>
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										 <label>Empresa</label>
                                              <select id="descEmpresa" class="form-control select2" disabled="disabled" style="width: 100%;">
                                                <?php
                                                  $my = new MySQL();
                                                  $clientes = $my->query("SELECT a.idCliente as idCliente, m.mv_nome as mv_nome FROM agenda a
                                                                            INNER JOIN matriz m on a.idCliente = m.mv_id_linha
                                                                            WHERE a.id = " . $id  );
                                                  foreach ($clientes['dados'] as $s) :
                                                    echo '<option value="' . utf8_decode($s['mv_nome']) . '" >' . utf8_decode($s['mv_nome']) . '</option>';
                                                  endforeach;
                                                 ?>
                                              </select>
									</div>
								</div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Horário</label>
                                      <select class="form-control select2" disabled="disabled" style="width: 100%;">
                                        <?php
                                          $my = new MySQL();
                                          $sup = $my->query("SELECT id, dataVisita FROM agenda WHERE id = " . $id );
                                          foreach ($sup['dados'] as $s) :
                                            echo '<option value="' . $s['id'] . '" >' . $s['dataVisita'] . '</option>';
                                          endforeach;
                                         ?>
                                      </select>
                                    </div>
                                  </div>
                            </div>                         
                    </div>    
				</div>
                            
				</div>
                
                <div class="row">
					<div class="col-lg-12 col-lg-12 col-sm-12">
						<div class="well">
							<legend class="m0">
								<i class="fa fa-envelope"></i> Relatórios
							</legend>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
                                      <label>Tipo de Atendimento</label>
                                      <input id="tipoAtendimento" name="tipoAtendimento" value="<?php echo $r["tipoAtendimento"]; ?>" type="text" class="form-control pull-right"> 
                                    </div>
                                
                                    <div class="form-group">
                                      <label>Resumo do atendimento</label>
                                      <input id="descResumo" name="descResumo" value="<?php echo $r["descResumo"]; ?>" type="text" class="form-control pull-right"> 
                                    </div>
								</div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Ações Realizadas</label>
                                      <input id="descRealizado" name="descRealizado" value="<?php echo $r["descRealizado"]; ?>" type="text" class="form-control pull-right"> 
                                    </div>
                                
                                    <div class="form-group">
                                      <label>Ações Pendentes</label>
                                      <input id="descPendente" name="descPendente" value="<?php echo $r["descPendente"]; ?>" type="text" class="form-control pull-right"> 
                                    </div>
                                  </div>
                            </div>
                            
                            <br/>
                            <input id="id" type="hidden" value="<?php echo $id ?>" />
                            <div class="box-footer">
                                <button id="enviar" type="submit" class="btn btn-primary">Gravar</button>
                                <a class="btn btn-danger" href="./arquivo/FPA<?php echo $id ?>.txt" download>Gerar FPA</a>
                            </div>
                         
                    </div>    
				</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    $("#enviar").click(function(){
        var idAgenda = $("#id").val()
        var tipoAtendimento = $("#tipoAtendimento").val()
        var descResumo = $("#descResumo").val()
        var descRealizado = $("#descRealizado").val()
        var descPendente = $("#descPendente").val()
        var descEmpresa = $("#descEmpresa").val()
        $.post('./controle/atendimento.php', {modulo: 'gravar',
          idAgenda: idAgenda,
          tipoAtendimento: tipoAtendimento,
          descResumo: descResumo,
          descRealizado: descRealizado,
          descPendente: descPendente,
          descEmpresa: descEmpresa}, function(dados){
            alert(dados.resposta)
        }, 'json');
    return false;
});
</script>