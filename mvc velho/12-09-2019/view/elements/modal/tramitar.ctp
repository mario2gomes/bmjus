<div class="modal fade" id="tramitar" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                    	<h3 class="m-t-none m-b"><?php echo 'Tramitar ', $processo['Tipo_processo']['descricao'],' ', $processo['Processo']['num_processo'], ' para:'; ?></h3>
	                        <div class="widget-box"> 
					       <?php
								echo $this->Form->create('Tramitacao',array('url' => array('controller'=>'processos','action' => 'tramitar')));
								echo $this->Form->input('funcao_entrega_id', array('value' => $processo['Processo']['posse_id'], 'type'=> 'hidden'));
								echo $this->Form->input('usuario_tramita_id', array('value' => $usuarios, 'type'=> 'hidden'));
                                echo $this->Form->select('funcao_recebe_id', $funcoes);
								echo $this->Form->input('processos_id', array('value' => $processo['Processo']['id'], 'type'=> 'hidden'));
								echo $this->Form->input('despacho', array('type'=>'textarea'));
                                echo $this->Form->end(array('label'=>'Tramitar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));
							?>
				            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tramitar</strong></button> -->
                            <?php //echo $this->Form->end('Salvar', array('class'=>"btn btn-sm btn-primary pull-right m-t-n-xs"));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>