<?php if(!empty($militares)){?>
    
    <?php foreach($militares as $m){?>    
        <div class="widget-box">
                <div class="widget-header widget-header-flat">
                        <h5 class="smaller"><?php echo $m['ViewMilitar']['cargo_nome'].' Mat. '.$m['ViewMilitar']['num_matricula']; ?></h5>
                        <div class="widget-toolbar">
                            <a href="<?php echo $this->Html->url(array("controller" => "militares", "action" => "view", $m['ViewMilitar']['id'])); ?>"><span class="label label-success"><i class="icon-search"></i> ver </span></a>
                        </div>
                </div>
                <div class="widget-body">
                    <div class="row-fluid">
                        <div class="span2">
                            <img width="70" src="<?php echo $this->Html->url(array("controller" => "militares", "action" => "foto", $m['ViewMilitar']['id'])); ?>">
                        </div>
                        <div class="span4">
                            <p><b>Lotação:</b> <?php echo $m['ViewMilitar']['sig_obm']; ?></p>
                            <p><b>Status:</b> <?php echo $m['ViewMilitar']['dsc_status']; ?></p>
                            <p><b>Situação:</b> <?php echo $m['ViewMilitar']['dsc_situacao']; ?></p>
                            <p><b>Saúde:</b> <?php $status_apto = Configure::read('Saude.apto'); if($status_apto == $m['ViewMilitar']['status_saude_id']){echo '<span class="label label-success">Apto</span>';}else{echo '<span class="label label-important">Baixado</span>';} ?></p>
                        </div>
                        <div class="span6">
                            <p><b>Contato:</b> <?php echo $m['ViewMilitar']['num_telefone']; ?></p>
                            <p><b>Email:</b> <?php echo $m['ViewMilitar']['email']; ?></p>
                            <p><b>Função:</b> <?php echo $m['ViewMilitar']['dsc_funcao']; ?></p>
                            <?if(isset($opcoes['previsao_reserva'])){?>
                                <p><b>Previsão de Reserva:</b> <?php echo $this->Formatacao->data($m['ViewMilitar']['previsao_reserva']);?></p>
                            <?}?>
                            <?if(isset($opcoes['previsao_reforma'])){?>
                                <p><b>Previsão de Reforma:</b> <?php echo $this->Formatacao->data($m['ViewMilitar']['previsao_reforma']);?></p>
                            <?}?>
                        </div>
                    </div>  
                </div>
        </div>
    <?php } ?> 

<?php }else{echo '<span class="label label-inverse">Nada encontrado!</span>'; } ?>