<div class="modal fade" id="tramitar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">NOVO PROCESSO</h3>

                        <p>Preencha os dados do novo processo</p>

                        <div class="widget-box"> 

                            <?php echo $this->Form->create('Processo', ['url' => ['action' => 'novo']]); ?>
                            <?php echo $this->Form->input('tipo_processos_id',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "procedimento", 'label'=>'Procedimento','options' => $tipos, 'empty' => '--Selecione--') );?>
                            <?php echo $this->Form->date('data_bgo',array('label'=>'Data do BGO', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Data BGO", 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
                            <?php echo $this->Form->input('num_processo',array('label'=>'Número do processo', 'upper' => 'true', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número do processo"));?>
                            <?php echo $this->Form->input('num_portaria',array('label'=>'Número da portaria', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número da portaria"));?>
                            <?php echo $this->Form->input('num_bgo',array('label'=>'Número do BGO', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número do BGO"));?>
                            <?php echo $this->Form->input('obm',array( 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "OBM"));?>
                            <?php echo $this->Form->input('instaurador',array('label'=>'Autoridade Instauradora', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Instaurador"));?>
                            <?php echo $this->Form->input('encarregado',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "encarregado"));?>
                            <?php echo $this->Form->input('investigado',array('label'=>'Investigado (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "investigado"));?>
                            <?php echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "escrvão"));?>
                            <?php echo $this->Form->input('descricao',array('type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "descrição"));?>
                            <?php //echo $this->Form->end('Salvar', array('class'=>"btn btn-sm btn-primary pull-right m-t-n-xs"));?>
                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









<div class="modal fade" id="tramitar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">TRAMITAR</h3>

						<ul class="dropdown-menu">
						    <li><?php echo $this->Html->link('Instaurador', array('controller' => 'processos', 'action' => 'tramitar', $processo['Processo']['id'], $recebedor=1)); ?></li>
						    <li><?php echo $this->Html->link('Encarregado', array('controller' => 'processos', 'action' => 'tramitar', $processo['Processo']['id'], $recebedor=2)); ?></li>
						    <li><?php echo $this->Html->link('Corregedoria', array('controller' => 'processos', 'action' => 'tramitar', $processo['Processo']['id'], $recebedor=3)); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




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