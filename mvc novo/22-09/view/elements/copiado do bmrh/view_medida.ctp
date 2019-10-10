<script>
    $(document).ready(function(){
        militar_id = $('#militar_id').val();
        
        // evento para editar medidas de uniforme do militar
        $('#editar_medida').click(function(){
            var id = $('#medida_id').val();
            var url = '<?php echo $this->Html->url(array('controller' => 'medidas', 'action' => 'edit')); ?>' +'/'+ id;
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                success: function(data){
                    $('#medidas').html(data);
                }
            });
        });
        
        // evento para adicionar medidas de uniforme do militar
        $('#adicionar_medida').click(function(){
            var url = '<?php echo $this->Html->url(array('controller' => 'medidas', 'action' => 'add')); ?>' +'/'+ militar_id;
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                success: function(data){
                    $('#medidas').html(data);
                }
            });
        });
    });
</script>
<div class="row-fluid">
    <? if ($medida['id']) { ?>
        <p>
            <button id = "editar_medida" class="btn btn-small btn-success">Editar</button>
        </p>
        <hr>
        <input id ="medida_id" type="hidden" value="<?= $medida['id'] ?>">
        <!--<input id ="militar_id" type="hidden" value="<?= $medida['militar_id'] ?>">-->
        <dl class="dl-horizontal">
            <dt><?php __('Cabeça'); ?></dt>
            <dd>
                <?php echo $medida['num_cabeca']; ?>
                &nbsp;
            </dd>
            <dt><?php __('Gandola / Japona'); ?></dt>
            <dd>
                <?php echo $medida['tam_gandola']; ?>
                &nbsp;
            </dd>
            <dt><?php __('Calça'); ?></dt>
            <dd>
                <?php echo $medida['tam_calca']; ?>
                &nbsp;
            </dd>
            <dt><?php __('Camisa'); ?></dt>
            <dd>
                <?php echo $medida['tam_camisa']; ?>
                &nbsp;
            </dd>
            <dt><?php __('Calção'); ?></dt>
            <dd>
                <?php echo $medida['tam_calcao']; ?>
                &nbsp;
            </dd>
            <dt><?php __('Calçado'); ?></dt>
            <dd>
                <?php echo $medida['tam_calcado']; ?>
                &nbsp;
            </dd>
        </dl>
    <? } else { ?>
        <p>
            <button id = "adicionar_medida" class="btn btn-small btn-success">Adicionar</button>
        </p>
        <hr>
    <? } ?>
</div>