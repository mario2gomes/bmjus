<div class="promocoes index">
    <? //pr($averbacoes); //die(); ?>    
    <a class="btn btn-small btn-success" modal_target="add_promocao" url="<?php echo $this->Html->url(array('controller' => 'promocoes', 'action' => 'add', $militar_id)); ?>">    
        <i class="icon-plus"></i> Registrar Promo��o
    </a> 
    <br><br> 
    <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
         <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>                                         
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Promo��o a</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Crit�rio</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">N� do Processo</th>                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data da promo��o(a contar)</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Publica��o em BGO</th>                                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Publica��o em DOE</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($promocoes as $p): ?>
                    <tr>			
                        <td><? echo $cargos[$p['cargo_id']]; ?>&nbsp;</td>
                        <td><? echo $criterio_promocao[$p['dsc_criterio']]; ?>&nbsp;</td>                    
                        <td><? echo $p['cod_processo']; ?>&nbsp;</td>			
                        <td><? echo $this->Formatacao->data($p['dat_promocao']); ?>&nbsp;</td>
                        <td><? if(!empty($p['dat_boletim'])){echo $p['num_boletim'].' de '.$this->Formatacao->data($p['dat_boletim']);} ?>&nbsp;</td>
                        <td><? if(!empty($p['dat_diario'])){echo $p['num_diario'].' de '.$this->Formatacao->data($p['dat_diario']);} ?>&nbsp;</td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table> 
    </div>   
</div>     