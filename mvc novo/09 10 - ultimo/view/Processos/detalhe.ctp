<?php   
    if( $grupos != 1 && $grupos != 2 && (
            ($grupos == 3 && $processo['Processo']['encarregado']!=$usuarios) ||
            ($grupos == 4  && $processo['Processo']['instaurador'] != $usuarios) ||
            ($grupos == 5 && $processo['Processo']['escrivao'] != $usuarios) ||
            ($grupos == 6 && $processo['Processo']['investigado'] != $usuarios))){
        echo 'Você não tem permissão de acessar esse processo!';
    } else{
        echo $this->element('modal/tramitar');
        echo $this->element('modal/prorrogar');
        echo $this->element('modal/suspender');
        echo $this->element('modal/reabrir');
        echo $this->element('modal/editar');
        echo $this->element('modal/enviar_documento');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Detalhes do projeto</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Projeto</a>
            </li>
            <li class="active">
                <strong>detalhe</strong>
            </li>
        </ol>
    </div>
</div>
        <div class="row">
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <a href="#" class="btn btn-white btn-xs pull-right">Editar</a>
                                        <h2><?php echo $processo['Tipo_processo']['descricao'], ' ', $processo['Processo']['num_processo']; ?></h2>
                                    </div>
                                    <dl class="dl-horizontal">
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
                                        <dt>Situação: </dt> <dd><span class="label <?php echo $label ?>"><?php echo $processo['Situacao']['descricao']; ?></span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Portaria:</dt> <dd><?php echo $processo['Processo']['num_portaria']; ?></dd>
                                        <dt>Data de abertura: </dt> <dd> <?php echo $this->Formatacao->data($processo['Processo']['data_bgo']); ?></dd>
                                        <?php 
                                        if ($processo['Processo']['situacoes_id']==5){
                                            echo ' ';
                                        }else{ ?>
                                            <dt>Previsão de término:</dt><dd class="project-completion"> <?php
                                            if ($processo['Processo']['estados_id'] == 2){
                                                echo 'Indefinido';
                                            }else{
                                                echo $this -> Formatacao -> data ($processo['Processo']['previsao_termino']);
                                             }; ?>
                                            </dd>
                                            <dt>Estado:</dt> <dd><?php echo $processo['Estado']['descricao']; }; ?></dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >
                                        <dt>Incluído por:</dt> <dd>Militar que inseriu o processo</dd>
                                        <dt>Em posse de:</dt> <dd><?php echo $funcoes[$processo['Processo']['posse_id']]; ?></dd>
                                        <dt>Aut. instauradora:</dt> <dd><?php echo $processo['Processo']['instaurador']; ?></dd>
                                        <dt>Encarregado:</dt> <dd> <?php echo $processo['Processo']['encarregado']; ?> </dd>
                                        <dt>Escrivão:</dt> <dd> <?php echo $processo['Processo']['escrivao']; ?> </dd>
                                        <dt>Investigado:</dt> <dd> <?php echo $processo['Processo']['investigado']; ?> </dd>
                                    </dl>
                                </div>
                            </div>
                            <?php 
                                if ($processo['Processo']['situacoes_id']==5){
                                            echo ' ';
                                        }else{ ?>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <dl class="dl-horizontal">
                                                        <dt>Progresso estimado:</dt>
                                                        <dd>
                                                            <div class="progress progress-striped active m-b-sm">
                                                                <div style="width: <?php echo $this -> Prazos-> progresso($processo['Processo']['data_bgo'], $processo['Processo']['prazo']); ?>" class="progress-bar"></div>
                                                            </div>
                                                            <?php
                                                            $resto = $this -> Prazos -> resto($processo['Processo']['data_bgo'], $processo['Processo']['prazo']);
                                                            if ($processo['Processo']['estados_id'] == 2){
                                                                echo 'Processo suspenso';
                                                            }else{
                                                                if ($resto > 0) { ?>
                                                                    <small><strong><?php echo $this -> Prazos-> progresso($processo['Processo']['data_bgo'], $processo['Processo']['prazo']); ?></strong>
                                                                <?php 
                                                                    echo $resto, 'dias para conclusao.';
                                                                }else{
                                                                    echo 'Processo ', -$resto, ' dias atrasado';
                                                                };  
                                                            }; ?> </small>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        <?php }; ?>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                    <div class="panel blank-panel">
                                        <div class="panel-heading">
                                            <div class="panel-options">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab-1" data-toggle="tab">Tramitação</a></li>
                                                    <li class=""><a href="#tab-2" data-toggle="tab">Autos do processo</a></li>
                                                    <li class=""><a href="#tab-3" data-toggle="tab">Processo digitalizado</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    <div class="panel-body">
                                    <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1">

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="hidden-phone"><i class="icon-time hidden-phone"></i>Tramitado em:</th>
                                            <th class="hidden-480">Origem</th>
                                            <th class="hidden-480">Destino</th>
                                            <th class="hidden-480">Despacho</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($tramitacoes as $tramitacao){ ?>
                                        <tr>
                                        <?php 
                                        if ($tramitacao['Tramitacao']['processos_id'] === $processo['Processo']['id']){ ?>
                                            <td class="hidden-480"><?php echo $this->Formatacao->data($tramitacao['Tramitacao']['created']); ?></td>
                                            <td class="hidden-480"><?php echo $funcoes[$tramitacao['Tramitacao']['funcao_entrega_id']]; ?></td>
                                            <td class="hidden-480"><?php echo $funcoes[$tramitacao['Tramitacao']['funcao_recebe_id']]; ?></td>
                                            <td class="hidden-phone"><?php echo $tramitacao['Tramitacao']['usuario_tramita_id'], ': ',$tramitacao['Tramitacao']['despacho']; ?></td>
                                        <?php }; ?>
                                        </tr>
                                        <?php 
                                        }; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-2">
                                    <div class="feed-activity-list">
                                        <?php 
                                        foreach ($documentos as $documento){
                                            if ($documento['Documento']['processo_id'] == $processo['Processo']['id']){
                                        ?>
                                        <div class="feed-element">
                                            <div href="#" class="pull-left">
                                                <?php echo $this->Html->link('Visualizar', array('controller' => 'processos', 'action' => 'abrir_documento', $processo['Tipo_processo']['descricao'], $processo['Processo']['num_processo'] , $documento['Documento']['nome_arquivo']),array('type'=>'button','class'=>'btn btn-primary')); ?>
                                            </div>
                                            <div class="media-body ">
                                                <small class="pull-right"><?php echo $documento['Documento']['created']; ?></small>
                                                <strong><?php echo $documento['Tipo_documento']['descricao']; ?></strong>
                                                , enviado por: <strong><?php echo $documento['Documento']['usuario_envia_id']; ?></strong><br>
                                                <a> <?php echo $documento['Documento']['nome_arquivo']; ?></a><br>
                                                <small class="text-muted"><?php echo $documento['Documento']['created']; ?></small>
                                                    <?php 
                                                    if ($documento['Documento']['observacao']){ ?>
                                                        <div class="well">
                                                            <?php echo substr($documento['Documento']['observacao'],0,100); ?>
                                                        </div>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-3">
                                    <div class="feed-activity-list">
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/a3.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-right">2h ago</small>
                                                <strong>Janet Rosowski</strong> add 1 photo on <strong>Monica Smith</strong>. <br>
                                                <small class="text-muted">2 days ago at 8:30am</small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                </div>

                                </div>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <h3>Descrição do processo: </h3>
                    <img src="img/zender_logo.png" class="img-responsive">
                    <p>
                        <?php echo $processo['Processo']['descricao']; ?>
                    </p>
                    <?php
                        if( $grupos == 1 || $grupos == 2 || $grupos == $processo['Processo']['posse_id']){
                    ?>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tramitar">Tramitar</button>
                    </div>
                    <?php }; 

                        if( $grupos == 1 || $grupos == 2){
                            if ($processo['Processo']['estados_id'] != 2 && $processo['Processo']['prorrogacoes'] < 2){
                    ?>
                    <div class="text-center m-t-md">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#prorrogar">Prorrogar</button>
                    </div>
                <?php } ?>
                    <div class="text-center m-t-md">
                        <?php if ($processo['Processo']['estados_id'] == 2){ ?>
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#reabrir">Reabrir</button>
                        <?php } else{ ?>
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#suspender">Suspender</button>
                        <?php }; ?>
                    </div>
                    <div class="text-center m-t-md">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editar">Editar</button>
                    </div>
                    <?php }; ?>
                    
                    <div class="text-center m-t-md">
                        <button type="button" class="btn btn-s btn-primary" data-toggle="modal" data-target="#enviar_documento">Adicionar documento</button>
                    </div>

                    <h3>Histórico:</h3>
                    <ul class="list-unstyled project-files">
                        <li class='well'>
                            <?php
                            for ($i=0; $i <count($processo['Prorrogacao']); $i++) { 
                                if($processo['Prorrogacao'][$i]){
                                    echo 'Foi <b>prorrogado</b> em: ', $this->Formatacao->data($processo['Prorrogacao'][$i]['data_inicio']), '<br> por: ', $processo['Prorrogacao'][$i]['qtd_dias'],' dias, pelo: ', $processo['Prorrogacao'][$i]['responsavel_legal'], ', BGO: ',$processo['Prorrogacao'][$i]['bgo'], '<hr>';
                                }    
                            }
                                ?>
                            <?php
                            for ($i=0; $i <count($processo['Suspensao']) ; $i++) { 
                                if($processo['Suspensao'][$i]){
                                    if($processo['Suspensao'][$i]['data_termino']){
                                        $inicio = 'Foi <b>suspenso</b> <br> de: ';
                                        $meio = ' até: ';
                                        $fim = $this->Formatacao->data($processo['Suspensao'][$i]['data_termino']);
                                    }else{
                                        $inicio = 'Está <b>suspenso</b> desde: ';
                                        $meio = '';
                                        $fim = '';
                                    }
                                    echo $inicio, $this->Formatacao->data($processo['Suspensao'][$i]['data_inicio']), $meio, $fim,'<br> pelo: ', $processo['Suspensao'][$i]['responsavel_legal'], ', BGO: ',$processo['Suspensao'][$i]['bgo'], '<hr>';
                                }    
                            }
                                ?>
                        </li>
                    </ul>

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
<?php 
    };
?>