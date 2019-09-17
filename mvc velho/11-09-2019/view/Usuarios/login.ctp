
<div class="middle-box text-center loginscreen animated fadeInDown">
        <!--<h1 class="logo-name">BMJus</h1>-->
    <div>
        <h2>Bem vindo ao BMJus</h2>
		<p>Sistema de Gestão de Correção Disciplinar - BMJus</p>
		<div class="alert alert-info">
			<strong>Use o CPF como login!</strong>
		</div>
        <?php echo $this->Form->create('Usuario', array('url' => array('action' => 'login'), 'class' => 'm-t')); ?>
            <div class="form-group">
                <input class="form-control" name="data[cpf]" id="username" type="text" placeholder="CPF">
            </div>
            <div class="form-group">
                <input class="form-control" name="data[sen_usuario]" id="password" type="password" placeholder="Senha">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
			<a href="http://sistemas.cbm.al.gov.br/sistemas/bmsocial/users/atualizar_senha" target="_blank" class="btn btn-warning full-width m-b">Atualizar senha</a>
        <?php echo $this->Form->end(); ?>
        <p class="m-t"> <small>Suporte e criação de senhas ligar para 3315-2839 - STIC</small> </p>
    </div>
</div>