<!-- Modal -->
<div class="modal fade" id="reabrir" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                        <h3 class="m-t-none m-b"><?php echo 'Reabrir ', $processo['Tipo_processo']['descricao'],' ', $processo['Processo']['num_processo']; ?></h3>
                            <div class="widget-box"> 
                                Qual a data de reabertura do processo?
                                   <?php 
                                   foreach ($processo['Suspensao'] as $sus) {
                                        if(!$sus['data_termino']){
                                            $suspensao = $sus;
                                        }
                                   }
                                    echo $this->Form->create('Suspensao',array('url' => array('controller'=>'processos','action' => 'reabrir')));
                                    echo $this->Form->input('id', array('value'=> $suspensao['id'], 'type'=>'hidden'));
                                    echo $this->Form->input('processo_id', array('value' => $suspensao['processo_id'], 'type'=> 'hidden'));
                                    echo $this->Form->input('motivo', array('value' => $suspensao['motivo'], 'type'=> 'hidden'));
                                    echo $this->Form->input('responsavel_legal',array('value' => $suspensao['responsavel_legal'], 'type'=> 'hidden'));
                                    echo $this->Form->input('responsavel_funcional', array('value' => $suspensao['responsavel_funcional'], 'type'=> 'hidden'));
                                    echo $this->Form->date('data_inicio',array('value' => $suspensao['data_inicio'], 'type'=> 'hidden'));
                                    echo $this->Form->input('bgo', array('value' => $suspensao['bgo'], 'type'=> 'hidden'));
                                    echo $this->Form->date('data_termino',array('label'=>'Data de reabertura: ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 1, 'maxYear' => date('Y') + 1));
                                    echo $this->Form->end(array('label'=>'Reabrir','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));
                                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>