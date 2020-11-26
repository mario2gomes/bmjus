<!-- File: /app/View/Users/login.ctp -->

<div class="users form">
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Por favor insira usuário e senha'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login'));?>

<button><?php echo $this->Html->link("Cadastrar", array('action' => 'add')); ?></button></p>

</div>