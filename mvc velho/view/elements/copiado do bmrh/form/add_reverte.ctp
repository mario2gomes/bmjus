<? if(isset($salvou) && $salvou){ ?>
<script>
    //Atualiza a tabela de agregação após a inclusão ou alteração de agregacao
    var url = '<?php echo $this->Html->url(array('controller' => 'agregacoes', 'action' => 'por_militar')); ?>' +'/'+ militar_id;
    $.get(url, function(data){
            $('#agregacoes').html(data);
            $('#agregacao').modal('hide');
            $('#edit_agregacao').modal('hide');
        }
    );
   
</script>
<? } ?>
<div class="reverte form">    
    <div id="form_reverte" class="row-fluid">        
        <? echo $this->Form->create('Agregacao', array('controller' => 'agregacoes', 'action' => 'add'));?>
            <? //pr($agregacao['id']); die(); 
            if(isset($this->data['Agregacao']['id'])){echo $this->Form->input('id');} ?>
            <? echo $this->Form->input('militar_id', array('type'=>'hidden', 'value'=>$militar['Militar']['id']));?>
            <? echo $this->Form->input('militar_resp_id', array('type'=>'hidden'));?>
            <? echo $this->Form->input('dat_inicio', array('type'=>'hidden', 'label'=>'Data Início', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
            <? echo $this->Form->input('num_bgo_inicio', array('type'=>'hidden', 'label'=>'Nº BGO Agregação', 'class'=>'span2'));?>
            <? echo $this->Form->input('dsc_observacao', array('type'=>'hidden', 'label'=>'Observação', 'class'=>'span12', 'maxlength'=>600));?> 
            <? echo $this->Form->input('dat_retorno', array('label'=>'Data Retorno', 'type'=>'date', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
            <? echo $this->Form->input('num_bgo_retorno', array('label'=>'Nº BGO Reversão', 'class'=>'span2'));?>
			<? echo $this->Form->input('dat_bgo_retorno', array('label'=>'Data BGO', 'type'=>'date', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
            <hr>                
            <? echo $ajax->submit('Reverter', array('url' => array('controller' => 'agregacoes', 'action' => 'reverte_agregacao'), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'form_reverte', 'class' => 'btn btn-small btn-success')); ?>
        <? echo $this->Form->end();?>
    </div>
</div>