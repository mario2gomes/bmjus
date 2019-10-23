<div class="anotacoes form">
    <div id="form_anotacao_ferias" class="row-fluid"> 		
            <pre id="anotacoes" class="prettyprint linenums"><?php echo $observacao['Feria']['dsc_observacao']; ?></pre>
            
            <?php echo $this->Form->create('Feria', array('action'=>'anotar','class'=>'form-horizontal'));?>
                    <?php 
                            echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$observacao['Feria']['id']));
                            echo $this->Form->input('dsc_observacao', array('label'=>'Anotação', 'type'=>'textarea', 'id'=>'texto'));				
                    ?>
            <br>
            <div class='submit'>                
                <? echo $ajax->submit('Anotar', array('url' => array('controller' => 'ferias', 'action' => 'anotar', $observacao['Feria']['id']), 'before'=>'$(this).unbind();$(this).attr("value", "Salvando...")', 'update' => 'form_anotacao_ferias', 'class' => 'btn btn-small btn-success', 'div'=>'span12')); ?>
            </div>
            <?php echo $this->Form->end(); ?>
    </div>
</div>