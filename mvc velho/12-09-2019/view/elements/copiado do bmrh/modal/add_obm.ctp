<div id="obm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h3>Nova OBM</h3>
       </div>        
       <div class="modal-body">
           <div class="obms form">    
               <div class="widget-box">                    
                           <?echo $this->Form->create('Obm', array('controller'=>'obms', 'action'=>'add'));?>
                           <?echo $this->Form->input('sig_obm', array('label'=>'Sigla da OBM', 'upper'=>'true'));?>
                           <?echo $this->Form->input('dsc_obm', array('label'=>'Descrição', 'upper'=>'true'));?>
                           <?echo $this->Form->input('obm_hierarquia', array('label'=>'OBM superior', 'options'=> $obm_hierarquia ));?>
                           <hr>
                           <? echo $this->Form->end(array('type' => 'submit', 'class' => 'btn btn-success'));?>                     
               </div>
           </div>
       </div>
       <div class="modal-footer">
           <a class="btn" data-dismiss="modal" aria-hidden="true">Fechar</a>            
       </div>
</div>