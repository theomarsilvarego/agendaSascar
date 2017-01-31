<?php
  $id = $_GET['id'];
?>
<div id="general-content" class="container-fluid">

	<br/><br/><br/>
	<div class="row">
		<div class="container-fluid">
			<form id="cadastrar" method="post" enctype="multipart/form-data" >
				<div class="row">
					<div class="col-lg-12 col-lg-12 col-sm-12">
						<div class="well">
							<legend class="m0">
								<i class="fa fa-envelope"></i> Agenda
							</legend>
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Supervisor</label>
                                        <select id="supervisor" class="form-control select2" disabled="disabled" style="width: 100%;">
                                          <?php
                                            $my = new MySQL();
                                            $sup = $my->query("SELECT mv_oid_sup, mv_supervisor FROM matriz WHERE mv_oid_sup = ".$id." GROUP BY mv_oid_sup, mv_supervisor");
                                            foreach ($sup['dados'] as $s) :
                                              echo '<option value="' . $s['mv_oid_sup'] . '" >' . $s['mv_supervisor'] . '</option>';
                                            endforeach;
                                           ?>
                                         </select>
									</div>
								</div>
							</div>
                            
                            <div class="form-group">
                                <label>Clientes</label>
                                <select id="cliente" class="form-control select2" style="width: 100%;">
                                  <option></option>
                                  <?php
                                    $my = new MySQL();
                                    $clientes = $my->query("SELECT mv_id_linha, mv_nome FROM matriz WHERE mv_oid_sup = " . $id . " ORDER BY mv_nome ASC");
                                    foreach ($clientes['dados'] as $s) :
                                      echo '<option value="' . $s['mv_id_linha'] . '" >' . utf8_decode($s['mv_nome']) . '</option>';
                                    endforeach;
                                   ?>
                                </select>
                             </div>
                            
                            <div class="form-group">
                              <label>Dia da Visita</label>
                              <input id="diaVisita" class="form-control pull-right" type="text">
                            </div>
                            
                            <div class="form-group">
                              <label>Horário da Visita</label>
                              <select id="horaVisita" class="form-control select2" style="width: 100%;">
                                <option selected="selected">08:00</option>
                                <option>09:00</option>
                                <option>10:00</option>
                                <option>11:00</option>
                                <option>14:00</option>
                                <option>15:00</option>
                                <option>16:00</option>
                                <option>17:00</option>
                              </select>
                            </div>
                            
                            <div class="box-footer">
                                <button id="enviar" type="submit" class="btn btn-primary">Gravar</button>
                            </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-lg-12 col-sm-12">
						<div class="well">
							<fieldset>								
								<div id='calendar'></div>
							</fieldset>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    $( function() {
        $( "#diaVisita" ).datepicker();
    });
    
    
    $(document).ready(function() {
		$('#calendar').fullCalendar({	
            ignoreTimezone: false,
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            events: './controle/calendario.php',
			theme: true,
			navLinks: true, // can click day/week names to navigate views
			editable: false,
			eventLimit: true // allow "more" link when too many events
		});
		
	});
    
     $("#enviar").click(function(){
      var supervisor = $("#supervisor").val()
      var cliente = $("#cliente").val()
      var diaVisita = $("#diaVisita").val()
      var horaVisita = $("#horaVisita").val()
      $.post('./controle/agenda.php', {modulo: 'gravar',
        supervisor: supervisor,
        cliente: cliente,
        diaVisita: diaVisita,
        horaVisita: horaVisita}, 
        function(dados){
            alert(dados.resposta);
            $('#calendar').fullCalendar('refetchEvents');
      }, 'json');
      return false;
  });
</script>