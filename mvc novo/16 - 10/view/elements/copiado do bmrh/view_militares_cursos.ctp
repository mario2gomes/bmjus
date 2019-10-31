<div class="punicao index">
    <? //pr($militar_id); exit(); ?>
    <a href='#' modal_target='add_curso_militar' class="btn btn-small btn-success" 
       url='<?= $this->Html->url(array('controller' => 'militares_cursos', 'action' => 'add', $militar_id))?>' 
       title='Novo Curso'><i class='icon-plus'></i> Novo Curso</a> 
    <br><br> 
    <div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>                                         
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Cuso</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Nível</th>                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Publicação de Conclusão</th>                  
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Período</th>                                      
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Média Final</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Conceito</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Carga Horária</th>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Ações</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($militaresCursos as $militarCurso): ?>
                    <tr>			
                        <td><? echo $militarCurso['CursosMilitar']['dsc_sigla']; ?>&nbsp;</td>                    
                        <td><? echo $militarCurso['CursosMilitar']['Niveis']['dsc_nivel']; ?>&nbsp;</td>			
                        <td><? echo $militarCurso['tipo_bol'].' nº '.$militarCurso['num_bol'].' de '.$this->Formatacao->data($militarCurso['data_bol']) ?>&nbsp;</td>
                        <td><? echo $this->Formatacao->data($militarCurso['dat_inicio']).' à '.$this->Formatacao->data($militarCurso['dat_termino']); ?></td>
                        <td><? echo $militarCurso['med_final']; ?></td>
                        <td><? echo $militarCurso['dsc_conceito']; ?></td>
                        <td><? echo $militarCurso['CursosMilitar']['carga_horaria']; ?></td>
                        <td class="actions">                            
                            <? echo "<a href='#' modal_target='detalhes_curso' url='{$this->Html->url(array('controller' => 'militares_cursos', 'action' => 'detalhes', $militarCurso['CursosMilitar']['id']))}' title='Detalhe do Curso'><i class='icon-table'></i></a>"; ?>
                        </td>			
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>             
    </div>   
</div>   