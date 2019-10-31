<? if(isset($salvou) && $salvou){ ?>
<script>
    //Atualiza a tabela de averba��o ap�s a inclus�o ou altera��o de averba��o
    var url = '<?php echo $this->Html->url(array('controller' => 'punicoes', 'action' => 'por_militar')); ?>' +'/'+ militar_id;
    $.get(url, function(data){
            $('#punicoes').html(data);
            $('#add_punicao').modal('hide');
    }); 

    
    //aguarda 3 segundos e d� um refresh na p�gina
    setTimeout(function(){location.reload(true);}, 3000); 
    

   
</script>
<? } ?>
<script>    
    $(document).ready(function(){        
   
        $('.modal-body').scrollTop(0);

        //Desabilita o campo "Dias"
        $("#dias").attr("disabled", true);

        $("#tipo_punicao").change(function(){
            var valor = $(this).val();
            if(valor == <? echo Configure::read('punicao_prisao'); ?> || valor == <? echo Configure::read('punicao_detencao'); ?>){
                $("#dias").attr("disabled", false); 
            }else{
                $("#dias").attr("disabled", true);                
            }            
         });
    });
</script>
<div class="punicoes form">    
    <div id="form_punicao" class="row-fluid">        
        <? echo $this->Form->create('Punicao', array('controller' => 'punicoes', 'action' => 'add'));?>
            <? if(isset($this->data['Punicao']['id'])){echo $this->Form->input('id');} ?>
            <? echo $this->Form->input('militar_id', array('type'=>'hidden', 'value'=>$militar['Militar']['id']));?>
            <? echo $this->Form->input('militar_resp_id', array('type'=>'hidden'));?>                        
            <? echo $this->Form->input('tipo_id', array('label'=>'Tipo Puni��o', 'class'=>'span4', 'div'=>'span12', 'options'=>$tipo_punicao, 'empty'=>'---', 'id'=>'tipo_punicao'));?>             
            <? echo $this->Form->input('qtd_dias', array('label'=>'Dias', 'class'=>'span10', 'div'=>'span3', 'options'=>$dias_mes, 'empty'=>'---', 'id'=>'dias')); ?>
            <? echo $this->Form->input('num_bol', array('label'=>'N� BGO', 'class'=>'span10', 'div'=>'span3')); ?>
            <? echo $this->Form->input('dat_bol', array('label'=>'Data BGO', 'type'=>'date', 'class'=>'span3', 'div'=>'span12', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16)); ?>
            <? echo $this->Form->input('comportamento_id', array('label'=>'Comportamento', 'class'=>'span4', 'div'=>'span12', 'options'=>$comportamento, 'empty'=>'---')); ?>
            <? echo $this->Form->input('dsc_punicao', array('type'=>'textarea', 'label'=>'Motivo', 'class'=>'span10', 'div'=>'span12', 'upper'=>'true', 'maxlength'=>1000));?>      
            <? echo $ajax->submit('Registrar puni��o', array('url' => array('controller' => 'punicoes', 'action' => 'add'), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'form_punicao', 'class' => 'btn btn-small btn-success', 'div'=>'span12')); ?>
            <? echo $this->Form->end(); ?>         
    </div>
</div>