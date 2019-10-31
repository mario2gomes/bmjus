<!-- File: /app/View/Users/novo.ctp -->
<div class="users form">

<?php
echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Novo usuário'); ?></legend>
		<h1><b>Graduação</b></h1>
		<?php 
		echo $this->Form->select('graduacao', array(
			'Graduação'=>array('Soldado'=>'Sd','Cabo'=>'Cb', 'Sargento'=>'Sgt','Sub Tenente'=>'ST','Tenente'=>'Ten','Capitao'=>'Cap','Major'=>'Maj','Tenente Coronel'=>'TC','Coronel'=>'Cel')));
		echo $this->Form->input('username',array('label'=>'Nome do usuário'));
		echo $this->Form->input('password',array('label'=>'Senha'));


		echo $this->Form->input('roles_id', array('default'=>1,'type'=>'hidden'));
    	echo $this->Form->end(__('Salvar'));?>
    </fieldset>
</div>