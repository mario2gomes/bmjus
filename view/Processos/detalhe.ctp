<?php   
//($documento['Documento']['usuario_assina_id'])['cargo_nome'];
    if($usuario_atual['funcao_id'] == 1260 || 
        $usuario_atual['grupo'] == 1 || 
        $usuario_atual['grupo'] == 2 || 
        $processo['Processo']['encarregado'] ==$usuario_atual['cpf'] ||
            $processo['Processo']['instaurador'] == $usuario_atual['cpf'] || 
            $processo['Processo']['escrivao'] == $usuario_atual['cpf'] || 
            $processo['Processo']['investigado'] == $usuario_atual['cpf']){

        echo $this->element('modal/usuarios/novo_escrivao');
        echo $this->element('modal/usuarios/novo_encarregado');
        echo $this->element('modal/processos/tramitar');
        echo $this->element('modal/processos/prorrogar');
        echo $this->element('modal/processos/suspender');
        echo $this->element('modal/processos/reabrir');
        echo $this->element('modal/processos/editar');
        echo $this->element('modal/documentos/enviar');
        echo $this->element('modal/processos/emitir_parecer');
        echo $this->element('modal/processos/solucionar');
        //Aviso de falta de arquivo(documento) no processo:
//$pasta = new Folder(WWW_ROOT.'arquivos'.DS.'processos'.DS.$processo['Processo']['Tipo_processo'].DS.$processo['Processo']['num_processo']);
//$arquivos = $pasta->find($processo['Processo']['num_processo'].'*\.ctp');

//criar texto do aviso caso o processo não tenha: autuação(1), portaria de abertura(2),  ou termo de abertura(3)

foreach ($tipos_obrigatorios as $identificador => $tipo) {
    if (!in_array($identificador, $tipo_documento_desse_processo)){
        $aviso = 'Processo sem '.$tipo;
        break;
    }
}

if (in_array(30, $tipo_documento_desse_processo) && in_array(31, $tipo_documento_desse_processo) && $processo['Processo']['posse_id'] == 3 && $processo['Processo']['estados_id'] == 1){
    $aviso = 'Processo encerrado, tramite à corregedoria para parecer';
}

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Detalhes do projeto</h2>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard.ctp">Projeto</a>
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
                            <?php //Aviso à autoridade instauradora                            
                                if ($aviso){ ?>
                                    <div class="ibox-tools">
                                        <!-- Button trigger modal -->
                                        <div class="btn-danger btn-lg" >
                                            <?php echo $aviso; ?>
                                        </div>
                                    </div>
                            <?php } ?>
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
                                            <dt>Estado:</dt> 
                                            <dd><?php echo $processo['Estado']['descricao']; }; ?></dd>

                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >
                                        <dt>Incluí­do por:</dt> <dd><? echo $criador['cargo_nome']; ?></dd>
                                        <dt>Em posse de:</dt> <dd><?php echo $funcoes[$processo['Processo']['posse_id']]; ?></dd>
                                        <dt>Aut. instauradora:</dt> <dd><?php echo $instaurador['cargo_nome']; ?></dd>
                                        <dt>Encarregado:</dt> <dd> <?php echo $encarregado['cargo_nome']; ?> </dd>
                                        <dt>Escrivão:</dt> <dd> <?php echo $escrivao['cargo_nome']; ?> </dd>
                                        <dt>Investigado:</dt> <dd> <?php echo $investigado['cargo_nome']; ?> </dd>
                                    </dl>
                                </div>
                            </div>

                            <?php 
                                if ($processo['Processo']['estados_id']==5){
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
                                            <td class="hidden-phone"><?php echo /* $tramitacao['Tramitacao']['usuario_tramita_id'], ': ',*/ $tramitacao['Tramitacao']['despacho']; ?></td>
                                        <?php }; ?>
                                        </tr>
                                        <?php 
                                        }; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-2">
                                    <div class="feed-activity-list">
                                        <?php foreach ($documentos_desse_processo as $documento){ ?>
                                        <div class="feed-element">
                                            <div href="#" class="pull-left">
                                                <?php echo $this->Html->link('Visualizar', array(
                                                    'controller' => 'documentos',
                                                    'action' => 'visualizar',
                                                    $processo['Tipo_processo']['descricao'],
                                                    str_replace('/','_',$processo['Processo']['num_processo']),
                                                    str_replace('?','_',$documento['Documento']['nome_arquivo'])),
                                                    array('type'=>'button','class'=>'btn btn-primary')); ?>
                                            </div>
                                            <!--assinatura do documento enviado-->
                                            <div class="pull-right">
                                                <?php if(empty($documento['Documento']['usuario_assina_id'])){ ?>
                                                    <a class="btn btn-danger" data-toggle="collapse" data-target="#assinar<?php echo $documento['Documento']['id']; ?>">Assinar</a>
                                                <?php } ?>

                                                <div id="assinar<?php echo $documento['Documento']['id']; ?>" class="collapse">
                                                        <?php echo $this->Form->create(false, array( 'url' => array ('controller'=>'documentos','action'=>'assinar')));
                                                                //echo $this->Form->input('seq_documento', array('type'=>'hidden', 'value'=>$documento['Documento']['seq_documento']));
                                                                //echo $this->Form->input('cod_encaminhamento', array('type'=>'hidden', 'value'=>1));//COD DE ASSINADO
                                                                echo $this->Form->input('cpf', array('label'=>'CPF', 'class'=>'pull-right'));
                                                                echo $this->Form->input('senha', array('label'=>'Senha', 'type'=>'password', 'class'=>'pull-right'));
                                                                echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$documento['Documento']['id']));
                                                                //echo $this->Form->input('cod_funcao_origem', array('type'=>'hidden', 'value'=>$session->read('Funcao.seq_funcao')));
                                                        echo $this->Form->end(array('label' => 'Ok', 'class'=>'btn btn-primary'));?>
                                                </div>	
                                            </div>
                                            <div class="media-body ">
                                                <strong><?php echo $documento['Tipo_documento']['descricao']; ?></strong>
                                                <?php if($documento['Documento']['usuario_assina_id']){ ?>
                                                    , assinado por: <strong><?php echo $this->App->getUsuario($documento['Documento']['usuario_assina_id'])['cargo_nome']; ?></strong><br>
                                                <?php }else{ ?>
                                                    , enviado por: <strong><?php echo $this->App->getUsuario($documento['Documento']['usuario_envia_id'])['cargo_nome']; ?></strong><br>
                                                <?php } ?>
                                                Em <small><?php echo $documento['Documento']['created']; ?></small>
                                                <a> <?php echo $documento['Documento']['nome_arquivo']; ?></a><br>
                                                    <?php 
                                                    if (!empty($documento['Documento']['observacao'])){ ?>
                                                        <div class="well">
                                                            <?php echo substr($documento['Documento']['observacao'],0,10000); ?>
                                                        </div>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                        <?php
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
                    <h3>Resumo: </h3>
                    <p>
                        <?php echo $processo['Processo']['resumo']; ?>
                    </p>


                    <?php
                        //Apenas o encarregado por esse processo pode designar um escrivão para o mesmo;
                        if ($usuario_atual['cpf'] == $processo['Processo']['encarregado'] && $processo['Processo']['estados_id'] != 5){ 
                            if($processo['Processo']['escrivao']){?>
                                <div class="text-center m-t-md">
                                    <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#novo_escrivao">Substituir Escrivão</button>
                                </div>
                        <?php }else{ ?>
                            <div class="text-center m-t-md">
                                <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#novo_escrivao">Designar Escrivão</button>
                            </div>
                        <?php }} 
                            //Apenas a corregedoria e o instaurador desse processo pode substituir o encarregado para o mesmo;
                            if (($usuario_atual['grupo'] == 2 || $usuario_atual['cpf'] == $processo['Processo']['instaurador']) && $processo['Processo']['estados_id'] != 5){ 
                        ?>
                            <div class="text-center m-t-md">
                                <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#novo_encarregado">Substituir Encarregado</button>
                            </div>
                    <?php } ?>

                    <?php
                    //verifica se o processo foi arquivado ou se está suspenso
                    if ($processo['Processo']['estados_id']!=5){
                        if ($processo['Processo']['estados_id']!=2){
                    //verifica se a posse está com o usuário atual (e se não está suspenso) para exibir botões de tramitar e emitir solução
                        if(($processo['Processo']['posse_id'] == $usuario_atual['grupo']) || $processo['Processo'][$funcoes[$processo['Processo']['posse_id']]] == $usuario_atual['cpf']){
                            if($processo['Processo']['instaurador'] == $usuario_atual['cpf'] && $processo['Processo']['estados_id'] == 3 && $processo['Processo']['posse_id'] == 4){ ?>
                                <div class="text-center">
                                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#solucionar">Emitir solução</button>
                                </div>
                        <?php } 

                    //confere se o processo possui relatório e termo de encerramento e se está em posse da corregedoria, para liberar o botão emitir parecer
                    if (in_array(30, $tipo_documento_desse_processo) && in_array(31, $tipo_documento_desse_processo) && $processo['Processo']['posse_id'] == 2 && $usuario_atual['grupo'] == 2){
                        ?>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#emitir_parecer">Emitir parecer</button>
                        </div>
                    <?php } ?>
                        <div class="text-center m-t-md">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tramitar">Tramitar</button>
                        </div>
                    <?php }; 
                    //Apenas a autoridade instauradora pode prorrogar pela 1Âªvez e apenas o comandante geral pode prorrogar pela 2Âª
                        if($usuario_atual['funcao_id'] == 1260 && $processo['Processo']['estados_id'] == 1 && $processo['Processo']['prorrogacoes'] == 1){ ?>
                    <div class="text-center m-t-md">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#prorrogar">Prorrogar</button>
                    </div>
                <?php }
                        if($usuario_atual['grupo'] == 4 && $processo['Processo']['instaurador'] == $usuario_atual['cpf']){
                            if ($processo['Processo']['estados_id'] == 1 && $processo['Processo']['prorrogacoes'] == 0){
                    ?>
                    <div class="text-center m-t-md">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#prorrogar">Prorrogar</button>
                    </div>
                <?php } ?>
                    <div class="text-center m-t-md">
                    </div>
                    <div class="text-center m-t-md">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editar">Editar</button>
                    </div>
                    <?php }; 
                    //O botão de adicionar documento só aparece ao encarregado se possuir autuação, portaria de abertura e termo de abertura
                    if($processo['Processo']['estados_id']!=2){
                        if(!$aviso){
                        ?>
                            <div class="text-center m-t-md">
                                <button type="button" class="btn btn-s btn-primary" data-toggle="modal" data-target="#enviar_documento">Adicionar documentos</button>
                            </div>
                        <?php }elseif ($processo['Processo']['instaurador'] = $usuario_atual['cpf']) { ?>
                            <div class="text-center m-t-md">
                                <button type="button" class="btn btn-s btn-primary" data-toggle="modal" data-target="#enviar_documento">Adicionar documentos obrigatórios</button>
                            </div>
                        <?php }
                        } 
                    }
                    //Apenas a autoridade instauradora, o comandante geral e o sub comandante geral podem suspender o processo
                        if($usuario_atual['funcao_id'] == (1260||1259) || $processo['Processo']['instaurador'] == $usuario_atual['cpf'] ){
                            if ($processo['Processo']['estados_id'] == 2){ ?>
                                <div class="text-center m-t-md">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#reabrir">Reabrir</button>
                                </div>
                            <?php } else{ ?>
                                <div class="text-center m-t-md">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#suspender">Suspender</button>
                                </div>
                        <?php }
                            }
                        } ?>


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
                                    echo $inicio, $this->Formatacao->data($processo['Suspensao'][$i]['data_inicio']), $meio, $fim,'<br> por: ', $processo['Suspensao'][$i]['responsavel_legal'], ', BGO: ',$processo['Suspensao'][$i]['bgo'], '<hr>';
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
    } else{ 
        echo 'Você não tem permissão de acessar esse processo!';
    };
?>