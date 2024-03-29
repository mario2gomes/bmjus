<div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Envio de documentos aos autos do processo</h3>

    <div class="widget-box"> 

        <?php echo $this->Form->create('Processo', ['url' => ['action' => 'upload']]); ?>
        <?php echo $this->Form->input('tipo_processos_id',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "procedimento", 'label'=>'Procedimento','options' => $tipos, 'empty' => '--Selecione--') );?>
        <?php echo 'Data da publica��o de instaura��o', $this->Form->date('data_bgo',array('label'=>'Data do BGO de abertura', 'class' => 'form-control', 'div' => 'form-group','dateFormat'=>'DMY', 'minYear' => date('Y') - 90, 'maxYear' => date('Y') + 16));?>
        <?php echo $this->Form->input('num_processo',array('label'=>'N�mero do processo', 'upper' => 'true', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "N�mero do processo"));?>
        <?php echo $this->Form->input('num_portaria',array('label'=>'N�mero da portaria', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "N�mero da portaria"));?>
        <?php echo $this->Form->input('num_bgo',array('label'=>'N�mero do BGO', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "N�mero do BGO"));?>
        <?php echo $this->Form->input('obm',array( 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "OBM"));?>
        <?php echo $this->Form->input('instaurador',array('label'=>'Autoridade Instauradora', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "Instaurador"));?>
        <?php echo $this->Form->input('encarregado',array('class' => 'form-control', 'div' => 'form-group', 'placeholder' => "encarregado"));?>
        <?php echo $this->Form->input('investigado',array('label'=>'Investigado (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "investigado"));?>
        <?php echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver)', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "escrv�o"));?>
        <?php echo $this->Form->input('descricao',array('type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group', 'placeholder' => "descri��o"));?>
        <?php echo $this->Form->input('documento_fisico',array('type'=>'file', 'class' => 'form-control', 'div' => 'form-group'));?>
        <?php echo $this->Form->end(array('label'=>'Salvar','class'=>'btn btn-sm btn-primary pull-right m-t-n-xs'));?>
        <!-- <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Enviar</strong></button> -->
    </div>
</div>