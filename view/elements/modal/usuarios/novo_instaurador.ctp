<!-- Modal -->
<div class="modal fade" id="novo_instaurador" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Designar autoridade</h3>

<!--
<div class="form-group">
                
                
                <label class="font-normal">Basic example</label>
                <div class="input-group">
                <select data-placeholder="Escolha um..." class="chosen-select" tabindex="2">
                    <option value="">Select</option>
                    <option value="United States">United States</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Aland Islands">Aland Islands</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                </select>
            </div>
        


<script type="text/javascript">
            var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
</script>

-->
                        <?php
                        echo $this->Form->create('Usuario', ['url' => ['action' => 'novo_encarregado']]);                                  
                        echo $this->Form->input('cpf',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "", 'label'=>'Busque um militar pelo nome','options' => $nomes, 'empty' => '--Selecione--') );
                        echo $this-> Form->end(array('label'=>'Substituir','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));?>
                            <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>