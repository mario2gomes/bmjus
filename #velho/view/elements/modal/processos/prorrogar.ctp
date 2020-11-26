<div class="modal fade" id="prorrogar" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                        <h3 class="m-t-none m-b"><?php echo 'Prorrogar ', $processo['Tipo_processo']['descricao'],' ', $processo['Processo']['num_processo'], ' por:'; ?></h3>
                            <div class="widget-box"> 
                           <?php
                                echo $this->Form->create('Prorrogacao',array('url' => array('controller'=>'processos','action' => 'prorrogar')));

                                switch ($processo['Processo']['tipo_processos_id']) {
                                    case 1:
                                        $qtd_dias = 15;
                                        break;
                                    case 2:
                                        $qtd_dias = 15;
                                        break;
                                    case 3:
                                        $qtd_dias = 20;
                                        break;
                                    case 4:
                                        $qtd_dias = 10;
                                        break;
                                }
                                //caso seja o comandante geral a quantidade de dias precisa ser definida por ele
                                if ($usuario_atual['funcao_id'] == 1260) {
                                    echo $this->Form->input('qtd_dias', array('label'=>'Quantos dias?'));
                                }else{
                                    echo $this->Form->input('qtd_dias', array('value' => $qtd_dias, 'type' => 'hidden'));
                                }
                                echo $this->Form->input('processo_id', array('value' => $processo['Processo']['id'], 'type'=> 'hidden'));
                                echo $this->Form->input('responsavel_funcional', array('value' => $usuario_atual['cpf'], 'type'=> 'hidden'));
                                echo $this->Form->input('responsavel_legal',array('value' => $usuario_atual['cpf'], 'type'=> 'hidden'));
                                ?>
                                <!--<b>Inicia em:</b>
                                <br> -->
                                <?php
                                //echo $this->Form->date('data_inicio',array('label'=>'Inicia em: ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));
                                echo $this->Form->input('bgo', array('label' => 'Publicado no BGO Nº: '));
                                echo $this->Form->input('motivo', array('type'=>'textarea'));
                                echo $this->Form->end(array('label'=>'Prorrogar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Prorrogar</strong></button> -->
                            <?php //echo $this->Form->end('Salvar', array('class'=>"btn btn-sm btn-primary pull-right m-t-n-xs"));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>