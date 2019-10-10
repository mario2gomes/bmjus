<div class="dependentes index">
    <button class="btn btn-small btn-success" data-toggle="modal" href="#dependente">    
    <i class="icon-plus"></i>Novo Dependente
    </button><br><br> 
    <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Nome</th> 
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Parentesco</th>                                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data de Nascimento</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">BGO de Inclusão</th>                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Data de Inclusão</th>                  
                    <th class="actions">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?foreach ($dependentes as $dependente):?>
				<? if(isset($dependente['Dependente'])){$dependente = $dependente['Dependente'];} ?>
		<tr>			
			<td><? echo $dependente['nom_dependente']; ?>&nbsp;</td>                    
			<td><? echo $parentesco[$dependente['cod_parentesco']]; ?>&nbsp;</td>			
			<td><? echo $this->Formatacao->data($dependente['dat_nasc']); ?>&nbsp;</td>
			<td><? echo $dependente['bgo_inclusao']; ?>&nbsp;</td>                        
			<td><? echo $this->Formatacao->data($dependente['dat_inclusao']); ?>&nbsp;</td>			
			<td class="actions">
                            <a href="#" modal_target="edit_dependente" url="<? echo $this->Html->url(array('controller' => 'dependentes', 'action' => 'edit', $dependente['id'])); ?>"> <? echo $this->Html->image('edit.png', array('title'=>'Editar')); ?> </a>                            
							<a href='#' url='<?= $this->Html->url(array('controller' => 'dependentes', 'action' => 'excluir', $dependente['id'])) ?>' class='excluir_dependente' title='Excluir Dependente'><? echo $this->Html->image('delete.png', array('title' => 'Excluir')); ?></a>
			</td>
		</tr>
		<? endforeach; ?>
            </tbody>
        </table>     
        
    </div>   
</div>


<?php echo $this->Html->script('bootbox.min'); ?>
<script>
    $(document).ready(function () {
        $('.excluir_dependente').click(function () {
            var url = $(this).attr('url');
            bootbox.confirm('Deseja realmente excluir o Dependente?', function (confirm) {
                if (confirm) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        cache: false,
                        success: function (data) {
                            $('#dependentes').html(data);
                        }
                    });
                }
            });
        });
    });
</script>

