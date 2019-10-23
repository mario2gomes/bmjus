<ul class="nav nav-list">
    <li>
        <a href="#" class="dropdown-toggle" >
             <i class="icon-book"></i>
             <span>Processos</span>
             <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li> <?php echo $this->Html->link('Listar', array('controller' => 'processos', 'action' => 'lista')); ?></li> 
			<li><a href="<?php echo $this->Html->url(array('controller' => 'processos', 'action' => 'novo')); ?>"> Incluir</a></li>
			</a></li>
        </ul>
    </li> 

    <li>
        <a href="#" class="dropdown-toggle" >
             <i class="icon-book"></i>
             <span>Usu�rio</span>
             <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li><a href="<? echo $this->Html->url(array('controller' => 'militares', 'action' => 'pesquisa')); ?>"> Pesquisa</a></li> 
            <li><a href="<? echo $this->Html->url(array('controller' => 'militares', 'action' => 'add')); ?>"> Incluir</a></li>
            </a></li>
        </ul>
    </li> 
    
    <li>
        <a href="#" class="dropdown-toggle" >
             <i class="icon-signal"></i>
             <span>Gest�o</span>
             <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li><a href="<? echo $this->Html->url(array('controller' => 'funcoes', 'action' => 'gerir')); ?>"> Fun��es</a></li>             
            <li><a href="<? echo $this->Html->url(array('controller' => 'gestao', 'action' => 'visao_geral')); ?>"> Vis�o Geral</a></li>
			<li><a href="<? echo $this->Html->url(array('controller' => 'gestao', 'action' => 'pendencias')); ?>"> Pend�ncias</a></li>
        </ul>
    </li>
    
    <li>
        <a href="#" class="dropdown-toggle" >
             <i class="icon-briefcase"></i>
             <span>Administra��o</span>
             <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li><a href="<? echo $this->Html->url(array('controller' => 'obms', 'action' => 'index')); ?>"> Obms/Setores</a></li> 
            <li><a href="<? echo $this->Html->url(array('controller' => 'log_acessos', 'action' => 'index')); ?>"> Log de Acessos</a></li> 
            <li><a href="<? echo $this->Html->url(array('controller' => 'usuarios', 'action' => 'edit_grupo')); ?>"> Usu�rios</a></li>
        </ul>
    </li>
</ul><!--/.nav-list-->
