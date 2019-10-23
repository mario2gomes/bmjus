<div class="averbacao index">
    <? //pr($averbacoes); //die(); ?>   
    <div class="span6">
        <div class="span3">
            <button class="btn btn-small btn-success" data-toggle="modal" href="#add_averbacao">    
                <i class="icon-plus"></i> Registrar Averbação
            </button> 
        </div>
        <div class="span3">
            <a href="#" modal_target="add_resumo_tempo" url="<? echo $this->Html->url(array('controller' => 'tempo_averbados', 'action' => 'resumo_tempo', $militar['Militar']['id'])); ?>"><button class="btn btn-small btn-success"><i class="icon-signal"></i> Ver Resumo</button></a>                                                        
        </div>
    </div>
    <br><br> 
    <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>                                         
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Referência</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Nº BGO</th>                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Publicado em</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Tipo Contagem</th>                                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Motivação</th>
					<th class="actions">Ações</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($averbacoes as $averbacao): ?>
                    <tr>			
                        <td><? echo $referencia[$averbacao['dsc_referencia']]; ?>&nbsp;</td>                    
                        <td><? echo $averbacao['num_bol'] . ' (' . $averbacao['dsc_boletim'] . ')'; ?>&nbsp;</td>			
                        <td><? echo $this->Formatacao->data($averbacao['dat_bol']); ?>&nbsp;</td>
                        <td><? echo $tipo_contagem[$averbacao['tip_contagem']]; ?></td>                        
                        <td>                            
                            <span class="btn btn-success btn-small tooltip-success" data-rel="tooltip" data-placement="top" title="" 
                                  data-original-title="
                                  <?
                                  echo 'Histórico: ' . $averbacao['dsc_historico'] . '<br>';
                                  if (!empty($averbacao['dat_inicial']) and !empty($averbacao['dat_final'])) {
                                      echo 'Data de admissão: ' . $this->Formatacao->data($averbacao['dat_inicial']) . '<br>';
                                      echo 'Data de exoneração: ' . $this->Formatacao->data($averbacao['dat_final']);
                                  }
                                  ?>"> Ler
                            </span>
                        </td>
						<td><a href='#' url='<?=$this->Html->url(array('controller' => 'tempo_averbados','action' => 'excluir', $averbacao['id'], $averbacao['militar_id']))?>' class='acoes excluir_tempo_averbado' title='Excluir Tempo Averbado'><i class='icon-trash'></i></a></td>                        						
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>             
    </div>   
</div>  

<?php echo $this->Html->script('bootbox.min'); ?>
<script>
    $(document).ready(function() {
        $('.excluir_tempo_averbado').click(function() {
            var url = $(this).attr('url');
            bootbox.confirm('Deseja realmente excluir o Tempo Averbado?', function(confirm) {
                if (confirm) {
                    document.location.href = url;
                }
            });
        });
    });
</script>       