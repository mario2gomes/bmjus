<? if(isset($salvou) && $salvou){ ?>
<script>
    //Atualiza a tabela de dependentes após a inclusão ou alteração de dependente
    var url = '<?php echo $this->Html->url(array('controller' => 'dependentes', 'action' => 'por_militar')); ?>' +'/'+ militar_id;
    $.get(url, function(data){
            $('#dependentes').html(data);
            $('#dependente').modal('hide');
            $('#edit_dependente').modal('hide');
        }
    );
   
</script>
<? } ?>
<div class="dependentes form">    
    <div id="form_dependente" class="row-fluid">        
        <?echo $this->Form->create('Dependente', array('controller' => 'dependentes', 'action' => 'add'));?>
            <? if(isset($this->data['Dependente']['id'])){echo $this->Form->input('id');} ?>
            <?echo $this->Form->input('militar_id', array('type'=>'hidden', 'value'=>$militar['Militar']['id']));?>
            <?echo $this->Form->input('nom_dependente', array('label'=>'Nome do Dependente', 'upper'=>'true', 'class'=>'span10'));?>
            <?echo $this->Form->input('cod_sexo', array('label'=>'Sexo', 'type'=>'select', 'options'=>array('F'=>'F', 'M'=>'M'), 'empty'=>'---', 'class'=>'span3'));?>
            <?echo $this->Form->input('dat_nasc', array('label'=>'Data de nascimento', 'type'=>'date', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
            <?echo $this->Form->input('cod_parentesco', array('label'=>'Parentesco', 'options'=>$parentesco, 'empty'=>'---', 'class'=>'span3'));?>
            <?echo $this->Form->input('bgo_inclusao', array('label'=>'Nº do BGO', 'class'=>'span2'));?>
            <?echo $this->Form->input('dat_inclusao', array('label'=>'Data do BGO', 'type'=>'date', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
            <hr>                
        <? echo $ajax->submit('Enviar', array('url' => array('controller' => 'dependentes', 'action' => 'add'), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'form_dependente', 'class' => 'btn btn-small btn-success')); ?>
            <? echo $this->Form->end();?>
    </div>
</div>