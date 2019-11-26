<div class="modal fade" id="solucionar" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                        <h3 class="m-t-none m-b"><?php echo 'Emitir solução do processo: ', $processo['Tipo_processo']['descricao'],' ', $processo['Processo']['num_processo']; ?></h3>
                            <div class="widget-box"> 
                           <?php
                                echo $this->Form->create('Solucao',array('url' => array('controller'=>'processos','action' => 'solucionar')));
                                echo $this->Form->input('processo_id', array('value' => $processo['Processo']['id'], 'type'=> 'hidden'));
                                echo $this->Form->input('tipo_id',array('class' => 'form-control', 'div' => 'form-group','label'=>'Solução','options' => $tipos_solucao, 'empty' => '--Selecione--') );
                                echo $this->Form->input('parecer_id', array('value' => 0, 'type'=> 'hidden'));
                                echo $this->Form->input('enquadramento_id',array('class' => 'form-control', 'div' => 'form-group','label'=>'Enquadramento','options' => $enquadramentos, 'empty' => '--Selecione--'));
                                echo $this->Form->input('observacao',array('type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group', 'label'=>'Observações: '));
                                echo $this->Form->end(array('label'=>'Enviar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>