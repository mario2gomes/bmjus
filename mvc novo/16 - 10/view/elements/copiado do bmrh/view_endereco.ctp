<script>
    $(document).ready(function(){
        militar_id = $('#militar_id').val();
        
        // evento para editar enderecos do militar
        $('#editar_endereco').click(function(){
            var id = $('#endereco_id').val();
            var url = '<?php echo $this->Html->url(array('controller' => 'enderecos', 'action' => 'edit')); ?>' +'/'+ id;
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                success: function(data){
                    $('#enderecos').html(data);
                }
            });
        });
        
        // evento para adicionar enderecos do militar
        $('#adicionar_endereco').click(function(){
            var url = '<?php echo $this->Html->url(array('controller' => 'enderecos', 'action' => 'add')); ?>' +'/'+ militar_id;
            $.ajax({
                url: url,
                type: 'POST',                
                cache: false,                
                success: function(data){
                    $('#enderecos').html(data);
                }
            });
        });
    });
</script>
<div class="row-fluid">
    <? if ($endereco['id']) { ?>
        <p>
            <button id = "editar_endereco" class="btn btn-small btn-success">Editar</button>
        </p>
        <hr>
        <input id ="endereco_id" type="hidden" value="<?= $endereco['id'] ?>">
            <div class="row">
                <div class="span4">
                    <dl class="dl-horizontal">
                        <dt>Logardouro, nº</dt>
                        <dd>
                            <?php echo $endereco['dsc_endereco']; ?>
                            &nbsp;
                        </dd>
                        <dt>Bairro</dt>
                        <dd>
                            <?php echo $endereco['Bairro']['dsc_bairro']; ?>
                            &nbsp;
                        </dd>
                        <dt>Cidade</dt>
                        <dd>
                            <?php echo $endereco['Cidade']['dsc_cidade']; ?>
                            &nbsp;
                        </dd>
                        <dt>UF</dt>
                        <dd>
                            <?php echo $endereco['Uf']['descricao']; ?>
                            &nbsp;
                        </dd>
                    </dl>
                </div>
                <div class="span4">
                    <dl class="dl-horizontal">
                        <dt>Cep</dt>
                        <dd>
                            <?php echo $endereco['num_cep']; ?>
                            &nbsp;
                        </dd>
                        <dt>Complemento</dt>
                        <dd>
                            <?php echo $endereco['ptr_endereco']; ?>
                            &nbsp;
                        </dd>
                        <dt>Tipo de residência</dt>
                        <dd>
                            <?php 
                            if(isset($endereco['dsc_tip_residencia'])){
                                echo $endereco['dsc_tip_residencia']; 
                            }       
                            ?>
                            &nbsp;
                        </dd>
                        <dt>Tipo de propriedade</dt>
                        <dd>
                            <?php 
                            if(isset($endereco['dsc_tip_propriedade'])){
                                echo $endereco['dsc_tip_propriedade']; 
                            }       
                            ?>
                            &nbsp;
                        </dd>
                    </dl>
                </div>
            </div>
            </dl>
    <? } else { ?>
        <p>
            <button id = "adicionar_endereco" class="btn btn-small btn-success">Adicionar</button>
        </p>
        <hr>
    <? } ?>
</div>