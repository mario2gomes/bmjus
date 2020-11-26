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

<div class="tab-pane">
    <div class="row m-b-lg">
        <div class="text-center">
            <h2><strong>                                                        
                <?php echo $this->Html->link($processo['Tipo_processo']['descricao']." ".$processo['Processo']['num_processo'], array('controller' => 'processos', 'action' => 'detalhe',$processo['Processo']['id'])); ?>
            </strong></h2>
        </div>
    </div>

    <?php 
    if ($processo['Processo']['estados_id']==5){
        echo ' ';
        }else{ ?>
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
            }; 
    };
    ?>

    <div class="client-detail">
        <div class="full-height-scroll">

            <ul class="list-group clear-list">
                <li class="list-group-item fist-item">
                    <span class="pull-right label <?php echo $label ?>"><?php echo $processo['Situacao']['descricao']; ?> </span>
                    <strong> Situação: </strong>
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $processo['Estado']['descricao']; ?> </span>
                    <strong> Estado </strong>
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $this->Formatacao->data($processo['Processo']['data_bgo']); ?> </span>
                    <strong> Data de abertura </strong>
                </li>

                <?php 
                if ($processo['Processo']['situacoes_id']==5){
                }else{ ?>
                    <li class="list-group-item">
                        <span class="pull-right"> <?php 
                            if ($processo['Processo']['estados_id'] == 2){
                                echo 'Indefinido';
                            }else{
                                echo $this->Formatacao->data($processo['Processo']['previsao_termino']);
                            }; ?>
                        </span>
                        <strong> Previsão de término: </strong>
                    </li>
                <?php }; ?>

                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $criador['cargo_nome']; ?> </span>
                    <strong> Incluí­do por </strong>
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $funcoes[$processo['Processo']['posse_id']]; ?> </span>
                    <strong> Em posse de </strong>
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $instaurador['cargo_nome']; ?> </span>
                    <strong> Aut. instauradora </strong>
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $encarregado['cargo_nome']; ?> </span>
                    <strong> Encarregado </strong>
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php $escrivao['cargo_nome']; ?> </span>
                    <strong> Escrivão </strong>
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $investigado['cargo_nome']; ?> </span>
                    <strong> Investigado </strong>
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $investigado['cargo_nome']; ?> </span>
                    <strong> Investigado </strong>
                </li>
            </ul>

            <strong>Resumo</strong>
            <p>
                <?php echo $processo['Processo']['resumo']; ?>
            </p>
            <hr>
            <strong>Histórico</strong>
            <?php if (0){ ?>
                <div id="vertical-timeline" class="vertical-container dark-timeline">
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon gray-bg">
                            <i class="fa fa-coffee"></i>
                        </div>
                        <div class="vertical-timeline-content">
                            <p>Conference on the sales results for the previous year.
                            </p>
                            <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                        </div>
                    </div>
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon gray-bg">
                            <i class="fa fa-briefcase"></i>
                        </div>
                        <div class="vertical-timeline-content">
                            <p>Many desktop publishing packages and web page editors now use Lorem.
                            </p>
                            <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                        </div>
                    </div>
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon gray-bg">
                            <i class="fa fa-bolt"></i>
                        </div>
                        <div class="vertical-timeline-content">
                            <p>There are many variations of passages of Lorem Ipsum available.
                            </p>
                            <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                        </div>
                    </div>
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-warning"></i>
                        </div>
                        <div class="vertical-timeline-content">
                            <p>The generated Lorem Ipsum is therefore.
                            </p>
                            <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                        </div>
                    </div>
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon gray-bg">
                            <i class="fa fa-coffee"></i>
                        </div>
                        <div class="vertical-timeline-content">
                            <p>Conference on the sales results for the previous year.
                            </p>
                            <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                        </div>
                    </div>
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon gray-bg">
                            <i class="fa fa-briefcase"></i>
                        </div>
                        <div class="vertical-timeline-content">
                            <p>Many desktop publishing packages and web page editors now use Lorem.
                            </p>
                            <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa

ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
ajaskjdhasjkldkjasdklasjdlkasdjaslkdjsa
