assinatura
	<?php echo $this->Form->create('Documento', array('action'=>'assinar'));?>
		
		<?php
			echo $this->Form->input('seq_documento', array('type'=>'hidden', 'value'=>$documento['Documento']['seq_documento']));
			echo $this->Form->input('cod_encaminhamento', array('type'=>'hidden', 'value'=>1));//COD DE ASSINADO
			echo $this->Form->input('cpf', array('label'=>'CPF'));
			echo $this->Form->input('senha', array('label'=>'Senha', 'type'=>'password'));
//			echo $this->Form->input('cod_funcao_origem', array('type'=>'hidden', 'value'=>$session->read('Funcao.seq_funcao')));
		?>
		
	<?php echo $this->Form->end(array('label' => 'Assinar', 'class'=>'btn btn-primary'));?>