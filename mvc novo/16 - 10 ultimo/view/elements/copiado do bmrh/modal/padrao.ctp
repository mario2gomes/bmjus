<div id="<? echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3><? echo $titulo; ?></h3>
    </div>
    <div class="modal-body">        
        <? if(!empty($elemento)){ 
            echo $this->element($elemento);
        }?>
    </div>
    <div class="modal-footer">
        <?php if(isset($print)){ //Se for setado a impressão da lista no modal, gera o botão p carregar a lista ?>
            <? $id_btn = $id.'_print'; echo $ajax->link('Gerar lista', array('controller'=>'militares', 'action'=>'gerarXls'), array('id' => $id_btn, 'update' => $id.' > .modal-body', 'before'=>'$(this).html("Carregando...");', 'complete'=>"$('#$id_btn').remove();", 'class' => 'btn btn-success', 'title' => 'Gerar lista')); ?>
        <?php } ?>
		<a class="btn" data-dismiss="modal" aria-hidden="true">Fechar</a>  
    </div>
</div>