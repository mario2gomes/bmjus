<ul class="nav metismenu" id="side-menu">
	<li class="nav-header">
		<div class="dropdown profile-element">
			<a class="navbar-minimalize" href="#"><h2 class="font-bold"><i class="fa fa-bars"></i> BMJUS</h2></a>
			<ul class="dropdown-menu animated fadeInRight m-t-xs">
				<li><a href="<?= $this->Html->url(array('controller' => 'usuarios', 'action' => 'logout', 'plugin' => false)); ?>">Logout</a></li>
			</ul>
		</div>
		<div class="logo-element">
			<a class="navbar-minimalize" href="#"><i class="fa fa-bars"></i></a>
		</div>
	</li>
	<li class="active">
		<a href="index.html"><i class="fa fa-cogs"></i> <span class="nav-label">Administração</span></a>
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li><a modal_target="modal_edit_perfil_usuario" url="<?= $this->Html->url(array('plugin' => false, 'controller' => 'usuarios', 'action' => 'buscar_usuario')); ?>"><i class="fa fa-users"></i>Perfil de usuários</a></li>
			<li><a modal_target="modal_add_escalante_obm" url="<?= $this->Html->url(array('plugin' => 'escalas', 'controller' => 'gerencia', 'action' => 'add_escalantes_obm')); ?>"><i class="fa fa-users"></i>Editar escalantes</a></li>
		</ul>
	</li>
</ul>
<?= $this->element('modal/padrao', array('options' => array('id' => 'modal_add_escalante_obm', 'titulo' => 'Editar escalantes', 'tamanho' => 'modal-md'))) ?>
<?= $this->element('modal/padrao', array('options' => array('id' => 'modal_edit_perfil_usuario', 'titulo' => 'Perfil de usuários', 'tamanho' => 'modal-md'))) ?>