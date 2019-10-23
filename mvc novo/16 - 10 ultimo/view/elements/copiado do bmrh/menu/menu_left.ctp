<ul class="nav nav-list">
    <li>
        <a href="#" class="dropdown-toggle" >
             <i class="icon-user"></i>
             <span>Militares</span>
             <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li><a href="<? echo $this->Html->url(array('controller' => 'militares', 'action' => 'pesquisa')); ?>"> Pesquisa</a></li> 
			<li><a href="<? echo $this->Html->url(array('controller' => 'assentamentos', 'action' => 'indexMulti')); ?>"> Assentamentos</a></li>     
            <li><a href="<? echo $this->Html->url(array('controller' => 'ferias', 'action' => 'conceder_ferias')); ?>"> Conceder F�rias</a></li>                        
            <li><a href="<? echo $this->Html->url(array('controller' => 'militares', 'action' => 'add')); ?>"> Incluir</a></li>
			<li><a href="<? echo $this->Html->url(array('controller' => 'militares', 'action' => 'filtro_antiguidade')); ?>"> Ajuste de Antiguidade</a></li>
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
            <li><a href="<? echo $this->Html->url(array('controller' => 'gestao', 'action' => 'mapa_forca')); ?>"> Mapa de For�a</a></li>
            <li><a href="<? echo $this->Html->url(array('controller' => 'gestao', 'action' => 'visao_geral')); ?>"> Vis�o Geral</a></li>
            <li><a href="<? echo $this->Html->url(array('controller' => 'obms', 'action' => 'organograma')); ?>"> Organograma</a></li>
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
