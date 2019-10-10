<script>
    //Faz a baixa do alerta e retira ele da lista
    $(document).ready(function(){
        
        var url = '<?php echo $this->Html->url(array('controller'=>'alertas', 'action'=>'total')); ?>';
        $.getJSON(url, function(data){
                    var total = data.total;
                    //Se houver alertas exibe a caixa de alertas
                    if(total > 0){
                        $('#total_alertas').html(total);
                        $('#alerta_box').show();                       
                    }              
        });        
    });
</script>
<li id="alerta_box" class="grey" style="display: none;">
    <a href="#" modal_target="modal_alerts" title="Existem alertas" url="<?php echo $this->Html->url(array('controller'=>'alertas', 'action'=>'ler')); ?>" class="dropdown-toggle" data-toggle="dropdown">
        <i class="icon-warning-sign icon-animated-vertical icon-only"></i>
        <span id="total_alertas" class="badge badge-important"></span>
    </a>                           
</li>