<div id="modal_foto" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Editar foto</h3>
    </div>        
    <div class="modal-body-medium">
        <div class="foto form">    
            <div class="widget-box">                    
                <img id="foto_edit" width="200" src="<?php echo $this->Html->url(array("controller" => "militares", "action" => "foto", $militar_id)); ?>" style="cursor: pointer">
                <br>
                <br>
                <br>
                <? echo $this->Form->create('Militar', array('url' => array('controller' => 'militares', 'action' => 'editarFoto'), 'type' => 'file')); ?>
                <? echo $this->Form->input('id', array('type' => 'hidden', 'value' => $militar_id));?>
                <? echo $this->Form->input('blb_foto', array('label' => 'Adicionar / Alterar Foto (PNG ou JPG)', 'type' => 'file'));?>
                <hr>
                <? echo $this->Form->end(array('type' => 'submit', 'class' => 'btn btn-success')); ?>
                <br>
            </div>
        </div>
    </div>
</div>