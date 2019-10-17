<?php
$usuario['cargo_nome'] = 'Seja bem vindo ten fulano';
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>     
        <?php echo $this->fetch('title'); ?>
    </title>
        <?php
        echo $this->Html->meta('icon');

        //echo $this->Html->css(array('plugins/datepicker/datepicker3'));
        echo $this->Html->css(array('plugins/toastr/toastr.min'));
        echo $this->Html->css(array('plugins/chosen/chosen'));
        echo $this->Html->css(array('bootstrap.min', 'font-awesome', 'animate', 'style'));//, 'plugins/c3/c3.min'));
        ?>
        <?php
        //Main Scripts
        echo $this->Html->script(array('jquery-2.1.1', 'bootstrap.min'));
        //Custom Scripts
        echo $this->Html->script(array('inspinia', 'plugins/pace/pace.min', 'plugins/metisMenu/jquery.metisMenu', 'plugins/slimscroll/jquery.slimscroll.min', 'plugins/toastr/toastr.min', 'plugins/chosen/chosen.jquery','tabelaPesquisa'));//,'plugins/bootbox/bootbox.min', 'gatilhos'));
        //Inclui o chat
        echo $this->element('chat');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
</head>

<body class="pace-done mini-navbar">
    <?php echo $this->element('modal/novo') ?>

        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <img alt="image" class="img-circle" src="user.png" />
                                <a class="navbar-minimalize" href="#"><h2 class="font-bold"><i class="fa fa-bars"></i> BMJUS</h2></a>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear"> 
                                        <span class="block m-t-xs"> <strong class="font-bold"><?= $usuario['cargo_nome'] ?></strong></span>
                                    </span> 
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="<?= $this->Html->url(array('controller' => 'usuarios', 'action' => 'logout', 'plugin' => false)); ?>">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                <a class="navbar-minimalize" href="#"><i class="fa fa-bars"></i>
                                BMJUS
                            </div>
                        </li>
                        <li class="active">
                            <a><i class="fa fa-file-text-o"></i><span class="nav-label">Processos</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="active"><?php echo $this->Html->link('Relação de processos', array('controller' => 'processos', 'action' => 'lista')); ?></li>
                                <li ><a data-toggle="modal" data-target="#novo">Novo processo</a></li>
                                <li ><a>Calendário</a></li>
                            </ul>
                        </li>
                        <li>
                            <a><i class="fa fa-user"></i> <span class="nav-label">Usuários</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="active"><a href="index.html">Relação de usuários</a></li>
                                <li ><a href="dashboard_3.html">Novo usuário</a></li>
                                <li ><a href="dashboard_4_1.html">---</a></li>
                            </ul>
                        </li>
                        <li>
                            <a><i class="fa fa-book"></i> <span class="nav-label">Downloads</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="active"><?php echo $this->Html->link('Modelos de documentos', array('controller' => 'arquivos', 'action' => 'lista')); ?></li>
                                <li ><?php echo $this->Html->link('Cartilhas', array('controller' => 'arquivos', 'action' => 'lista')); ?></li>
                                <li ><a href="dashboard_4_1.html">---</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span> <span class="label label-primary pull-right">NEW</span></a>
                        </li>
                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header col-xs-10">
                            <span class="text-black">
                                <h2><b>SISTEMA DE CORREGEDORIA</b></h2>
                            </span>
                            
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="<?= $this->Html->url(array('controller' => 'usuarios', 'action' => 'logout', 'plugin' => false)); ?>">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <?php echo $this->Session->flash('auth'); ?>
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>
                <div class="footer">
                    <div class="pull-right">
                        Desenvolvido por STIC - CBMAL
                    </div>
                    <div>
                        Corpo de Bombeiros Militar de Alagoas - <?= date('Y'); ?>
                    </div>
                </div>

            </div>
        </div>

        <?php echo $this->element('sql_dump'); ?>
</body>
</html>