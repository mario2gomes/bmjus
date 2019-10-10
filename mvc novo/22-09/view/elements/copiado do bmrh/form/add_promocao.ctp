<!-- Mantem o scroll no topo -->
<script>    
    $('.modal-body').scrollTop(0);
    <?php if(isset($sucesso)){?>
        //aguarda 2 segundos e dá um refresh na página
        setTimeout(function(){location.reload(true);}, 2000); 
    <?php } ?>
</script>

<!-- Se não for possível a ação, esconde o form -->
<?php if(!isset($hide_form)){?>

    <div id="div_promover" class="promocoes form">     

        <? echo $this->Form->create('Promocao'); ?>
            <? echo $this->Form->input('militar_id', array('type'=>'hidden', 'value'=>$militar_id)); ?>
            <? echo $this->Form->input('dsc_criterio', array('label'=>'Critério de promocao', 'class'=>'span2', 'options'=>$criterios, 'empty'=>'---')); ?>
            <? echo $this->Form->input('cargo_id', array('label'=>'Posto/Graduação', 'class'=>'span1', 'options'=>$cargos, 'empty'=>'---'));?>
            <? echo $this->Form->input('cod_processo', array('label'=>'Nº do processo'));?>
            <? echo $this->Form->input('dat_promocao', array('label'=>'Data da promoção (a contar)', 'class'=>'span1', 'dateFormat'=>'DMY', 'empty'=>'---', 'minYear' => date('Y') - 35));?>
            <? echo $this->Form->input('tipo_publicacao', array('label'=>'DOE ou Boletim Geral', 'class'=>'span2', 'options'=>$tipo_publicacao, 'empty'=>'---'));?>
            <? echo $this->Form->input('num_bgo_doe', array('label'=>'Nº do DOE/BGO', 'class'=>'span1'));?>
            <? echo $this->Form->input('dat_bgo_doe', array('label'=>'Data da publicação', 'class'=>'span1', 'type'=>'date', 'dateFormat'=>'DMY', 'empty'=>'---'));?>       
        <? echo $ajax->submit('Promover', array('url' => array('controller' => 'promocoes', 'action' => 'add'), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'div_promover', 'class' => 'btn btn-success')); ?>   
		<? echo $this->Form->end();?>		

    </div>

<?php } ?>