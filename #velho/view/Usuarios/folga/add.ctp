<!-- File: /app/View/Users/add.ctp -->
<div class="users form">

<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Novo usuário'); ?></legend>
		<h1><b>Graduação</b></h1>
		<?php 
		echo $this->Form->select('graduacao', array(
			'Graduação'=>array('Soldado'=>'Sd','Cabo'=>'Cb', 'Sargento'=>'Sgt','Sub Tenente'=>'ST','Tenente'=>'Ten','Capitao'=>'Cap','Major'=>'Maj','Tenente Coronel'=>'TC','Coronel'=>'Cel')));
		echo $this->Form->input('username',array('label'=>'Nome do usuário'));
		echo $this->Form->input('password',array('label'=>'Senha'));
		echo '<h1><b>Função</b></h1>',$this->Form->select('roles_id', array(1=>'usuário',2=>'oficial',3=>'administrador'));
    	echo $this->Form->end(__('Salvar'));?>
    </fieldset>
</div>