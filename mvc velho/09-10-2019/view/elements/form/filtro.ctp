<div class="filtro form">    
    <div id="form_filtro" class="row-fluid">        
        <? echo $this->Form->create('Assentamento', array('controller' => 'assentamentos', 'action' => 'index'));?>            
            <?echo $this->Form->input('cod_assunto', array('label'=>'Assunto', 'options'=>$assunto, 'empty'=>'-- Selecione --', 'class'=>'span10', 'ajax'=>'true', 'url'=>'assentamentos/gettipoassunto/', 'destinoid'=>'tipoassunto'));?>
            <?echo $this->Form->input('cod_tipoassunto', array('label'=>'Tipo do Assunto', 'type'=>'select', 'options'=>array('-- Selecione um assunto --'), 'class'=>'span10', 'id'=>'tipoassunto'));?>  
            <?echo $this->Form->input('num_boletim', array('label'=>'Nº do BGO', 'class'=>'span3'));?>
            <?echo $this->Form->input('dat_boletim', array('label'=>'Data do BGO', 'class'=>'span3', 'empty'=>' --- ', 'dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y')));?>            
            <?echo $this->Form->input('dsc_processo', array('label'=>'Parte do assentamento', 'class'=>'span12'));?>
            <hr>                       
        <? echo $this->Form->end(array('label'=>'Pesquisar', 'class'=>'btn btn-small btn-success'));?>
    </div>
</div>