<!-- File: /app/View/Users/novo.ctp -->
<div class="users form">

<?php
echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Novo usu�rio'); ?></legend>
		<h1><b>Gradua��o</b></h1>
		<?php 
		echo $this->Form->select('graduacao', array(
			'Gradua��o'=>array('Soldado'=>'Sd','Cabo'=>'Cb', 'Sargento'=>'Sgt','Sub Tenente'=>'ST','Tenente'=>'Ten','Capitao'=>'Cap','Major'=>'Maj','Tenente Coronel'=>'TC','Coronel'=>'Cel')));
		echo $this->Form->input('username',array('label'=>'Nome do usu�rio'));
		echo $this->Form->input('password',array('label'=>'Senha'));


		echo $this->Form->input('roles_id', array('default'=>1,'type'=>'hidden'));
    	echo $this->Form->end(__('Salvar'));?>
    </fieldset>
</div>