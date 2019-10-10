
<script>    
    $('.modal-body').scrollTop(0);
</script>      
<div class="row-fluid">
    <div class="span12">        
        <p><b>Data de Inclusão:</b> <?php echo $this->Formatacao->data($dat_admissao); ?></p>
        <p><b>Tempo na corporação:</b> <?php echo $tempo_efetivo->y.' ano(s), '.$tempo_efetivo->m.' mes(es) e '.$tempo_efetivo->d.' dia(s);'; ?></p>
        <p><b>Tempo de serviço público:</b> <?php echo $tempo_averbado['Publico']->y.' ano(s), '.$tempo_averbado['Publico']->m.' mes(es) e '.$tempo_averbado['Publico']->d.' dia(s);'; ?></p>
        <p><b>Tempo de serviço privado:</b> <?php echo $tempo_averbado['Privado']->y.' ano(s), '.$tempo_averbado['Privado']->m.' mes(es) e '.$tempo_averbado['Privado']->d.' dia(s);'; ?></p>
        <p><b>Tempo total:</b> <?php echo $tempo_servico->y.' ano(s), '.$tempo_servico->m.' mes(es) e '.$tempo_servico->d.' dia(s);'; ?></p><br>
        <p><b>Linha do tempo (previsão para reserva: <? echo $tempo_reserva['data_reserva']; ?>)</b></p>
    </div>   
    <div class="span10">        
        <div class="progress">             
            <div class="bar bar-success" style="width:<?php echo $tempo_efetivo->days*100/($tempo_reserva['qtd_ano']*365); //TEMPO EFETIVO ?>%;"></div>
            <div class="bar bar-warning" style="width:<?php echo $tempo_averbado['Publico']->days*100/($tempo_reserva['qtd_ano']*365); //TEMPO AVERBADO Publico?>%;"></div>            
            <div class="bar bar-info" style="width:<?php echo $tempo_averbado['Privado']->days*100/($tempo_reserva['qtd_ano']*365); //TEMPO AVERBADO Privado?>%;"></div>            
            <!--<div class="bar bar-danger" style="width: 10%;"></div>-->
        </div>  
        <span style="float: left; text-align: left;"><b>0 ano</b></span>
        <span style="float: right; text-align: right;"><b><? echo $tempo_reserva['qtd_ano']; ?> anos</b></span>
    </div>
    &nbsp;
</div>
