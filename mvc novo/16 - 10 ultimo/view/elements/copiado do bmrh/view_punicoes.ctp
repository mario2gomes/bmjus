<div class="punicao index">
    <? //pr($punicoes); die(); ?>    
    <button class="btn btn-small btn-success" data-toggle="modal" href="#add_punicao">    
        <i class="icon-plus"></i> Registrar Punição
    </button> 
    <br><br> 
    <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>                                         
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Tipo Punição</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Qtd dias</th>                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data Publicado</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Nº BGO</th>                                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Motivação</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Ação</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($punicoes as $punicao): ?>
                    <? if(!empty($punicao['militar_canc_id'])){ //Se algum militar registrou o cacelamento... ?>
                        <tr>			
                            <td><? echo 'Cancelada BGO nº '.$punicao['num_bol_alt'].' de '.$this->Formatacao->data($punicao['dat_bol_alt']); ?>&nbsp;</td>                    
                            <td> -------------- </td>			
                            <td> -------------- </td>
                            <td> -------------- </td>                        
                            <td>
                                --------------
                            </td>			                        
                            <td class="actions">                            
                                
                            </td>			
                        </tr>
                    <? } else{ //Se não houver cancelamento cadastrado... ?>
                        <tr>			
                            <td><? echo $tipo_punicao[$punicao['tipo_id']]; ?>&nbsp;</td>                    
                            <td><? echo $punicao['qtd_dias']; ?>&nbsp;</td>			
                            <td><? echo $this->Formatacao->data($punicao['dat_bol']); ?>&nbsp;</td>
                            <td><? echo $punicao['num_bol']; ?>&nbsp;</td>                        
                            <td>
                                <span class="btn btn-success btn-small tooltip-success" data-rel="tooltip" data-placement="top" title="" 
                                data-original-title="<? echo $punicao['dsc_punicao']; ?>"> Ler </span>                            
                            </td>			                        
                            <td class="actions">                            
                                <a href="#" modal_target="canc_punicao" url="<? echo $this->Html->url(array('controller' => 'punicoes', 'action' => 'cancelar', $punicao['id'])); ?>"> <button class="btn btn-mini btn-success">Cancelar Punição</button> </a>                                                        
                            </td>			
                        </tr>
                    <? } ?>
                <? endforeach; ?>
            </tbody>
        </table>             
    </div>   
</div>   