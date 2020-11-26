<div class="modal fade" id="emitir_parecer" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                    	<h3 class="m-t-none m-b"><?php echo 'Emitir parecer ', $processo['Tipo_processo']['descricao'],' ', $processo['Processo']['num_processo']; ?></h3>
	                        <div class="widget-box"> 
					       <?php
								echo $this->Form->create('Parecer',array('url' => array('controller'=>'processos','action' => 'emitirParecer')));
                                if (in_array(33, $tipo_documento_desse_processo) && in_array(34, $tipo_documento_desse_processo)){
                                    echo $this->Form->input('envios_id',array('value' =>2, 'type' => 'hidden') );
                                }elseif (in_array(30, $tipo_documento_desse_processo) 
                                    && in_array(31, $tipo_documento_desse_processo)) {
                                    echo $this->Form->input('envios_id',array('value' =>1, 'type' => 'hidden') );
                                }
                                echo $this->Form->input('tipo_id',array('class' => 'form-control', 'div' => 'form-group','label'=>'Parecer:','options' => array(1=>'homologar',2=>'rejeitar'), 'empty' => '--Selecione--') );
                                echo $this->Form->input('processo_id', array('value' => $processo['Processo']['id'], 'type'=> 'hidden'));
								echo $this->Form->input('emissor_id', array('value' => $usuario_atual['cpf'], 'type'=> 'hidden'));
								echo $this->Form->input('despacho', array('type'=>'textarea'));
                                ?> <br> <?php
                                echo $this->Form->end(array('label'=>'Emitir parecer','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));
							?>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
