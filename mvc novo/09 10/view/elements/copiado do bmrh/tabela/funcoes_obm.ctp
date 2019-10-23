<!-- Tabela utilizada no controller funcoes -->
<table id="table_funcoes" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Fun��o</th>
            <th>Cargo</th>
            <th>Quadro</th>                    
            <th>Claro</th>
            <th>Qtd</th>
            <!-- Por padr�o a coluna de a��es � exibida, caso seja setado false em actions n�o exibe esta coluna -->
            <?php if($actions){?>
                <th class="actions">A��es</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <? foreach ($funcoes as $funcao):?>
        <tr>
            <td><? echo $funcao['Funcao']['dsc_funcao']; ?>&nbsp;</td>
            <td><? echo $funcao['Cargo']['sig_cargo']; ?></td>	
            <td><? echo $funcao['Quadro']['sig_quadro']; ?></td>                                        
            <td>
                <? if($funcao['Funcao']['claro']>0){$sit = 'success';}else{$sit = 'important';} echo "<span class='label label-$sit'>".$funcao['Funcao']['claro']."</span>"; ?>&nbsp;
            </td>
            <td><? echo $funcao['Funcao']['num_vagas']; ?>&nbsp;</td>
            <!-- Por padr�o a coluna de a��es � exibida, caso seja setado false em actions n�o exibe esta coluna -->
            <?php if($actions){?>
                <td class="actions">
                   <a title="Exibir militares classificados" modal_target="modal_detalhe" url="<?php echo $this->Html->url(array('controller'=>'funcoes', 'action'=>'classificados', $funcao['Funcao']['id'])); ?>"> <i class="icon-group"></i> </a>  
                   <? if($funcao['Funcao']['claro']>0){?><!-- Se n�o houver vagas n�o exibe o bot�o para classificar -->
                       | <a title="Classificar militares" modal_target="modal_classificar" url="<?php echo $this->Html->url(array('controller'=>'funcoes', 'action'=>'classificar', $funcao['Funcao']['id'])); ?>"> <i class="icon-plus"></i></a>
                   <?php } ?>
                </td>
            <?php } ?>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>