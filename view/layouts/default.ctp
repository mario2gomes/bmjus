<?php
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

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
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
        echo $this->Html->css(array(
            'plugins/toastr/toastr.min',
            'plugins/dataTables/dataTables.bootstrap',
            'plugins/dataTables/dataTables.responsive.css', 
            'plugins/dataTables/dataTables.tableTools.min'));
        echo $this->Html->css(array(
            'plugins/iCheck/custom',
            'plugins/colorpicker/bootstrap-colorpicker.min',
            'plugins/cropper/cropper.min',
            'plugins/switchery/switchery',
            'plugins/jasny/jasny-bootstrap.min',
            'plugins/nouslider/jquery.nouislider',
            'plugins/datapicker/datepicker3',
            'plugins/ionRangeSlider/ion.rangeSlider',
            'plugins/ionRangeSlider/ion.rangeSlider.skinFlat',
            'plugins/chosen/chosen',
            ));
        echo $this->Html->css(array('bootstrap.min', 'font-awesome', 'animate', 'style'));//, 'plugins/c3/c3.min'));
        
        //Main Scripts
        echo $this->Html->script(array('jquery-2.1.1', 'bootstrap.min'));
        //Custom Scripts
        echo $this->Html->script(array(
        'inspinia', 
        'plugins/pace/pace.min', 
        'plugins/metisMenu/jquery.metisMenu',
        'plugins/slimscroll/jquery.slimscroll.min', 
        'plugins/toastr/toastr.min', 
        'plugins/chosen/chosen.jquery',
        'tabelaPesquisa'));//,'plugins/bootbox/bootbox.min', 'gatilhos'));
        //scripts para tabelas
        echo $this->Html->script(array(
            'plugins/dataTables/jquery.dataTables', 
            'plugins/dataTables/dataTables.bootstrap',
            'plugins/dataTables/dataTables.responsive',
            'plugins/dataTables/dataTables.tableTools.min',
            'bootstrap-popover'
        ));

        //Flot script
        echo $this->Html->script(array(
            'plugins/flot/jquery.flot',
            'plugins/flot/jquery.flot.tooltip.min',
            'plugins/flot/jquery.flot.spline',
            'plugins/flot/jquery.flot.resize',
            'plugins/flot/jquery.flot.pie'
        ));

        //Peity script (gráficos)
        echo $this->Html->script(array(
            'plugins/peity/jquery.peity.min',
            'plugins/demo/peity-demo'
        ));

        //Gitter script
        echo $this->Html->script(array(
            'plugins/gritter/jquery.gritter.min'
        ));

        //jQuery UI script
        echo $this->Html->script(array(
            'plugins/jquery-ui/jquery-ui.min'
        ));

        //Sparkline script
        echo $this->Html->script(array(
            'plugins/sparkline/jquery.sparkline.min',
            'demo/sparkline-demo'
        ));

        //ChartJS script (gráficos)
        echo $this->Html->script(array(
            'plugins/chartJs/Chart.min'
        ));

        echo $this->Html->script(array(
            'plugins/jsKnob/jquery.knob',
            'plugins/datapicker/bootstrap-datepicker',
            'plugins/nouslider/jquery.nouislider.min',
            'plugins/switchery/switchery',
            'plugins/ionRangeSlider/ion.rangeSlider.min',
            'plugins/iCheck/icheck.min',
            'plugins/metisMenu/jquery.metisMenu',
            'plugins/colorpicker/bootstrap-colorpicker.min',
            'plugins/cropper/cropper.min'
        ));

        //Inclui o chat
        echo $this->element('chat');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>

</head>

<body class="pace-done mini-navbar">

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
                                        <span class="block m-t-xs"> <strong class="font-bold"><?php echo 'Seja bem vindo '.'</br>'.$usuario_atual['cargo_nome']; ?></strong></span>
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
                                <li><?php echo $this->Html->link('Painel estatístico', array('controller' => 'processos', 'action' => 'index')); ?></li>
                                <li ><a>Calendário</a></li>
                            </ul>
                        </li>
                        <li>
                            <a><i class="fa fa-user"></i> <span class="nav-label">Usuários</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="active"><?php echo $this->Html->link('Relação de usuários', array('controller' => 'usuarios', 'action' => 'lista')); ?></li>
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

    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

    </script>
</body>
</html>


