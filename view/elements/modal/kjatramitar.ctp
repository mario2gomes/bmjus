<div class="tramitacoes form">

	<fieldset>

		<div class="span3">
			<div class="widget-box collapsed">
				<div class="widget-header">
					<h4>Tramitar</h4>
					<span class="widget-toolbar">
						<a href="#" data-action="collapse"><i class="icon-chevron-up"></i></a>
					</span>
				</div>
				<div class="widget-body">
					<div class="widget-body-inner" style="display: block;">
				 		<div class="widget-main">
							<div class="row-fluid">
								<div class="container">
									<div class="span1">
										<?php
											echo $this->Form->create('Tramitacao', array('url' => array('controller'=>'processos','action' => 'tramitar')));
											echo $this->Form->select('funcao_recebe_id', $funcoes);
											echo $this->Form->input('despacho', array('type'=>'textarea'));
											echo $this->Form->input('funcao_entrega_id', array('value' => $user['Usuario']['grupo_id'], 'type'=> 'hidden'));
											echo $this->Form->input('processos_id', array('value' => $processo['Processo']['id'], 'type'=> 'hidden'));
											echo $this->Form->end('Salvar');
										?>
									</div>
								</div>
				 			</div>
						</div>
					</div>
				</div>
		  </div>
		</div>
	</fieldset>
</div>