<!-- Modal -->
<?php
echo $this->Html->css(array('autocomplete/token-input-facebook2'));
echo $this->Html->script(array('jquery.tokeninput.min'));
?>

<div class="modal fade" id="novo_instaurador" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Designar autoridade</h3>
                        <?php
                        echo $this->Form->create('Usuario', ['url' => ['action' => 'novo_instaurador']]);
                        echo $this->Form->input('cpf', array('class' => 'form-control', 'div' => 'form-group','id' => 'instaurador'));
                        echo $this-> Form->end(array('label'=>'Designar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        <?php echo $this->element('js/token_input', array('id' => 'instaurador', "config" => array("tokenLimit"=>1,'url' => array("controller" => "usuarios", "action" => "busca",1, "plugin" => false, 'admin' => false)))); ?>
    });
</script>