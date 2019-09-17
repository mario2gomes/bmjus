<div class="modal fade" id="reabrir" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                        <h3 class="m-t-none m-b"><?php echo 'Reabrir ', $processo['Tipo_processo']['descricao'],' ', $processo['Processo']['num_processo'], ' por:'; ?></h3>
                            <div class="widget-box"> 
                           <?php
    echo $this->Form->create('Suspencao',array('url' => array('controller'=>'processos','action' => 'suspender')));

    echo $this->Form->input('relatorio_id', array('value' => $processo['Relatorio']['id'], 'type'=> 'hidden'));
    echo $this->Form->input('responsavel_funcional', array('value' => $usuarios, 'type'=> 'hidden'));
    echo $this->Form->input('responsavel_legal',array('label'=>'Autoridade responsável'));
    ?>
    <b>Inicia em:</b>
    <br>
    <?php
    echo $this->Form->date('data_inicio',array('label'=>'Inicia em: ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));
    echo $this->Form->input('bgo', array('label' => 'Publicado no BGO Nº: '));
    echo $this->Form->input('motivo', array('type'=>'textarea'));
?>
<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Suspender</strong></button>
                            <?php //echo $this->Form->end('Salvar', array('class'=>"btn btn-sm btn-primary pull-right m-t-n-xs"));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>