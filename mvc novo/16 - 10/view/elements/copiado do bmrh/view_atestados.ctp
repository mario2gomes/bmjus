<div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
    <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
        <thead>
            <tr>                                         
				<th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Situação</th>
                <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Médico</th>
                <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data atestado</th>                      
                <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data consulta</th>                  
                <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Dias dispensa</th>                  
            </tr>
        </thead>
        <tbody>
            <? foreach ($atestados as $atest): ?>
                <?
                $dataAtestado = '';
                if (!empty($atest['data_atestado'])) {
                    $dataAtestado = $this->Formatacao->data($atest['data_atestado']);
                }
                $dataConsulta = '';
                if (!empty($atest['data_consulta'])) {
                    $dataConsulta = $this->Formatacao->data($atest['data_consulta']);
                }
				$conduta = '';
				if (!empty($atest['conduta'])) {
                    $conduta = ' ('.$atest['conduta'].')';
                }
                ?>
                <tr>			
					<td>
						<? echo $atest['status'].$conduta ?>&nbsp;
						<?if(!empty($atest['observacao'])){?>
							<span class="popover-notitle" data-rel="popover" data-placement="right" data-content="<?=$atest['observacao']?>" data-original-title="" title=""> <i class='icon-comment'></i></span>
						<?}?>
					</td>                    
                    <td><? echo $viewMilitar->getCargoNome($atest['mat_militar']); ?>&nbsp;</td>                    
                    <td><? echo $dataAtestado ?>&nbsp;</td>                    
                    <td><? echo $dataConsulta ?>&nbsp;</td>                    
                    <td><? echo $atest['dias_dispensa'] ?>&nbsp;</td>                    
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>             
</div>   