<? if(isset($salvou) && $salvou){ ?>
<script>
    //Atualiza a tabela de agrega��o ap�s a inclus�o ou altera��o de agregacao
    var url = '<?php echo $this->Html->url(array('controller' => 'agregacoes', 'action' => 'por_militar')); ?>' +'/'+ militar_id;
    $.get(url, function(data){
            $('#agregacoes').html(data);
            $('#agregacao').modal('hide');
            $('#edit_agregacao').modal('hide');
    });
    
    //aguarda 3 segundos e d� um refresh na p�gina
    //setTimeout(function(){location.reload(true);}, 3000);
   
</script>
<? } ?>
<script>    
    $('.modal-body').scrollTop(0);
</script>
<div class="agregacoes form">    
    <div id="form_agregacao" class="row-fluid">        
        <? echo $this->Form->create('Agregacao', array('controller' => 'agregacoes', 'action' => 'add'));?>
            <? if(isset($this->data['Agregacao']['id'])){echo $this->Form->input('id');} ?>
            <? echo $this->Form->input('militar_id', array('type'=>'hidden', 'value'=>$militar['Militar']['id']));?>
            <? echo $this->Form->input('militar_resp_id', array('type'=>'hidden'));?>
            <? echo $this->Form->input('dat_inicio', array('label'=>'Data In�cio', 'type'=>'date', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
            <? echo $this->Form->input('num_bgo_inicio', array('label'=>'N� BGO Agrega��o', 'class'=>'span2'));?>
			<? echo $this->Form->input('dat_bgo_inicio', array('label'=>'Data BGO', 'type'=>'date', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
            <? echo $this->Form->input('dsc_observacao', array('type'=>'textarea', 'label'=>'Observa��o', 'class'=>'span10', 'upper'=>'true', 'maxlength'=>600));?>      
            <hr>                
            <? echo $ajax->submit('Agregar', array('url' => array('controller' => 'agregacoes', 'action' => 'add'), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'form_agregacao', 'class' => 'btn btn-small btn-success')); ?>
        <? echo $this->Form->end();?>
    </div>
</div>