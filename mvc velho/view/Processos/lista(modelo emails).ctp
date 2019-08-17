<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-content mailbox-content">
            <div class="mail-box-header">

                <ol class="breadcrumb">
                    <li>
                        <a href=#>Processos</a>
                    </li>
                    <li class="active">
                        <strong>lista</strong>
                    </li>
                </ol>

                <h2>Lista de processos</h2>

                <!-- Button trigger modal -->
                <?php echo $this->element('modal/novo') ?>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#novo">Novo processo</button>
                
                <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#novo">Filtrar</button>
                </div>
            </div>

            <div class="mail-box">
                <table class="table table-hover table-mail table-striped">
                    <tbody>
                        <tr class="unread">
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Nº Processo: activate to sort column ascending" style="width: 156px;">Nº</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Instaurador: activate to sort column ascending" style="width: 156px;">Instaurador</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Procedimento: activate to sort column ascending" style="width: 156px;">Procedimento</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Investigado: activate to sort column ascending" style="width: 156px;">Investigado</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Encarregado: activate to sort column ascending" style="width: 156px;">Encarregado</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Escrivão: activate to sort column ascending" style="width: 156px;">Escrivão</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Publicação: activate to sort column descending" style="width: 114px;">Publicação</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Estado: activate to sort column ascending" style="width: 156px;">Estado</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Situação: activate to sort column ascending" style="width: 156px;">Situação</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Posse: activate to sort column ascending" style="width: 156px;">Posse</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Término estimado: activate to sort column ascending" style="width: 156px;">Término estimado</th>
                        </tr>
                        <?php foreach ($processos as $processo){
                            $numero = $processo['Processo']['num_processo'] ;
                            if( $grupos != 1 && 
                                $grupos != 2 &&
                                (($grupos == 3 && $processo['Processo']['encarregado']!=$usuarios) ||
                                ($grupos == 4  && $processo['Processo']['instaurador'] != $usuarios) ||
                                ($grupos == 5 && $processo['Processo']['investigado'] != $usuarios))
                            ){
                                continue; } ?>

                        <tr class="gradeA even" role="row">
                        
                            <td><?php echo $this->Html->link($numero, array('controller' => 'processos', 'action' => 'detalhe', $processo['Processo']['id'])); ?></td>
                            <td><?php echo $processo['Processo']['instaurador']; ?></td>
                            <td><?php echo $processo['Tipo_processo']['descricao']; ?></td>
                            <td><?php echo $processo['Processo']['investigado']; ?></td>
                            <td><?php echo $processo['Processo']['encarregado']; ?></td>
                            <td><?php echo $processo['Processo']['escrivao']; ?></td>
                            <td class="sorting_1"><?php echo $this->Formatacao->data($processo['Processo']['data_bgo']); ?></td>
                            <td><span class="label label-info pull-right"><?php echo $processo['Estado']['descricao']; ?></span></td>
                            <td><span class="label label-warning pull-right"><?php echo $processo['Situacao']['descricao']; ?></span></td>
                            <td><?php echo $processo['Processo']['posse']; ?></td>
                            <td><?php echo $this->Formatacao->data($processo['Processo']['previsao_termino']); ?></td>
                        </tr>
                    <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>