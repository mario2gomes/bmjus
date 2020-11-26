<?php echo $this->element('modal/processos/novo'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Relação de processos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>Processos</a>
                        </li>
                        <li class="active">
                            <strong>lista</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Processos</h5>
                            <?php //Apenas autoridade instauradora e corregdoria podem abrir um processo;                            
                                if ($usuario_atual['grupo'] == 4 || $usuario_atual['grupo'] == 2){ ?>
                                    <div class="ibox-tools">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#novo">Novo processo</button>
                                    </div>
                            <?php } ?>
                        </div>
                        <div class="ibox-content">    
                            <div class="project-list">
                                <!--dataTables-example: tabela dinâmica moldável javascript-->
                                <table class="table table-hover table-mail table-striped dataTables-example">
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable(0)" >Processo</th>
                                            <th onclick="sortTable(1)" >Aut inst</th>
                                            <th onclick="sortTable(2)" >Encarregado</th>
                                            <th>Resumo</th>
                                            <th onclick="sortTable(3)" >Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($processos as $processo){
                                    $numero = $processo['Processo']['num_processo'] ;
                                    //O usuário visualiza apenas os processos com os quais está envolvido
                                    //usuário adm ou corregedoria visualiza todos
                                        if( $usuario_atual['grupo'] != 1 && 
                                            $usuario_atual['grupo'] != 2 &&
                                            //($usuario_atual['obm'] != $processo['Processo']['obm'] || $usuario_atual['grupo'] != 4) &&

                                            //(($usuario_atual['grupo'] == 3 && $processo['Processo']['encarregado']!=$usuario_atual['cpf']) ||
                                            //($usuario_atual['grupo'] == 4  && $processo['Processo']['instaurador'] != $usuario_atual['cpf']) ||
                                            //($usuario_atual['grupo'] == 5 && $processo['Processo']['investigado'] != $usuario_atual['cpf']))

                                            $processo['Processo']['encarregado']!=$usuario_atual['cpf'] &&
                                            $processo['Processo']['escrivao']!=$usuario_atual['cpf'] &&
                                            $processo['Processo']['instaurador'] != $usuario_atual['cpf'] &&
                                            $processo['Processo']['investigado'] != $usuario_atual['cpf'] &&
                                            $usuario_atual['funcao_id'] != 1260
                                        ){ continue; } 
                                        ?>                        
                                    <tr
                                        <?php if($processo['Processo']['situacoes_id'] == 2){ ?>
                                    style="background-color:#FFEAEA"
                                        <?php } ?> >
                                        <td class="project-title">
                                            <?php echo $this->Html->link($processo['Tipo_processo']['descricao']." ".$numero, array('controller' => 'processos', 'action' => 'detalhe',$processo['Processo']['id'])); ?>
                                            <br/>
                                            <small>Aberto em: <?php echo $this-> Formatacao ->data($processo['Processo']['data_bgo']);?></small>
                                        <td>
                                            <?php echo $processo['Processo']['instaurador']; ?>
                                        </td>
                                        <td>
                                            </a>
                                            <?php echo $processo['Processo']['encarregado'];?>
                                        </td>
                                        <td>
                                            <div>
                                                <?php                   
                                                if($processo['Processo']['resumo']) {
                                                    ?>
                                                        <a rel='popover' title='Resumo' data-content='tt'><?php echo substr($processo['Processo']['resumo'],0,20); ?></a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <?php
                                            switch ($processo['Estado']['id']) {
                                                case 1:
                                                    $label = 'label-primary';
                                                    break;
                                                case 2:
                                                    $label = 'label-danger';
                                                    break;
                                                case 3:
                                                    $label = 'label-warning';
                                                    break;
                                                case 4:
                                                    $label = 'label-info';
                                                    break;
                                                case 5:
                                                    $label = 'label-success';
                                                    break;
                                            }
                                        ?>
                                        <td class="project-status">
                                            <span class="label <?php echo $label?>"><?php echo $processo['Estado']['descricao']?></span>
                                        <br>
                                        <?php
                                        switch ($processo['Processo']['estados_id']) {
                                            case 1:
                                                echo 'Previsão de término: ', $this -> Formatacao -> data ($processo['Processo']['previsao_termino']);?>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?php echo $this -> Prazos-> progresso($processo['Processo']['data_bgo'], $processo['Processo']['prazo']) ?>;" class="progress-bar"></div>
                                                </div>
                                                <?php //echo 'Prazo para entrega do relatório: ', $this -> Prazos-> data_termino($processo['Processo']['data_bgo'], $processo['Relatorio']['prazo']); ?>
                                                <!-- <div class="progress progress-mini">
                                                    <div style="width: <?php //echo $this -> Prazos-> progresso($processo['Processo']['data_bgo'], $processo['Relatorio']['prazo']) ?>;" class="progress-bar"></div>
                                                </div>  -->
                                            <?php
                                                break;
                                            case 2:
                                                echo 'Processo suspenso';
                                                break;
                                            case 3:
                                                echo $this -> Formatacao -> data($processo['Processo']['previsao_termino']);?>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?php echo $this -> Prazos-> progresso($processo['Processo']['data_bgo'], $processo['Processo']['prazo'] +10) ?>;" class="progress-bar"></div>
                                                </div>
                                            <?php
                                                break;
                                            case 4:
                                                echo 'Processo concluído em: ', $processo['Relatorio']['entrega'];
                                                echo '<br /> Aguardando análise';
                                                break;
                                            case 5:
                                                echo 'Processo arquivado';
                                                break;
                                            } ?>
                                        </td>
                                    </tr>
                                <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>