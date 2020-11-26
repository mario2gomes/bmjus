<!-- Modal -->
<div class="modal fade" id="enviar_documento" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">ENVIAR DOCUMENTO</h3>

                        <?= $this->Flash->render() ;

                        //criar texto do aviso caso o processo não tenha: autuação(1), portaria de abertura(2),  ou termo de abertura(3)
                        $tipo_documentos_desse_processo = $tipo_documentos;
                        $doc_tipo = array();
                        //cria um array apenas com os tipos de documentos desse processo
                        foreach ($documentos_desse_processo as $documento) {
                            $doc_tipo[] = $documento['Documento']['tipo_documento_id'];
                        }
                        //tira os tipos de documentos que já existem e não podem se repetir
                        if(in_array(1,$doc_tipo) && in_array(2,$doc_tipo) && in_array(3,$doc_tipo)){
                            unset($tipo_documentos_desse_processo[1]);
                            unset($tipo_documentos_desse_processo[2]);
                            unset($tipo_documentos_desse_processo[3]);
                            if (in_array(30, $doc_tipo) && in_array(31, $doc_tipo)){
                                $tipo_documentos_desse_processo = array(33=>$tipo_documentos[33],34=>$tipo_documentos[34]);
                            }else{
                                unset($tipo_documentos_desse_processo[33]);
                                unset($tipo_documentos_desse_processo[34]);
                            }
                        }else{
                            foreach ($tipos_obrigatorios as $identificador => $tipo) {
                                if (in_array($identificador, $doc_tipo)){
                                    unset($tipos_obrigatorios[$identificador]);
                                }
                            }
                            $tipo_documentos_desse_processo = $tipos_obrigatorios;
                        }
                        ?>

                        <!-- <div class="widget-box">  -->
                        <div class="upload-frm form-group">

                            <?php
                            $uploadData = '';
                            echo $this->Form->create('Documento', array('type' => 'file','url'=>array('controller'=>'documentos','action'=>'enviar')));
                            //echo $this->Form->create($uploadData, ['type' => 'file']); 
                            echo $this->Form->input('tipo_documento_id',array('class' => 'chosen-select','options' => $tipo_documentos_desse_processo, 'empty' => '--Selecione--') );
                            echo $this->Form->input('usuario_envia_id', array('value' => $usuario_atual['cpf'], 'type'=> 'hidden'));
                            echo $this->Form->input('processo_id',array('value'=>$processo['Processo']['id'],'type'=>'hidden'));
                            echo $this->Form->input('observacao',array('type'=>'textarea','label' => "observação"));
                            /*echo $this->Form->input('nome_arquivo',array('value'=>$arquivo['Arquivo']['name'], 'type'=>'hidden'));
                            echo $this->Form->input('tipo_arquivo',array('value'=>$arquivo['Arquivo']['type'], 'type'=>'hidden'));
                            echo $this->Form->input('tmp_name_arquivo',array('value'=>$arquivo['Arquivo']['tmp_name'], 'type'=>'hidden'));
                            echo $this->Form->input('erro_arquivo',array('value'=>$arquivo['Arquivo']['error'], 'type'=>'hidden'));
                            echo $this->Form->input('tamanho_arquivo',array('value'=>$arquivo['Arquivo']['size'], 'type'=>'hidden'));
                            */
                            echo $this->Form->input('arquivo', array('type' => 'file','label' =>''));
                            echo $this->Form->button(('Enviar arquivo'), ['type'=>'submit', 'class' => 'btn btn-sm btn-primary ']);
                            echo $this->Form->end();?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>