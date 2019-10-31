<?php 
if($campo){ //Valida se algum campo no formulário de cencessão de férias deixou de ser preenchido
    if($teste){ //Valida se não existe pendência -> $teste = true
?>
    <script>
        $(document).ready(function(){

            $('#ferias_form').each(function(){
                this.reset();
                $('#militares_destino').tokenInput("clear");
             });

        });
    </script>
<?php } ?>
    
<?php if (!$teste){ //Valida se existe pendência -> $teste = false ?>
<div id="table_report_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable" aria-describedby="table_report_info">
            <thead>
                <tr>
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Nome</th> 
                    <th class="sorting" tabindex="0" aria-controls="table_report" rowspan="1" colspan="1">Impedimento</th>                                                       
                    <th class="actions">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?foreach ($pendencias as $mat => $notes):?>
                <tr>			
                        <td><? echo $nomes[$mat]; ?>&nbsp;</td>                    
                        <td>
                            <?                              
                                foreach ($notes as $note){
                                    echo $note.'<br>';
                                }                                
                            ?>
                        </td>			                        		
                        <td class="actions">
                            <a href="<? echo $this->Html->url(array('controller' => 'militares', 'action' => 'view', $mat)); ?>"> <? echo $this->Html->image('zoom.png', array('title'=>'Detalhar')); ?> </a>                            
                        </td>
                </tr>
                <? endforeach; ?>
            </tbody>
        </table>             
</div>   
<?php 
}
}
?>