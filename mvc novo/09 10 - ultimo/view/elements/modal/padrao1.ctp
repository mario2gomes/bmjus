<?php
$options_default = array(
    'id' => 'modal_' . round(rand(1, 10000000)),
    'tamanho' => 'modal-lg', // modal-md, modal-sm
    'titulo' => '',
    'subtitulo' => '',
    'rodape' => '',
    'elemento' => ''
);

$opt = $options_default;
if (isset($options)) {$opt = array_merge($options_default, $options);}
?>

<div class="modal inmodal fade in" id="<? echo $opt['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog <? echo $opt['tamanho']; ?>">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title"><? echo $opt['titulo']; ?>&nbsp;</h5>
                <small class="font-bold"><? echo $opt['subtitulo']; ?></small>
            </div>
            <div id="<? echo $opt['id']; ?>_body" class="modal-body" style="max-height: 750px; overflow-y: auto;">
                <?
                if (!empty($opt['elemento'])) {
                    echo $this->element($opt['elemento']);
                }
                ?>
            </div>

            <div class="modal-footer">
                &nbsp;
                <? echo $opt['rodape']; ?>
                <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>