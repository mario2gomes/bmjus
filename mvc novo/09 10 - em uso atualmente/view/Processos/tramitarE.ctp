<div class="filtro form">
    <div class="row-fluid">
                            <?php echo $this->Form->create('Tramitacao',['url' => ['action' => 'tramitar']]);
                                //array('url' => array('controller'=>'processos','action' => 'tramitar'))
                                echo $this->Form->input('funcao_entrega_id', array('value' => $grupos, 'type'=> 'hidden'));
                                echo $this->Form->select('funcao_recebe_id', $funcoes);
                                echo $this->Form->input('processos_id', array('value' => $processo['Processo']['id'], 'type'=> 'hidden'));
                                echo $this->Form->input('despacho', array('type'=>'textarea'));
                            ?>
                                    <div class="span12"><hr></div>
        <? echo $ajax->submit('Tramite', array('url' => array('action' => 'tramitar'), 'before'=>'$(this).attr("value", "Pesquisando...")', 'after' => "$('.close').click();", 'update' => 'resultadoPesquisa', 'class' => 'btn btn-small btn-success', 'div'=>'span12')); ?>
    <? echo $this->Form->end();?>

        
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            orientation: "top left",
            autoclose: true
        });
    });
</script>

                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tramitar</strong></button>
                            <?php //echo $this->Form->end('Salvar', array('class'=>"btn btn-sm btn-primary pull-right m-t-n-xs"));?>
