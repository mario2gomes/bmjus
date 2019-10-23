<? if(isset($salvou) && $salvou){ ?>
<script>
    //Atualiza a tabela de averbação após a inclusão ou alteração de averbação
    var url = '<?php echo $this->Html->url(array('controller' => 'punicoes', 'action' => 'por_militar')); ?>' +'/'+ militar_id;
    $.get(url, function(data){
            $('#punicoes').html(data);
            $('#canc_punicao').modal('hide');
    });
    
    //aguarda 3 segundos e dá um refresh na página
    setTimeout(function(){location.reload(true);}, 3000); 
   
</script>
<? } ?>
<? //pr($militar); die(); ?>
<div class="punicoes form">    
    <div id="form_canc_punicao" class="row-fluid">        
        <? echo $this->Form->create('Punicao');?>
            <? echo $this->Form->input('id'); ?>
            <? echo $this->Form->input('militar_id', array('type'=>'hidden'));?>
            <? echo $this->Form->input('militar_canc_id', array('type'=>'hidden'));?>                                                
            <? echo $this->Form->input('num_bol_alt', array('label'=>'Nº BGO', 'class'=>'span10', 'div'=>'span3')); ?>
            <? echo $this->Form->input('dat_bol_alt', array('label'=>'Data BGO', 'type'=>'date', 'class'=>'span3', 'div'=>'span12', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16)); ?>            
            <? echo $this->Form->input('dsc_alteracao', array('type'=>'textarea', 'label'=>'Motivo', 'class'=>'span10', 'div'=>'span12', 'upper'=>'true', 'maxlength'=>600));?>      
            <? echo $ajax->submit('Cancelar', array('url' => array('controller' => 'punicoes', 'action' => 'cancelar'), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'form_canc_punicao', 'class' => 'btn btn-small btn-success', 'div'=>'span12')); ?>           
            <? echo $this->Form->end(); ?>         
    </div>
</div>