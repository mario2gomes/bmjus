<style>
    .acoes{
        margin-right: 10px;
    }
</style>

<?
$concedida = Configure::read('ferias_concedida');
$emGozo = Configure::read('ferias_em_gozo');
$suspensa = Configure::read('ferias_suspensa');
$gozada = Configure::read('ferias_gozada');
?>

<div class="ferias index">
    <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Status</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data Concessão</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">BGO de Concessão</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data Início</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Ano Referência</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Militar Resp.</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Obs.</th>                  
                    <th class="actions">Ações</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($ferias as $feria) { ?>
                    <?
                    $links = array();
                    $links['detalhe'] = "<a href='#' modal_target='detalhe_ferias' url='{$this->Html->url(array('controller' => 'ferias', 'action' => 'detalhe', $feria['id']))}' title='Detalhes Férias'><i class='icon-table'></i></a>&nbsp&nbsp";
                    $links['suspender'] = "<a href='#' modal_target='suspender_ferias' url='{$this->Html->url(array('controller' => 'ferias', 'action' => 'suspender', $feria['id']))}' class='acoes' title='Suspender Férias'><i class='icon-ban-circle'></i></a>";
                    $links['reconceder'] = "<a href='#' modal_target='reconceder_ferias' url='{$this->Html->url(array('controller' => 'ferias', 'action' => 'reconceder', $feria['id']))}' class='acoes' title='Reconceder Férias'><i class='icon-refresh'></i></a>";
                    $links['retornar'] = "<a href='#' modal_target='retorno_ferias' url='{$this->Html->url(array('controller' => 'ferias', 'action' => 'retornar', $feria['id'], $feria['militar_id']))}' class='acoes' title='Retorno de Férias'><i class='icon-check'></i></a>";
                    $links['alterar_inicio'] = "<a href='#' modal_target='alterar_inicio_ferias' url='{$this->Html->url(array('controller' => 'ferias', 'action' => 'alterarInicio', $feria['id']))}' class='acoes' title='Alterar data de início'><i class='icon-edit'></i></a>";
                    $links['excluir'] = "<a href='#' url='{$this->Html->url(array('controller' => 'ferias', 'action' => 'excluir', $feria['id']))}' class='acoes excluir_ferias' title='Excluir Férias'><i class='icon-trash'></i></a>";

                    $actions = array();
                    $actions[] = $links['detalhe'];

                    if ($feria['ferias_status_id'] == $concedida) {
                        $actions[] = $links['suspender'];
                        $actions[] = $links['alterar_inicio'];
                        $actions[] = $links['excluir'];
                    }

                    if ($feria['ferias_status_id'] == $emGozo) {
                        $actions[] = $links['suspender'];
                        $actions[] = $links['retornar'];
                        $actions[] = $links['excluir'];
                    }

                    if ($feria['ferias_status_id'] == $suspensa) {
                        $actions[] = $links['reconceder'];
                    }
                    ?>
                    <tr>			
                        <td><? echo $feria['FeriasStatus']['dsc_status']; ?>&nbsp;</td>                    
                        <td>
                            <?
                            if (!empty($feria['dat_bgo'])) {
                                echo $this->Formatacao->data($feria['dat_bgo']);
                            }
                            ?>
                        </td>			
                        <td><? echo $feria['num_bgo']; ?>&nbsp;</td>                    
                        <td>
                            <?
                            if (!empty($feria['dat_inicio'])) {
                                echo $this->Formatacao->data($feria['dat_inicio']);
                            }
                            ?>
                        </td>			
                        <td><? echo $feria['ano_ref']; ?>&nbsp;</td>                    
                        <td><? echo $viewMilitar->getCargoNome($feria['militar_resp_id']); ?>&nbsp;</td>                    
                        <td class="actions">                                                                                
                            <a href="#" modal_target="anotacaoes" url="<? echo $this->Html->url(array('controller' => 'ferias', 'action' => 'anotacao_ferias', $feria['id'])); ?>"> <button class="btn btn-mini btn-success"><i class="icon-tag"></i> Anotações</button> </a>                                                                                    
                        </td>                                      
                        <td class="actions">
                            <? echo implode('|&nbsp;&nbsp;', $actions); ?>
                            &nbsp;
                        </td>
                    </tr>
                <? } ?>
            </tbody>
        </table>     

    </div>   
</div>
<?php echo $this->Html->script('bootbox.min'); ?>
<script>
    $(document).ready(function() {
        $('.excluir_ferias').click(function() {
            var url = $(this).attr('url');
            bootbox.confirm('Deseja realmente excluir as férias?', function(confirm) {
                if (confirm) {
                    document.location.href = url;
                }
            });
        });
    });
</script>