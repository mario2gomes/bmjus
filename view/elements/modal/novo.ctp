<!-- Modal -->

<!--

<div class="modal fade" id="novo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Novo processo</h4>
      </div>
        <div class="modal-body">
            <div class="funcoes form">
                <div class="widget-box"> 
                    <?php// echo $this->Form->create('Processo', ['url' => ['action' => 'novo']]); ?>
                    <?php// echo $this->Form->input('num_processo',array('label'=>'Número do processo', 'class' => 'span1', 'upper' => 'true'));?>
                    <?php// echo $this->Form->input('num_portaria',array('label'=>'Número da portaria', 'class' => 'span1'));?>
                    <?php// echo $this->Form->input('num_bgo',array('label'=>'Número do BGO', 'class' => 'span1'));?>
                    <?php// echo $this->Form->input('data_bgo',array('label'=>'Data do BGO', 'type'=>'date', 'class' => 'span1', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
                    <?php// echo $this->Form->input('obm',array('class' => 'span1'));?>
                    <?php// echo $this->Form->input('instaurador',array('label'=>'Autoridade Instauradora', 'class' => 'span1'));?>
                    <?php// echo $this->Form->input('encarregado',array('class' => 'span1'));?>
                    <?php// echo $this->Form->input('tipo_processos_id',array('label'=>'Procedimento','options' => $tipos, 'empty' => '--Selecione--') );?>
                    <?php// echo $this->Form->input('investigado',array('label'=>'Investigado (se houver)', 'class' => 'span1'));?>
                    <?php// echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver)', 'class' => 'span1'));?>
                    <?php// echo $this->Form->input('descricao',array('type'=>'textarea', 'class' => 'span1'));?>
                </div>
            </div>
        </div> 
      </div>
      <div class="modal-footer">
        
        <a class="btn" data-dismiss="modal" aria-hidden="true">Fechar</a>            
        <?php// echo $this->Form->end(array('type' => 'submit', 'class' => 'btn btn-success'));?>
      </div>
    </div>
  </div>
</div>








<div id="novo" class="bootbox modal fade in" tabindex="-1" style="overflow:hidden;" aria-hidden="false">
    <div class="modal-header"><a href="javascript:;" class="close">×</a><h3>Novo processo</h3></div>
        <div class="modal-body">
        </div>
        
        <div class="modal-footer">
            <a data-handler="0" class="btn null" href="javascript:;">Cancel</a>
            <a data-handler="1" class="btn btn-primary" href="javascript:;">OK</a>
        </div>
    </div>
</div>
<div class="modal-backdrop fade in"></div>
-->


<div class="modal fade" id="novo" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">NOVO PROCESSO</h3>

                        <p>Preencha os dados do novo processo</p>

                        <div class="widget-box"> 

                            <?php echo $this->Form->create('Processo', ['url' => ['action' => 'novo']]); ?>
                            <?php echo $this->Form->input('tipo_processos_id',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "procedimento", 'label'=>'Procedimento','options' => $tipos, 'empty' => '--Selecione--') );?>
                            <?php echo $this->Form->date('data_bgo',array('label'=>'Data do BGO de abertura', 'class' => 'form-control', 'div' => 'form-group','dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
                            <?php echo $this->Form->input('num_processo',array('label'=>'Número do processo', 'upper' => 'true', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número do processo"));?>
                            <?php echo $this->Form->input('num_portaria',array('label'=>'Número da portaria', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número da portaria"));?>
                            <?php echo $this->Form->input('num_bgo',array('label'=>'Número do BGO', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número do BGO"));?>
                            <?php echo $this->Form->input('obm',array( 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "OBM"));?>
                            <?php echo $this->Form->input('instaurador',array('label'=>'Autoridade Instauradora', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Instaurador"));?>
                            <?php echo $this->Form->input('encarregado',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "encarregado"));?>
                            <?php echo $this->Form->input('investigado',array('label'=>'Investigado (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "investigado"));?>
                            <?php echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "escrvão"));?>
                            <?php echo $this->Form->input('descricao',array('type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "descrição"));?>
                            <?php echo $this->Form->end(array('label'=>'Salvar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>