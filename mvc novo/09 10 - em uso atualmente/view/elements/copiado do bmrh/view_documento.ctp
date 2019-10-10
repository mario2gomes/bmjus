<script>
    $(document).ready(function(){
        militar_id = $('#militar_id').val();
        
        // evento para editar documentos do militar
        $('#editar_documento').click(function(){
            var id = $('#documento_id').val();
            var url = '<?php echo $this->Html->url(array('controller' => 'documentos', 'action' => 'edit')); ?>' +'/'+ id;
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                success: function(data){
                    $('#documentos').html(data);
                }
            });
        });
        
        // evento para adicionar documentos do militar
        $('#adicionar_documento').click(function(){
            var url = '<?php echo $this->Html->url(array('controller' => 'documentos', 'action' => 'add')); ?>' +'/'+ militar_id;
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                success: function(data){
                    $('#documentos').html(data);
                }
            });
        });
    });
</script>
<div class="row-fluid">
    <p>
        <a href='<?= $this->Html->url(array('controller' => 'militares', 'action' => 'gerarRgbm', $documento['militar_id']))?>'
            class="btn btn-small btn-info"
            title='Imprimir RGBM'>
            Imprimir RGBM
        </a>
    </p>
    <? if ($documento['id']) { ?>
        <p>
            <button id = "editar_documento" class="btn btn-small btn-success">Editar</button>
        </p>
        <hr>
        <input id ="documento_id" type="hidden" value="<?= $documento['id'] ?>">
                    <div class="row">
                        <div class="span4">
                            <dl class="dl-horizontal">
                                <dt>CPF</dt>
                                <dd>
                                    <? $cpf = '';
                                        if($documento['num_cpf']){
                                            $cpf = $documento['num_cpf'];
                                            $cpf = $this->Formatacao->cpfCnpj($cpf);
                                        }
                                    ?>
                                    <?php echo $cpf; ?>
                                    &nbsp;
                                </dd>
                                <dt>PIS/PASEP</dt>
                                <dd>
                                    <? $pis = '';
                                        if($documento['num_pis_pasep']){
                                            $pis = $documento['num_pis_pasep'];
                                            $pis = substr($pis, 0, 3).'.'.substr($pis, 3, 5).'.'.substr($pis, 8, 2).'-'.substr($pis, 10, 1);
                                        }
                                    ?>
                                    <?php echo $pis; ?>
                                    &nbsp;
                                </dd>
                            </dl>
                        </div>
                        <div class="span4">
                            <dl class="dl-horizontal">
                                <dt>RG</dt>
                                <dd>
                                    <?php echo $documento['num_rg']; ?>
                                    &nbsp;
                                </dd>
                                <dt>Órgão expedidor</dt>
                                <dd>
                                    <?php echo $documento['org_exp_rg']; ?>
                                    &nbsp;
                                </dd>
                                <dt>UF RG</dt>
                                <dd>
                                    <?php echo $ufs[$documento['uf_exp_rg']]; ?>
                                    &nbsp;
                                </dd>
                                <dt>Data de expedição RG</dt>
                                <dd>
                                    <?if($documento['dat_exp_rg']){?>
                                        <?php echo $this->Formatacao->data($documento['dat_exp_rg']); ?>
                                    <?}?>
                                    &nbsp;
                                </dd>
                            </dl>
                        </div>
                        <div class="span4">
                            <dl class="dl-horizontal">
                                <dt>Título</dt>
                                <dd>
                                    <?php echo $documento['num_titulo']; ?>
                                    &nbsp;
                                </dd>
                                <dt>Zona</dt>
                                <dd>
                                    <?php echo $documento['num_zona']; ?>
                                    &nbsp;
                                </dd>
                                <dt>Seção</dt>
                                <dd>
                                    <?php echo $documento['num_secao']; ?>
                                    &nbsp;
                                </dd>
                                <dt>UF Título</dt>
                                <dd>
                                    <?php echo $ufs[$documento['uf_titulo']]; ?>
                                    &nbsp;
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span4">
                            <dl class="dl-horizontal">
                                <dt>CNH</dt>
                                <dd>
                                    <?php echo $documento['num_cnh']; ?>
                                    &nbsp;
                                </dd>
                                <dt>Categoria</dt>
                                <dd>
                                    <?php echo $documento['cat_cnh']; ?>
                                    &nbsp;
                                </dd>
                                <dt>UF CNH</dt>
                                <dd>
                                    <?php echo $ufs[$documento['uf_cnh']]; ?>
                                    &nbsp;
                                </dd>
                                <dt>Data de validade</dt>
                                <dd>
                                    <?if($documento['dat_val_cnh']){?>
                                        <?php echo $this->Formatacao->data($documento['dat_val_cnh']); ?>
                                    <?}?>
                                    &nbsp;
                                </dd>
                            </dl>
                        </div>
                        <div class="span4">
                            <dl class="dl-horizontal">
                                <dt>Reservista</dt>
                                <dd>
                                    <?php echo $documento['num_reservista']; ?>
                                    &nbsp;
                                </dd>
                                <dt>CSM</dt>
                                <dd>
                                    <?php echo $documento['cod_csm']; ?>
                                    &nbsp;
                                </dd>
                                <dt>Categoria</dt>
                                <dd>
                                    <?php echo $documento['cod_categoria']; ?>
                                    &nbsp;
                                </dd>
                                <dt>Tipo</dt>
                                <dd>
                                    <?php echo $documento['cod_tipo']; ?>
                                    &nbsp;
                                </dd>
                            </dl>
                        </div>
                        <div class="span4">
                            <dl class="dl-horizontal">
                                <dt>RGBM</dt>
                                <dd>
                                    <?php echo $rgbm['num_rgbm']; ?>
                                    &nbsp;
                                </dd>
                                <dt>Data Expedição</dt>
                                <dd>
                                    <?if($rgbm['dat_expedicao']){?>
                                        <?php echo $this->Formatacao->data($rgbm['dat_expedicao']); ?>
                                    <?}?>
                                    &nbsp;
                                </dd>
                                <dt>Válido Até</dt>
                                <dd>
                                    <?if($rgbm['dat_validade']){?>
                                        <?php echo $this->Formatacao->data($rgbm['dat_validade']); ?>
                                    <?}?>
                                    &nbsp;
                                </dd>
                                <dt>Ficha Dactiloscópica</dt>
                                <dd>
                                    <?php echo $rgbm['fic_dact']; ?>
                                    &nbsp;
                                </dd>
                            </dl>
                        </div>
                    </div>
    <? } else { ?>
        <p>
            <button id = "adicionar_documento" class="btn btn-small btn-success">Adicionar</button>
        </p>
        <hr>
    <? } ?>
</div>