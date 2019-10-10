<? if (isset($salvou) && $salvou) { ?>
    <script>
        //Atualiza a tabela de averbação após a inclusão ou alteração de averbação
        var url = '<?php echo $this->Html->url(array('controller' => 'tempo_averbados', 'action' => 'por_militar')); ?>' + '/' + militar_id;
        $.get(url, function(data) {
            $('#averbacoes').html(data);
            $('#add_averbacao').modal('hide');
        });

        //aguarda 3 segundos e dá um refresh na página
        setTimeout(function() {
            location.reload(true);
        }, 3000);

    </script>
<? } ?>
<script>
    $('.modal-body').scrollTop(0);
    $(document).ready(function() {
        $('.slideToggler2').click(function() {
            $('.slideContent2').slideToggle();
            return false;
        });
    });
</script>
<div class="averbacoes form">    
    <div id="form_averbacao" class="row-fluid">        
        <? echo $this->Form->create('TempoAverbado', array('controller' => 'tempo_averbados', 'action' => 'add')); ?>
        <?
        if (isset($this->data['TempoAverbado']['id'])) {
            echo $this->Form->input('id');
        }
        ?>
        <? echo $this->Form->input('militar_id', array('type' => 'hidden', 'value' => $militar['Militar']['id'])); ?>
        <? echo $this->Form->input('militar_resp_id', array('type' => 'hidden')); ?>
        <? echo $this->Form->input('dsc_referencia', array('label' => 'Referência', 'class' => 'span12', 'div' => 'span5', 'options' => $referencia, 'empty' => '---')); ?>             
        <? echo $this->Form->input('num_bol', array('label' => 'Nº BGO', 'class' => 'span12', 'div' => 'span2')); ?>
        <? echo $this->Form->input('dsc_boletim', array('label' => 'BGO PM/CBM', 'class' => 'span12', 'div' => 'span3', 'options' => $tipo_bgo, 'empty' => '---')); ?>            
        <? echo $this->Form->input('dat_bol', array('label' => 'Data Publicação', 'type' => 'date', 'class' => 'span3', 'div' => 'span12', 'empty' => ' --- ', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16)); ?>
        <? echo $this->Form->input('tip_contagem', array('label' => 'Tipo Contagem', 'class' => 'span3', 'div' => 'span12', 'options' => $tipo_contagem, 'empty' => '---')); ?>
        <? echo $this->Form->input('dat_inicial', array('label' => 'Data Inicial', 'type' => 'date', 'class' => 'span3', 'div' => 'span12', 'empty' => ' --- ', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16)); ?>
        <? echo $this->Form->input('dat_final', array('label' => 'Data Final', 'type' => 'date', 'class' => 'span3', 'div' => 'span12', 'empty' => ' --- ', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16)); ?>

        <div class="clearfix"></div>
        <div class="space-9"></div>
        
        <div class="span12">
            <a class="slideToggler2 btn btn-small btn-info" href="#">Informar tempo manualmente</a>
        </div>
        <div class="clearfix"></div>
        <div class="space-6"></div>
        <div class="slideContent2 span9" style="display:none">

            <? echo $this->Form->input('qtd_ano', array('label' => 'Ano(s)', 'class' => 'span10', 'div' => 'span2', 'numeric' => 'true', 'maxlength' => 2)); ?>
            <? echo $this->Form->input('qtd_mes', array('label' => 'Mes(es)', 'class' => 'span10', 'div' => 'span2', 'numeric' => 'true', 'maxlength' => 2)); ?>
            <? echo $this->Form->input('qtd_dia', array('label' => 'Dia(s)', 'class' => 'span10', 'div' => 'span2', 'numeric' => 'true')); ?>
        </div>
        <div class="clearfix"></div>
        <div class="space-6"></div>
        
        <? echo $this->Form->input('dsc_historico', array('type' => 'textarea', 'label' => 'Motivação da averbação/Causa', 'class' => 'span10', 'div' => 'span12', 'upper' => 'true', 'maxlength' => 600)); ?>                                        
        <? echo $ajax->submit('Averbar', array('url' => array('controller' => 'tempo_averbados', 'action' => 'add'), 'before' => '$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'form_averbacao', 'class' => 'btn btn-small btn-success', 'div' => 'span12')); ?>
        <? echo $this->Form->end(); ?>
    </div>
</div>