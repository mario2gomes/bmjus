<? if(isset($salvou) && $salvou){ ?>
<script>
    
    //aguarda 3 segundos e dá um refresh na página
    setTimeout(function(){location.reload(true);}, 3000);    
   
   
</script>
<? } ?>
<script>    
    $('.modal-body').scrollTop(0);
</script>
<div class="assentamentos form">    
    <div id="<? $id_form = uniqid(); echo $id_form; ?>" class="row-fluid">        
        <?echo $this->Form->create('Assentamento',  array('controller' => 'assentamentos', 'action' => 'add'));?> 
            <? if(isset($this->data['Assentamento']['id'])){echo $this->Form->input('id');} ?>            
            <?echo $this->Form->input('militar_id', array('type'=>'hidden'));?>
            <?echo $this->Form->input('cod_assunto', array('label'=>'Assunto', 'options'=>$assunto, 'empty'=>'-- Selecione --', 'class'=>'span10', 'ajax'=>'true', 'url'=>'assentamentos/gettipoassunto/', 'destinoid'=>'tipoassunto'));?>
            <?echo $this->Form->input('cod_tipoassunto', array('label'=>'Tipo do Assunto', 'type'=>'select', 'options'=>$tipo_assunto, 'empty'=>'-- Selecione um assunto --', 'class'=>'span10', 'id'=>'tipoassunto'));?>            
            <?echo $this->Form->input('num_boletim', array('label'=>'Nº do BGO', 'class'=>'span3'));?>
            <?echo $this->Form->input('dat_boletim', array('label'=>'Data do BGO', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>            
            <?echo $this->Form->input('dsc_processo', array('type'=>'textarea', 'label'=>'Assentamento', 'class'=>'span12', 'maxlength'=>600, 'upper'=>'true'));?>            
            <?echo $this->Form->input('num_diario', array('label'=>'Nº do DOE', 'class'=>'span2'));?>
            <?echo $this->Form->input('dat_diario', array('label'=>'Data do DOE', 'type'=>'date', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>			
            <hr>     
            <? echo $ajax->submit('Enviar', array('url' => array('controller' => 'assentamentos', 'action' => 'add'), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => $id_form, 'class' => 'btn btn-small btn-success')); ?>            
			<? echo $this->Form->end();?>
    </div>
</div>