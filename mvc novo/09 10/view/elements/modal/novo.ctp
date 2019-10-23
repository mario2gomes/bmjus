<!-- Modal -->
<div class="modal fade" id="novo" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">NOVO PROCESSO</h3>

                        <p>Preencha os dados do novo processo</p>

                        <div class="widget-box"> 

                            <?php echo $this->Form->create('Processo', ['url' => ['action' => 'novo']]); 
                                 echo $this->Form->input('tipo_processos_id',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "procedimento", 'label'=>'Procedimento','options' => $tipos, 'empty' => '--Selecione--') );
                                 echo 'Data da publica��o de instaura��o', $this->Form->date('data_bgo',array('label'=>'Data do BGO de abertura', 'class' => 'form-control', 'div' => 'form-group','dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));
                                 echo $this->Form->input('num_processo',array('label'=>'N�mero do processo', 'upper' => 'true', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "N�mero do processo"));
                                 echo $this->Form->input('num_portaria',array('label'=>'N�mero da portaria', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "N�mero da portaria"));
                                 echo $this->Form->input('num_bgo',array('label'=>'N�mero do BGO', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "N�mero do BGO"));
                                 echo $this->Form->input('obm',array( 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "OBM"));
                                 echo $this->Form->input('instaurador',array('label'=>'Autoridade Instauradora', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Instaurador"));
                                 echo $this->Form->input('encarregado',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "encarregado"));
                                 echo $this->Form->input('investigado',array('label'=>'Investigado (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "investigado"));
                                 echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "escriv�o", 'label'=>'Escriv�o'));
                                 echo $this->Form->input('descricao',array('type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "descri��o", 'label'=>'Descri��o'));
                                 echo $this->Form->input('criador_processo_id', array('value' => $usuarios, 'type'=> 'hidden'));
                                 echo $this->Form->end(array('label'=>'Salvar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>