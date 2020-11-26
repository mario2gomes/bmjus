<?php
echo $this->Html->css(array('autocomplete/token-input-facebook2'));
echo $this->Html->script(array('jquery.tokeninput.min'));
?>

<div class="modal fade" id="suspender" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                        <h3 class="m-t-none m-b"><?php echo 'Suspender ', $processo['Tipo_processo']['descricao'],' ', $processo['Processo']['num_processo']; ?></h3>
                            <div class="widget-box"> 
                           <?php
                                echo $this->Form->create('Suspensao',array('url' => array('controller'=>'processos','action' => 'suspender')));
                                echo $this->Form->input('processo_id', array('value' => $processo['Processo']['id'], 'type'=> 'hidden'));
                                echo $this->Form->input('responsavel_funcional', array('value' => $usuario_atual['cpf'], 'type'=> 'hidden'));
                                echo $this->Form->input('responsavel_legal',array('label'=>'Autoridade responsável', 'id' => 'aut'));
                                ?>
                                <b>Inicia em:</b>
                                <br>
                                <?php
                                echo $this->Form->date('data_inicio',array('label'=>'Suspensão inicia em: ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 1, 'maxYear' => date('Y') + 1));
                                echo $this->Form->input('bgo', array('label' => 'Publicado no BGO NÂº: '));
                                echo $this->Form->input('motivo', array('type'=>'textarea'));
                                echo $this->Form->end(array('label'=>'Suspender','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));
                                ?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Suspender</strong></button> -->
                            <?php //echo $this->Form->end('Salvar', array('class'=>"btn btn-sm btn-primary pull-right m-t-n-xs"));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        <?php echo $this->element('js/token_input', array('id' => 'aut', "config" => array("tokenLimit"=>1,'url' => array("controller" => "usuarios", "action" => "busca",1, "plugin" => false, 'admin' => false)))); ?>
    });
</script>