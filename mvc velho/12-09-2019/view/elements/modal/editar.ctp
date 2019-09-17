<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">NOVO PROCESSO</h3>

                        <p>Preencha os dados do novo processo</p>

                        <div class="widget-box"> 

                            <?php echo $this->Form->create('Processo', ['url' => ['action' => 'novo']]); ?>
                            <?php echo $this->Form->input('tipo_processos_id',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "procedimento", 'label'=>'Procedimento','options' => $tipos, 'empty' => '--Selecione--') );?>
                            <?php echo $this->Form->date('data_bgo',array('label'=>'Data do BGO', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Data BGO", 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
                            <?php echo $this->Form->input('num_processo',array('label'=>'Número do processo', 'upper' => 'true', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número do processo"));?>
                            <?php echo $this->Form->input('num_portaria',array('label'=>'Número da portaria', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número da portaria"));?>
                            <?php echo $this->Form->input('num_bgo',array('label'=>'Número do BGO', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Número do BGO"));?>
                            <?php echo $this->Form->input('obm',array( 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "OBM"));?>
                            <?php echo $this->Form->input('instaurador',array('label'=>'Autoridade Instauradora', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Instaurador"));?>
                            <?php echo $this->Form->input('encarregado',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "encarregado"));?>
                            <?php echo $this->Form->input('investigado',array('label'=>'Investigado (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "investigado"));?>
                            <?php echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "escrvão"));?>
                            <?php echo $this->Form->input('descricao',array('type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "descrição"));?>
                            <?php //echo $this->Form->end('Salvar', array('class'=>"btn btn-sm btn-primary pull-right m-t-n-xs"));?>
                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Editar</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>