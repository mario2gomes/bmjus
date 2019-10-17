<ul class="nav navbar-top-links navbar-right">
	<li>
		<strong class="font-bold"><?= $viewMilitar->getCargoNome($user_id); ?></strong>
	</li>
	<li>
		<a href="<?= $this->Html->url(array('controller' => 'usuarios', 'action' => 'logout', 'plugin' => false)); ?>"><i class="fa-quote-left"></i></a>
	</li>
</ul>