<!-- Tabela utilizada no controller funcoes -->
<table id="table_funcoes" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Função</th>
            <th>Cargo</th>
            <th>Quadro</th>                    
            <th>BGO</th>
            <th>DOE</th>
            <th>Evento</th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($historico as $funcao): ?>
            <tr>
                <td><? echo $funcao['Funcao']['dsc_funcao']; ?>&nbsp;</td>
                <td><? echo $funcao['Funcao']['Cargo']['sig_cargo']; ?></td>	
                <td><? echo $funcao['Funcao']['Quadro']['sig_quadro']; ?></td>                                        
                <td>
                    <?
                    if (!empty($funcao['num_bgo']) && !empty($funcao['dat_bgo'])) {
                        echo "{$funcao['num_bgo']} de {$this->Formatacao->data($funcao['dat_bgo'])}";
                    }
                    ?>
                </td>
                <td>
                    <?
                    if (!empty($funcao['num_doe']) && !empty($funcao['dat_doe'])) {
                        echo "{$funcao['num_doe']} de {$this->Formatacao->data($funcao['dat_doe'])}";
                    }
                    ?>
                </td>
                <td>
                    <?
                    $evento = 'Exoneração';
                    if ($funcao['tipo_evento'] == 'C') {
                        $evento = 'Classificação';
                    }
                    echo $evento;
                    ?>
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>