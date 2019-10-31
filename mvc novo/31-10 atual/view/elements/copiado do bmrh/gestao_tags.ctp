<script>
    $(document).ready(function(){
        $('.remove_tag').click(function(){
            var remove = this;
            var action = '<?php echo $this->Html->url(array('controller'=>'militares_tags', 'action'=>'removeMilitarTag')); ?>';
            var url = action + '/' + $(remove).attr('militar_tag_id');
            
            $.getJSON(url, function(data){
                if(data.sucesso == 1){
                    $(remove).parent('span').remove();
                }else{                        
                    alert(data.msg);
                }                
            });

        });
        
        $('#filtrar_marcadores').click(function(){
            var url = '<?php echo $this->Html->url(array('controller' => 'militares_tags', 'action' => 'filtrar', $obm_id)); ?>';
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                data: $('#tag_id_multi').serialize(),
                success: function(data){
                    $('#militares_lotados').html(data);
                }
            });
        });
        
        $('#checkTodos').click(function(){
            var checked = $(this).prop('checked');
            $('.check_tag').prop('checked', checked);
            if(checked){
                $('#labelTodos').text('Desfazer Seleção');
            }else{
                $('#labelTodos').text('Selecionar Todos');
            }
        });
        
//        $('.check_tag').click(function(){
//            var url = '<?php echo $this->Html->url(array('controller' => 'militares_tags', 'action' => 'getConditionsXls', $obm_id)); ?>';
//            $.ajax({
//                url: url,
//                type: 'POST',                
//                cache: false,                
//                data: $('.check_tag').serialize(),
//                success: function(data){
//                    $('#teste').html(data);
//                }
//            });
//        });

        $('#gerarXls').click(function(){
            
            var url = '<?php echo $this->Html->url(array('controller' => 'militares_tags', 'action' => 'getConditionsXls')); ?>';
            elem = this;
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                dataType: "json",
                async: false,
                data: $('.check_tag').serialize(),
                success: function(data){
                    if(data.sucesso == 1){
                        var url_modal = $(elem).attr('url');
                        var modal_id = 'campos_pesquisa';
                        $('#'+modal_id).modal('show');
                        $('#'+modal_id).children('.modal-body').html('Carregando...');
                        $.get(url_modal, function(data_modal){
                            $('#'+modal_id).children('.modal-body').html(data_modal);                
                        });            
                    }else{
                        alert(data.msg);
                    }
                }
            });
            
            
        });
        
        $('#gerencia_tags').on('hidden', function () {
            // do something?
             $('#filtrar_marcadores').click();
        });
    });
</script>

    <div id="msg">
    </div>
    <? echo $this->Form->create('MilitaresTag');?>
        <div class="form">
            <div class="row-fluid">
                <div id="div_tag_id_multi" class="span5">
                    <? echo $this->Form->input('tag_id', array('id' => 'tag_id_multi', 'label'=>'Marcadores', 'options'=>$tags, 'multiple' => 'multiple'));?>
                </div>
                <div class="span5" style="margin-top: 24px">
                    <a href='#' modal_target='gerencia_tags' class="btn btn-small" url='<?= $this->Html->url(array('controller' => 'tags', 'action' => 'gerencia', $obm_id)) ?>' title="Gerenciar Marcadores"><i class='icon-cogs'></i>Gerenciar Marcadores</a>
                </div>
                <br><br><br><br>
                <?php if(!empty($militares)){?>
                    <div class="btn-group">
                        <? echo $ajax->submit('Marcar selecionados', array('url' => array('controller' => 'militares_tags', 'action' => 'addMultiplos', $obm_id), 'before'=>'$(this).attr("value", "Marcando...")', 'update' => 'militares_lotados', 'class' => 'btn btn-small btn-success')); ?>
                    </div>
                    <div class="btn-group">
                        <?php echo $this->element('modal/padrao', array('id' => 'campos_pesquisa', 'titulo' => 'Campos a serem adicionados ao arquivo')); ?>
                        <a href='#' class="btn btn-small btn-success" id="gerarXls" url='<?= $this->Html->url(array('controller' => 'militares', 'action' => 'gerarXls')) ?>' title='Campos a serem adicionados ao arquivo'><i class='icon-table'></i> Gerar Excel (.xls)</a>
                    </div>
                <? } ?>
                <div class="btn-group">
                    <button id="filtrar_marcadores" class="btn btn-small btn-info" type="button">Filtrar</button>
                </div>
                <br>
                <br>
            </div>
        </div>
        
<?php if(!empty($militares)){?>
        <div class="checkbox">
            <input type="checkbox" id="checkTodos" class="check_tag">
            <label id="labelTodos" for="checkTodos">Selecionar Todos</label>
        </div>
    <?php foreach($militares as $m){?>    
        <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h5 class="smaller">
                        <input type="checkbox" name="data[MilitaresTag][militar_id][<? echo $m['ViewMilitar']['id']?>]" class="check_tag" style="margin-right: 10px; margin-bottom: 2%">
                        <?php echo $m['ViewMilitar']['cargo_nome'].' Mat. '.$m['ViewMilitar']['num_matricula']; ?>
                    </h5>
                    <div style="text-align: right">
                        <a modal_target='add_individual' class="btn btn-minier btn-success" url='<?= $this->Html->url(array('controller' => 'militares_tags', 'action' => 'addIndividual', $m['ViewMilitar']['id'])) ?>' title="Adicionar Marcadores para <? echo $m['ViewMilitar']['cargo_nome']?>">&nbsp;<i class='icon-plus'></i></a>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="row-fluid">
                        <div class="span2">
                            <img width="70" src="<?php echo $this->Html->url(array("controller" => "militares", "action" => "foto", $m['ViewMilitar']['id'])); ?>">
                        </div>
                        <div class="span5">
                            <p><b>Função:</b> <?php echo $m['ViewMilitar']['dsc_funcao']; ?></p>
                            <p><b>Status:</b> <?php echo $m['ViewMilitar']['dsc_status']; ?></p>
                            <p><b>Situação:</b> <?php echo $m['ViewMilitar']['dsc_situacao']; ?></p>
                            <p><b>Saúde:</b> <?php $status_apto = Configure::read('Saude.apto'); if($status_apto == $m['ViewMilitar']['status_saude_id']){echo '<span class="label label-success">Apto</span>';}else{echo '<span class="label label-important">Baixado</span>';} ?></p>
                        </div>
                        <div class="span5">
                            <div>
                                <p>
                                    <b>Marcadores:</b>
                                    <br>
                                    <?
                                    foreach($m['Tags'] as $tag){
                                        $tag = $tag['ViewMilitaresTag'];
                                    ?>
                                        <span class="badge badge-success">
                                            <? echo $tag['descricao'];?> 
                                            <i id='<? echo $tag['id'].'_'.$tag['militar_id']?>' militar_tag_id = '<? echo $tag['id']?>' class="icon-remove remove_tag" style="cursor: pointer"></i>
                                        </span>
                                    <?
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>  
                </div>
        </div>
    <?php } ?> 
    <? echo $this->Form->end();?>
<?php }else{
        echo '<span class="label label-inverse">Nada encontrado!</span>'; 
        
} ?>

<?php echo $this->element('modal/padrao', array('id' => 'add_individual', 'titulo' => 'Adicionar Marcadores', 'styleBody' => "height: 250px;")); ?>
<?php echo $this->element('modal/padrao', array('id' => 'gerencia_tags', 'titulo' => 'Gerência de Marcadores')); ?>