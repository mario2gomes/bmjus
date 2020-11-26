<!-- File: /app/View/Processos/editar.ctp -->
<div class="processos form">

	<fieldset>
	<legend><?php echo ('Editar processo'); ?></legend>
	<div class="span3">
		<div class="widget-header">
			<h4>Editar processo</h4>
		</div>
		<div class="eidget-body"><div class="widget-body-inner" style="display: block;">
			<div class="widget-main">
				<div class="row-fluid">
					<div class="container">
						<div class="span3">
							<?php
								echo $this->Form->create('Processo', ['url' => ['action' => 'editar']]);
								echo $this->Form->input('num_processo',array('label'=>'Número do processo'));
								echo $this->Form->input('num_portaria',array('label'=>'Número da portaria'));
								echo $this->Form->input('num_bgo',array('label'=>'Número do BGO'));
							?>
						</div>
						<div class="span3">
							<?php	
								//echo 'Data do BGO:', <br>
								echo $this->Form->date('data_bgo', array('value'=>$processo['Processo']['data_bgo'], 'type'=>'hidden'));
								echo $this->Form->input('obm');
								echo $this->Form->input('instaurador',array('label'=>'Autoridade Instauradora'));
							?>
						</div>
						<div class="span3">
							<?php
								echo $this->Form->input('encarregado');
								//echo 'Procedimento'; ?>
						<br>
							<?php
//								echo $this->Form->select('tipo_processos_id', $tipos);
								echo $this->Form->input('tipo_processos_id', array('value'=>$processo['Processo']['tipo_processos_id'],'type'=>'hidden'));
								echo $this->Form->input('investigado',array('label'=>'Investigado (se houver)'));
								echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver)'));
							?>
						</div>
						<div class="span12">
							<?php
								echo $this->Form->input('descricao',array('type'=>'textarea'));
								echo $this->Form->end('Editar');
							?>
						</div>
					</div>
				</div>
			</div>
	</fieldset>
</div>