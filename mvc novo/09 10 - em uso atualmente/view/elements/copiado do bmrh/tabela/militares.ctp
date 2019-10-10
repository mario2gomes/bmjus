
<!-- Tabela utilizada para a pesquisa de militares -->
<? if (isset($militares) && !empty($militares)) { ?>
    <?php echo $this->element('modal/padrao', array('id' => 'campos_pesquisa', 'titulo' => 'Campos a serem adicionados ao arquivo')); ?>
    <br>
    <a href='#' modal_target='campos_pesquisa' class="btn btn-small btn-success" url='<?= $this->Html->url(array('controller' => 'militares', 'action' => 'gerarXls')) ?>' title='Campos a serem adicionados ao arquivo'><i class='icon-table'></i> Gerar Excel (.xls)</a>
    <br>
    <br>

    <div class="militares index">      
        <h3 class="header smaller lighter blue">Lista de Militares</h3>

        <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">       
            <table id="table_militares" filtro="true" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Matrícula</th>
						<th>Pos. Hierárquica</th>
                        <th>Militar</th>
                        <th>Lotação</th>
						<th>Função</th>
                        <th>Quadro</th>                    
                        <th>Situação</th>
                        <th>Status</th>
						<th>Status Saúde</th>
                        <th class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($militares as $militar): ?>
                        <? $militar = $militar['ViewMilitar']; ?>
                        <tr>
                            <td><? echo $militar['num_matricula']; ?></td>
							<td><? echo $militar['pos_hierarquica']; ?></td>
                            <td>
                                <div data-rel="tooltip" data-placement="top" title="" data-original-title="<? echo $militar['nom_completo']; ?>"> <? echo $militar['cargo_nome']; ?></div>
                            </td>	
                            <td><? echo $militar['dsc_obm']; ?></td>                                        
                            <td><? echo $militar['dsc_funcao_cargo']; ?></td>                                        
							<td><? echo $militar['sig_quadro']; ?></td>                                        
							<td><? echo $militar['dsc_situacao']; ?></td>                                      
                            <td><? echo $militar['dsc_status']; ?></td>  
							<td><? if(Configure::read('Saude.apto') == $militar['status_saude_id']){echo '<span class="label label-success">Apto</span>';}else{echo '<span class="label label-important">Baixado</span>';} ?></td>
                            <td class="actions">
                                <a href="<?php echo $this->Html->url(array("controller" => "militares", "action" => "view", $militar['id'])); ?>"><span class="label label-success"><i class="icon-search"></i> Ver </span></a>
                            </td>
                        </tr>
                    <? endforeach; ?> 
                </tbody>
            </table>             
        </div> 
    </div>
<? }else { ?>
    <br>
    Nenhum registro encontrado.    
<?}?>