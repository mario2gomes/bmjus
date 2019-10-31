<? if(isset($salvou) && $salvou){ ?>
<script>
    
    //aguarda 3 segundos e dá um refresh na página
    setTimeout(function(){location.reload(true);}, 3000); 

   
</script>
<? } ?>
<script>    
    $('.modal-body').scrollTop(0);
</script>
<div class="reservas form">    
    <div id="form_reserva" class="row-fluid">        
        <? echo $this->Form->create('Militar');?>
            <? echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$militar['Militar']['id']));?>
            <? echo $this->Form->input('status_id', array('label'=>'Status', 'class'=>'span10', 'div'=>'span3', 'options'=>$status, 'empty'=>'---'));?>            
            <? echo $this->Form->input('dat_inativo', array('label'=>'Data Inativo', 'type'=>'date', 'class'=>'span3', 'div'=>'span12', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>           
            <hr>                
            <? echo $ajax->submit('Confirmar', array('url' => array('controller' => 'militares', 'action' => 'inativar', $militar['Militar']['id']), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'form_reserva', 'class' => 'btn btn-small btn-success', 'div'=>'span12')); ?>
        <? echo $this->Form->end();?>
    </div>
</div>