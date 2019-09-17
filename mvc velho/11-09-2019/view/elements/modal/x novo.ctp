<div class="processos form">

	<fieldset>

		<div class="span10">
			<div class="widget-box collapsed">
				<div class="widget-header">
					<h4>Novo Processo</h4>
					<span class="widget-toolbar">
						<a href="#" data-action="collapse"><i class="icon-chevron-up"></i></a>
					</span>
				</div>
				<div class="widget-body"><div class="widget-body-inner" style="display: block;">
				 <div class="widget-main">
					<div class="row-fluid">
							<div class="container">
								<div class="span3">
									<?php
										echo $this->Form->create('Processo', ['url' => ['action' => 'novo']]);
										echo $this->Form->input('num_processo',array('label'=>'Número do processo'));
										echo $this->Form->input('num_portaria',array('label'=>'Número da portaria'));
										echo $this->Form->input('num_bgo',array('label'=>'Número do BGO'));
									?>
								</div>
								<div class="span3">
								Data do BGO:<br>
									<?php
										echo $this->Form->date('data_bgo');	
										echo $this->Form->input('obm');
										echo $this->Form->input('instaurador',array('label'=>'Autoridade Instauradora'));
									?>
								</div>
								<div class="span3">
									<?php
										echo $this->Form->input('encarregado');
										echo 'Procedimento'; ?>
								<br>
									<?php
										echo $this->Form->select('tipo_processos_id', $tipos);
										echo $this->Form->input('investigado',array('label'=>'Investigado (se houver)'));
										echo $this->Form->input('escrivao',array('label'=>'Escrivao (se houver)'));
									?>
								</div>
								<div class="span12">
									<?php
										echo $this->Form->input('descricao',array('type'=>'textarea'));
										echo $this->Form->end('Salvar');
									?>
								</div>
							</div>
						
				 </div>
				</div></div>
			</div>
		  </div>
	</fieldset>
</div>