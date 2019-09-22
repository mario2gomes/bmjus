<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Relação de processos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Processos</a>
                        </li>
                        <li class="active">
                            <strong>lista</strong>
                        </li>
                    </ol>

                    <?php 

$ano = 2019;
$feriados = $this -> Prazos-> dias_feriados($ano);
foreach( $feriados as $a){
echo date("d-M-Y",$a).'<br>';                        
}
pr( $feriados);
?>

                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Meus processos</h5>
                            <div class="ibox-tools">
                                <!-- Button trigger modal -->
                                <?php echo $this->element('modal/novo') ?>
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#novo">Novo processo</button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-primary btn-sm" ><i class="fa fa-refresh"></i> Atualizar</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group"><input type="text" placeholder="número do processo" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Pesquisa </button> </span></div>
                                </div>
                            </div>

                            <div class="project-list">
                                <table class="table table-hover table-mail table-striped">
                                    <tbody>
                                    <?php 

                                    foreach ($processos as $processo){
                                    $numero = $processo['Processo']['num_processo'] ;
                                        if( $grupos != 1 && 
                                            $grupos != 2 &&
                                            (($grupos == 3 && $processo['Processo']['encarregado']!=$usuarios) ||
                                            ($grupos == 4  && $processo['Processo']['instaurador'] != $usuarios) ||
                                            ($grupos == 5 && $processo['Processo']['investigado'] != $usuarios))
                                        ){ continue; } ?>                        
                                    <tr class='unread'>
                                        <?php 
                                            switch ($processo['Situacao']['id']) {
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
                                            <span class="label <?php echo $label?>"><?php echo $processo['Situacao']['descricao']?></span>
                                        </td>
                                        <td class="project-title">
                                            <a><?php echo $processo['Tipo_processo']['descricao'], ' ', $this->Html->link($numero, array('controller' => 'processos', 'action' => 'detalhe', $processo['Processo']['id'])); ?></a>
                                            <br/>
                                            <small>Aberto em: <?php echo $this->Formatacao->data($processo['Processo']['data_bgo']);?></small>
                                        </td>
                                        <td class="project-completion">
                                        <?php
                                        switch ($processo['Processo']['estados_id']) {
                                            case 1:
                                                echo 'Previsão de término: ', $this -> Prazos-> data_termino($processo['Processo']['data_bgo'], $processo['Relatorio']['prazo'] +10) -> format("d/m/Y");?>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?php echo $this -> Prazos-> progresso($processo['Processo']['data_bgo'], $processo['Relatorio']['prazo'] +10) ?>;" class="progress-bar"></div>
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
                                                echo 'Previsão de término: ', $this -> Prazos-> data_termino($processo['Processo']['data_bgo'], $processo['Processo']['prazo'] +10);;?>
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
                                        <td class="project-people">
                                            Em posse do <?php echo $grupos[$processo['Processo']['posse_id']];?>
                                            <img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
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
        

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <script>
        $(document).ready(function(){

            $('#loading-example-btn').click(function () {
                btn = $(this);
                simpleLoad(btn, true)

                // Ajax example
//                $.ajax().always(function () {
//                    simpleLoad($(this), false)
//                });

                simpleLoad(btn, false)
            });
        });

        function simpleLoad(btn, state) {
            if (state) {
                btn.children().addClass('fa-spin');
                btn.contents().last().replaceWith(" Loading");
            } else {
                setTimeout(function () {
                    btn.children().removeClass('fa-spin');
                    btn.contents().last().replaceWith(" Refresh");
                }, 2000);
            }
        }
    </script>