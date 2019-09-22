<script>
    $(document).ready(function(){
        // evento para editar militares do militar
        $('#editar_militar').click(function(){
            var id = $('#militar_id').val();
            var url = '<?php echo $this->Html->url(array('controller' => 'militares', 'action' => 'edit')); ?>' +'/'+ id;
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                success: function(data){
                    $('#informacoes').html(data);
                }
            });
        });
    });
</script>
<div class="row-fluid">
    <? if ($militar['Militar']['id']) { ?>
		<div class="span5">
            <div class="span2">
                <p>
                    <button id = "editar_militar" class="btn btn-small btn-success">Editar</button>
                </p>
            </div>
            <? if ($militar['Militar']['status_id'] == Configure::read('status_ativo') || $militar['Militar']['status_id'] == Configure::read('status_reserva_remunerada')){ ?>
            <div class="span3">
                <a href="#" modal_target="add_reserva" url="<? echo $this->Html->url(array('controller' => 'militares', 'action' => 'inativar', $militar['Militar']['id'])); ?>"><button class="btn btn-small btn-success">Alterar Status</button></a>                                                        
                <!--<button class="btn btn-small btn-success" data-toggle="modal" href="#add_reserva">Colocar na Reserva</button>-->
            </div>
            <?}?>
        </div>
        <hr>
        <input id ="militar_id" type="hidden" value="<?= $militar['Militar']['id'] ?>">
            <div class="row">
                <div class="span5">
                    <dl class="dl-horizontal">
                        <dt>Sexo</dt>
                        <dd>
                            <?if($militar['Militar']['cod_sexo'] == 'M'){
                                echo 'MASCULINO';
                            }elseif ($militar['Militar']['cod_sexo'] == 'F') {
                                echo 'FEMININO';
                            }
                            ?>
                            &nbsp;
                        </dd>
                        <dt>Data de nascimento</dt>
                        <dd>
                            <? if ($militar['Militar']['dat_nasc']) { ?>
                                <?php echo $this->Formatacao->data($militar['Militar']['dat_nasc']); ?>
                            <? } ?>                            
                            &nbsp;
                        </dd>
                        <dt>Tipo sanguíneo</dt>
                        <dd>
                            <?php echo $militar['Militar']['tip_sangue']; ?>
                            &nbsp;
                        </dd>
                        <dt>Naturalidade</dt>
                        <dd>
                            <?php echo $militar['Militar']['dsc_naturalidade']; ?>
                            <?if(!empty($militar['Militar']['dsc_naturalidade_uf'])){
                                echo " / {$ufs[$militar['Militar']['dsc_naturalidade_uf']]}";
                            }
                            ?>
                            &nbsp;
                        </dd>
                        <dt>Nome pai</dt>
                        <dd>
                            <?php echo $militar['Militar']['nom_pai']; ?>
                            &nbsp;
                        </dd>
                        <dt>Nome mãe</dt>
                        <dd>
                            <?php echo $militar['Militar']['nom_mae']; ?>
                            &nbsp;
                        </dd>
                        <dt>Estado civil</dt>
                        <dd>
                            <?php echo $militar['EstadoCivil']['dsc']; ?>
                            &nbsp;
                        </dd>
                        <dt>Cônjuge</dt>
                        <dd>
                            <?php echo $militar['Militar']['nom_conjuge']; ?>
                            &nbsp;
                        </dd>
                        <dt>Data de admissão</dt>
                        <dd>
                            <? if ($militar['Militar']['dat_admissao']) { ?>
                                <?php echo $this->Formatacao->data($militar['Militar']['dat_admissao']); ?>
                            <? } ?>                            
                            &nbsp;
                        </dd>
                    </dl>
                </div>
                <div class="span5">
                    <dl class="dl-horizontal">
                        <dt>Número DOE</dt>
                        <dd>
                            <?php echo $militar['Militar']['num_doe']; ?>
                            &nbsp;
                        </dd>
                        <dt>Posição hierárquica</dt>
                        <dd>
                            <?php echo $militar['Militar']['pos_hierarquica']; ?>
                            &nbsp;
                        </dd>
                        <dt>Escolaridade</dt>
                        <dd>
                            <?php echo $militar['Escolaridade']['dsc_escolaridade']; ?>
                            &nbsp;
                        </dd>
                        <dt>Religião</dt>
                        <dd>
                            <?php echo $militar['Religiao']['dsc_religiao']; ?>
                            &nbsp;
                        </dd>
                        <dt>Altura</dt>
                        <dd>
                            <? if(!empty($militar['Militar']['num_altura'])){
                                echo "{$militar['Militar']['num_altura']} cm";
                            }
                            ?>
                            &nbsp;
                        </dd>
                        <dt>Sinal particular</dt>
                        <dd>
                            <?php echo $militar['Militar']['dsc_sinal_part']; ?>
                            &nbsp;
                        </dd>
                        <dt>Doador</dt>
                        <dd>
                            <?if($militar['Militar']['cod_doador'] == 'S'){
                                echo 'SIM';
                            }elseif ($militar['Militar']['cod_doador'] == 'N') {
                                echo 'NÃO';
                            }
                            ?>
                            &nbsp;
                        </dd>
                        <dt>Telefone 1</dt>
                        <dd>
                            <?php echo $militar['Militar']['num_telefone']; ?>
                            &nbsp;
                        </dd>
                        <dt>Telefone 2</dt>
                        <dd>
                            <?php echo $militar['Militar']['num_telefone2']; ?>
                            &nbsp;
                        </dd>
                    </dl>
                </div>
            </div>
            </dl>
    <? } ?>
</div>