<div id="funcao" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
        <h3>Nova Fun��o</h3>
    </div>        
    <div class="modal-body">
        <div class="funcoes form">
            <div class="widget-box">                             
                <?echo $this->Form->create('Funcao', array('controller'=>'funcoes', 'action'=>'add'));?>
                <?echo $this->Form->input('dsc_funcao', array('label'=>'Descri��o da Fun��o', 'class'=>'span4', 'upper'=>'true'));?>
                <?echo $this->Form->input('cargo_id', array('label'=>'Cargo', 'options' => $cargo, 'empty' => '-- Selecione --'));?>
                <?echo $this->Form->input('quadro_id', array('label'=>'Quadro', 'options' => $quadro, 'empty' => '-- Selecione --'));?>
                <?//echo $this->Form->input('obm', array('label'=>'OBM', 'options' => $obm, 'empty'=>'-- Selecione --', 'ajax'=>'true', 'url'=>'funcoes/getsetor/', 'destinoid'=>'setor')); ?>			
                <?//echo $this->Form->input('obm_id', array('label'=>'Setor','type'=>'select','options' => array('-- Selecione um setor --'), 'id'=>'setor')); ?>
                <?echo $this->Form->input('obm_id', array('label'=>'OBM', 'options' => $obm, 'empty' => '-- Selecione --')); ?>
                <?echo $this->Form->input('num_vagas', array('label'=>'N�mero de vagas', 'class'=>'span1'));?>
                <?echo $this->Form->input('dat_criacao', array('label'=>'Data da cria��o', 'type'=>'date', 'class'=>'span1', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
                <hr>
                <? echo $this->Form->end(array('type' => 'submit', 'class' => 'btn btn-success'));?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn" data-dismiss="modal" aria-hidden="true">Fechar</a>            
    </div>
</div>