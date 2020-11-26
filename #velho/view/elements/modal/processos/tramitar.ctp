<div class="modal fade" id="tramitar" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                    	<h3 class="m-t-none m-b"><?php echo 'Tramitar ', $processo['Tipo_processo']['descricao'],' ', $processo['Processo']['num_processo'], ' para:'; ?></h3>
	                        <div class="widget-box"> 
					       <?php
/*                           $tipo_documento_desse_processo = array();
                                foreach ($documentos_desse_processo as $documento) {
                                $tipo_documento_desse_processo[] = $documento['Documento']['tipo_documento_id'];
                            }
                            //verifica se o processo está (em posse do encarregado e possui relatório e termo de encerramento) ou se (está em posse do instaurador e possui solução e publicação de solução) para permitir tramitar apenas à  corregedoria
                            if (($processo['Processo']['posse_id']==3 && in_array(30,$tipo_documento_desse_processo) && in_array(31,$tipo_documento_desse_processo)) || ($processo['Processo']['posse_id']==4 && in_array(33,$tipo_documento_desse_processo) && in_array(34,$tipo_documento_desse_processo))){
                                    $funcoes = array(2=>'corregedoria');
                            }elseif(($processo['Processo']['posse_id']==2 && in_array(30,$tipo_documento_desse_processo) && in_array(31,$tipo_documento_desse_processo) && $processo['Processo']['estado']==4)){
                                $funcoes = array(3=>'encarregado',4=>'instaurador');
                            }
*/                    
                            //instaurador e encarregado tramitam apenas à  corregedoria (sem opção) e corregedoria a um dos dois


								echo $this->Form->create('Tramitacao',array('url' => array('controller'=>'processos','action' => 'tramitar')));
								echo $this->Form->input('funcao_entrega_id', array('value' => $processo['Processo']['posse_id'], 'type'=> 'hidden'));
								echo $this->Form->input('usuario_tramita_id', array('value' => $usuario_atual['cpf'], 'type'=> 'hidden'));
/*                                //confere se o processo possui relatório e termo de encerramento
                                if (in_array(30, $tipo_documento_desse_processo) && in_array(31, $tipo_documento_desse_processo)){
                                    //confere se o processo possui solução e np de solução
                                    if (in_array(33, $tipo_documento_desse_processo) && in_array(34, $tipo_documento_desse_processo)){
                                        if($processo['Processo']['estados_id'] == 3){
                                            $valor = array('label'=>'','value'=>2,'type'=>'hidden');
                                            $mensagem = 'O processo possui solução e publicação da solução, <strong>confirma a tramitação do processo à  corregedoria, para análise e parecer?</strong>';
                                        }elseif ($processo['Processo']['estados_id'] == 4){
                                        //se possui solução e np de solução tramita automaticamente para o instaurador
                                        $valor = array('label'=>'','value'=>4,'type'=>'hidden');
                                        $mensagem = '<strong>O processo será tramitado à  autoridade instauradora, preencha o despacho com as correções.';
                                        }
                                    }else{
                                        //se o processo está no estado "instaurado" o encarregado envia à  corregedoria
                                        if ($processo['Processo']['estados_id'] == 1){
                                            $valor = array('label'=>'', 'value'=>2,'type'=>'hidden');
                                            $mensagem = 'O processo possui relatório e termo de encerramento, <strong>confirma a tramitação do processo à  corregedoria, para análise e parecer</strong>?';
                                        //verifica se o processo está no estado "em análise" e de posee da corregedoria
                                        }elseif ($processo['Processo']['estados_id'] == 4){
                                            $valor = array('label'=>'','class' => 'chosen-select','options' => array(3=>'encarregado',4=>'instaurador'), 'empty' => '--Selecione--');
                                            $mensagem = 'Tramitar à  autoridade instauradora concordando com o relatório ou ao encarregado para correções, preencha o despacho com o motivo da correção';
                                        }elseif($processo['Processo']['estados_id'] == 3){
                                            $valor = array('label'=>'', 'value'=>2,'type'=>'hidden');
                                            $mensagem = 'Favor enviar a solução e a Np da mesma antes de tramitar à  corregedoria.';
                                        }
                                    }
                                }else{
                                    $valor = array('label'=>'','class' => 'chosen-select','options' => $funcoes, 'empty' => '--Selecione--');
                                        $mensagem = 'Favor escolher para quem o processo será tramitado e preencher o despacho';
                                    echo '<strong>Tramitar para: </strong>';

                                }
*/
$valor = array('label'=>'','class' => 'chosen-select','options' => $funcoes, 'empty' => '--Selecione--');
$mensagem = 'Favor escolher para quem o processo será tramitado e preencher o despacho';
                                echo $this->Form->input('funcao_recebe_id', $valor);
                                echo $this->Form->input('processos_id', array('value' => $processo['Processo']['id'], 'type'=> 'hidden'));
								echo $this->Form->input('despacho', array('type'=>'textarea'));
                                ?> <br> <?php
                                echo $this->Form->end(array('label'=>'Tramitar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));
							?>
				            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tramitar</strong></button> -->
                            <?php //echo $this->Form->end('Salvar', array('class'=>"btn btn-sm btn-primary pull-right m-t-n-xs"));?>
                        </div>
                    </div>
                    <div class="col-sm-6 b-r">
                        <br><br>
                        <div class="alert alert-success">
                            <?php echo '<center><h3>'.$mensagem.'</center></h3>'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>