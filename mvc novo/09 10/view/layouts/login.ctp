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

        //Custom css
        echo $this->Html->css(array('plugins/toastr/toastr.min'));
        echo $this->Html->css(array('bootstrap.min', 'font-awesome/css/font-awesome', 'animate', 'style'));

        //Main Scripts
        echo $this->Html->script(array('jquery-2.1.1', 'bootstrap.min'));
        
        ?>
    </head>

    <body class="top-navigation">

        <div id="wrapper">
            <div id='page-wrapper' class="gray-bg">
                <div class="wrapper wrapper-content animated fadeInDown">
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
