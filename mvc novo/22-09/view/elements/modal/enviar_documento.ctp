<!-- Modal -->
<div class="modal fade" id="enviar_documento" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">ENVIAR DOCUMENTO</h3>

                        <?= $this->Flash->render() ;
                        //pr ($processo);
                        ?>

                        <!-- <div class="widget-box">  -->
                        <div class="upload-frm">

                            <?php 
                            $uploadData = '';
                            
                            echo $this->Form->create($uploadData, ['type' => 'file']); 

                            echo $this->Form->input('tipo_documento_id',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Tipo de documento", 'label'=>'Tipo de documento: ','options' => $tipos, 'empty' => '--Selecione--') );
                            echo $this->Form->input('usuario_envia_id', array('value' => $usuarios, 'type'=> 'hidden'));
                            echo $this->Form->input('processo_id',array('value'=>$processo['Processo']['id'],'class' => 'form-control', 'div' => 'form-group', 'type'=>'hidden'));
                            echo $this->Form->input('observacao',array('type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group', 'label' => "observação"));
                            /*echo $this->Form->input('nome_arquivo',array('value'=>$arquivo['Arquivo']['name'], 'type'=>'hidden'));
                            echo $this->Form->input('tipo_arquivo',array('value'=>$arquivo['Arquivo']['type'], 'type'=>'hidden'));
                            echo $this->Form->input('tmp_name_arquivo',array('value'=>$arquivo['Arquivo']['tmp_name'], 'type'=>'hidden'));
                            echo $this->Form->input('erro_arquivo',array('value'=>$arquivo['Arquivo']['error'], 'type'=>'hidden'));
                            echo $this->Form->input('tamanho_arquivo',array('value'=>$arquivo['Arquivo']['size'], 'type'=>'hidden'));
                            */
                            echo $this->Form->input('arquivo', ['type' => 'file', 'class' => 'form-control','label' =>'']);
                            //echo $this->Form->button(__('Enviar arquivo'), ['type'=>'submit', 'class' => 'form-controlbtn btn-default']);
                            echo $this->Form->end(array('label'=>'Enviar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>