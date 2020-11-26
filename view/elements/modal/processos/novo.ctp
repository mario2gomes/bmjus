<!-- Modal -->
<?php
echo $this->Html->css(array('autocomplete/token-input-facebook2'));
echo $this->Html->script(array('jquery.tokeninput.min'));
?>

<div class="modal fade" id="novo" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">NOVO PROCESSO</h3>

                        <p>Preencha os dados do novo processo</p>

                        <div class="widget-box"> 

                            <?php echo $this->Form->create('Processo', ['url' => ['action' => 'novo']]); 
                                 echo $this->Form->input('tipo_processos_id',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "procedimento", 'label'=>'Procedimento','options' => $tipos, 'empty' => '--Selecione--') ); ?>
                                 <strong> <?php echo 'Portaria de instaura��o'.'</br>'.'(publica��o)' ?> </strong>
                                 <?php echo $this->Form->date('data_bgo',array('label'=>'Data do BGO de abertura', 'class' => 'form-control', 'div' => 'form-group','dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));
                                 //echo $this->Form->input('num_processo',array('label'=>'N�mero do processo', 'upper' => 'true', 'class' => 'form-control', 'div' => 'form-group'));
                                ?>
                                <div class="checkbox" id="igual_processo">
                                    <label><input type="checkbox" data-id="port">N�mero da portaria igual ao do processo</label>
                                </div>
                                <div id="port"> 
                                    <?php 
                                    echo $this->Form->input('num_portaria',array('label'=>'Portaria de instaura��o'.'</br>'.'(n�mero)', 'class' => 'form-control', 'div' => 'form-group'));
                                    ?>
                                </div>
                                <?php
                                 //echo $this->Form->input('num_portaria',array('label'=>'Portaria de instaura��o'.'</br>'.'(n�mero)', 'class' => 'form-control', 'div' => 'form-group'));
                                 echo $this->Form->input('num_bgo',array('label'=>'N�mero do BGO', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "N�mero do BGO"));
                                 if ($usuario_atual['grupo'] == 2){
                                    echo $this->Form->input('instaurador',array('label' =>'Autoridade Instauradora', 'class' => 'form-control', 'div' => 'form-group', 'id' => 'instaurador'));
                                 }else{
                                    echo $this->Form->input('instaurador',array('value'=> $usuario_atual['cpf'],'type' => 'hidden'));
                                 }
                                 echo $this->Form->input('encarregado', array('class' => 'form-control', 'div' => 'form-group','id' => 'encarregado'));
                                 echo $this->Form->input('investigado', array('class' => 'form-control', 'div' => 'form-group','id' => 'investigado'));
                                 //echo $this->TwitterBootstrap->input('militar_id', array('label' => 'Militar(es)', 'id' => 'busca_militar', 'type' => 'text'));
                                 //echo $this->Form->input('encarregado',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Usar o token input e exibir as op��es dentro dos militares da obm e pela fila",'options' => $nomes, 'empty' => 'Usar o token input --Selecione--'));
                                 //echo $this->Form->input('investigado',array('class' => 'form-control', 'div' => 'form-group','options' => $nomes, 'empty' => 'Usar o token input --Selecione--'));
                                 //echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver) (matricula)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "usar autocompletar com os militares da unidade", 'label'=>'Escriv�o'));
                                 echo $this->Form->input('resumo',array('type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "descri��o", 'label'=>'Resumo'));
                                 echo $this->Form->input('criador_processo_id', array('value' => $usuario_atual['cpf'], 'type'=> 'hidden'));
                                 echo $this->Form->end(array('label'=>'Salvar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        <?php echo $this->element('js/token_input', array('id' => 'instaurador', "config" => array("tokenLimit"=>1,'url' => array("controller" => "usuarios", "action" => "busca",1, "plugin" => false, 'admin' => false)))); ?>
        <?php echo $this->element('js/token_input', array('id' => 'encarregado', "config" => array("tokenLimit"=>1,'url' => array("controller" => "usuarios", "action" => "busca",1, "plugin" => false, 'admin' => false)))); ?>
        <?php echo $this->element('js/token_input', array('id' => 'investigado', "config" => array("tokenLimit"=>1,'url' => array("controller" => "usuarios", "action" => "busca",0, "plugin" => false, 'admin' => false)))); ?>
    });

    $(document).ready(function () {
        $("#igual_processo input[type=checkbox]").change(function () {
            $("#port").css("display", "none");
        })
    });
</script>

<?php
echo $this->element('modal/documentos/enviar');
?>