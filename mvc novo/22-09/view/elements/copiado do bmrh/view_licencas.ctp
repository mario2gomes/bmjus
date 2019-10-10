<style>
    .acoes{
        margin-right: 10px;
    }
</style>

<?
$concedida = Configure::read('licenca_concedida');
$emGozo = Configure::read('licenca_em_gozo');
$suspensa = Configure::read('licenca_suspensa');
$gozada = Configure::read('licenca_gozada');
?>

<div class="licenca index">
    <? //pr($licencas); //die(); ?> 

    <a href='#' modal_target='add_licenca' class="btn btn-small btn-success" url='<?= $this->Html->url(array('controller' => 'licencas', 'action' => 'add', $militar_id))?>' title='Conceder Licença'><i class='icon-plus'></i> Conceder Licença</a>
<!--    <button class="btn btn-small btn-success" modal_target='add_licenca'>    
        <i class="icon-plus"></i> Conceder Licença
    </button> -->
    <br><br> 
    <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>                                         
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Tipo</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Nº BGO (Data)</th>                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Status</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Militar Resp.</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Observações</th>                                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Ações</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($licencas as $lic): ?>
                <?
                    $links = array();
                    $links['detalhe'] = "<a href='#' modal_target='detalhe_licenca' url='{$this->Html->url(array('controller' => 'licencas', 'action' => 'detalhe', $lic['id']))}' title='Detalhes Licença'><i class='icon-table'></i></a>";
                    $links['suspender'] = "<a href='#' modal_target='suspender_licenca' url='{$this->Html->url(array('controller' => 'licencas', 'action' => 'suspender', $lic['id']))}' class='acoes' title='Suspender Licença'><i class='icon-ban-circle'></i></a>";
                    $links['reconceder'] = "<a href='#' modal_target='reconceder_licenca' url='{$this->Html->url(array('controller' => 'licencas', 'action' => 'reconceder', $lic['id']))}' class='acoes' title='Reconceder Licença'><i class='icon-refresh'></i></a>";
                    $links['alterar_inicio'] = "<a href='#' modal_target='alterar_inicio_licenca' url='{$this->Html->url(array('controller' => 'licencas', 'action' => 'alterarInicio', $lic['id']))}' class='acoes' title='Alterar data de início'><i class='icon-edit'></i></a>";
                    $links['retornar'] = "<a href='#' modal_target='retorno_licenca' url='{$this->Html->url(array('controller' => 'licencas', 'action' => 'retornar', $lic['id'], $lic['militar_id']))}' class='acoes' title='Retorno de Licenca'><i class='icon-check'></i></a>";

                    $actions = array();
                    $actions[] = $links['detalhe'];

                    if($lic['licenca_status_id'] == $concedida){
                        $actions[] = $links['suspender'];
                        $actions[] = $links['alterar_inicio'];
                    }
                    
                    if($lic['licenca_status_id'] == $emGozo){
                        $actions[] = $links['suspender'];
                        $actions[] = $links['retornar'];
                    }
                    
                    if($lic['licenca_status_id'] == $suspensa){
                        $actions[] = $links['reconceder'];
                    }
                    
                    $dataBgo = '';
                        if(!empty($lic['dat_bgo'])){
                            $dataBgo = $this->Formatacao->data($lic['dat_bgo']);
                        }
                ?>
                    <tr>			
                        <td><? echo $lic['TiposLicenca']['dsc_tipo']  ?>&nbsp;</td>                    
                        <td><? echo "{$lic['num_bgo']} ($dataBgo)" ?>&nbsp;</td>                    
                        <td><? echo $lic['LicencaStatus']['dsc_status']  ?>&nbsp;</td>                    
                        <td><? echo $viewMilitar->getCargoNome($lic['militar_resp_id']); ?>&nbsp;</td> 
                        <td><? echo $lic['dsc_observacao']  ?>&nbsp;</td>                    
                        <td class="actions">
                            <?echo implode(' | ', $actions);?>
			</td>                        
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>             
    </div>   
</div>         