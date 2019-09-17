<div class="agregacao index">
    <button class="btn btn-small btn-success" data-toggle="modal" href="#agregacao">    
    <i class="icon-plus"></i>Nova Agregação
    </button><br><br> 
    <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>                                         
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data de Agregação</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">BGO(Data)</th>                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data de Retorno</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">BGO de Retorno(Data)</th>                                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Militar Resp.</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Observação</th>
                    <th class="actions">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?foreach ($agregacoes as $agregacao):?>
		<tr>			
			<td><? echo $this->Formatacao->data($agregacao['dat_inicio']); ?>&nbsp;</td>                    
			<td><? echo $agregacao['num_bgo_inicio']." (".$this->Formatacao->data($agregacao['dat_bgo_inicio']).")"; ?>&nbsp;</td>			
			<td><? if (!empty($agregacao['dat_retorno'])){ echo $this->Formatacao->data($agregacao['dat_retorno']); } ?>&nbsp;</td>
			<td><? echo $agregacao['num_bgo_retorno']." (".$this->Formatacao->data($agregacao['dat_bgo_retorno']).")"; ?>&nbsp;</td>                        
			<td><? echo $viewMilitar->getCargoNome($agregacao['militar_resp_id']); ?>&nbsp;</td>			
                        <td><? echo $agregacao['dsc_observacao']; ?>&nbsp;</td>
			<td class="actions">
                            <? if(empty($agregacao['dat_retorno'])){?>
                            <a href="#" modal_target="edit_agregacao" url="<? echo $this->Html->url(array('controller' => 'agregacoes', 'action' => 'edit', $agregacao['id'])); ?>"> <button class="btn btn-mini btn-success">Reverter</button> </a>                            
                            <?}?>
			</td>
		</tr>
		<? endforeach; ?>
            </tbody>
        </table>     
        
    </div>   
</div>