<div class="tab-pane">
    <div class="row m-b-lg">

        <div class="col-lg-4 text-center">
            <h2><?php echo $usuario['ViewMilitar']['cargo_nome'] ?></h2>

            <div class="m-b-sm">
                <a>
                    <?php //echo $this->Html->image('a3.jpg', array('alt' => 'CakePHP', 'class' =>'img-circle'));//, 'style' => 'width: 62px'));?>
                    <img class ="img-circle" title="Adicionar / Alterar Foto" src="<?php echo $this->Html->url(array("controller" => "usuarios", "action" => "foto", $usuario['ViewMilitar']['num_matricula'])); ?>" style="width: 120px">

                </a>

            </div>
        </div>
        <div class="col-lg-8">
            <p>
                <div class="full-height-scroll">
                <ul class="list-group clear-list">
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> <?php $usuario['ViewMilitar']['num_matricula']?> </span>
                            Matrícula
                        </li>
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> <?php $usuario['Usuario']['grupo_bmjus']?> </span>
                            Matrícula
                        </li>
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> <?php $usuario['ViewMilitar']['dsc_comportamento']?> </span>
                            Matrícula
                        </li>
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> <?php $usuario['ViewMilitar']['num_matricula']?> </span>
                            Matrícula
                        </li>
                    </ul>
                </div>
            </p>
            <button type="button" class="btn btn-primary btn-sm btn-block"><i
                    class="fa fa-envelope"></i> Send Message
            </button>
        </div>
    </div>
    <div class="client-detail">
        <div class="full-height-scroll">

            <strong>Dados do usuário</strong>

            <ul class="list-group clear-list">
                <li class="list-group-item fist-item">
                    <span class="pull-right"> <?php $usuario['ViewMilitar']['num_matricula']?> </span>
                    Matrícula
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $usuario['ViewMilitar']['dsc_obm']?> </span>
                    Lotação
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $usuario['ViewMilitar']['dsc_funcao']?> </span>
                    Função
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $usuario['ViewMilitar']['num_telefone']?> </span>
                    Telefone
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <?php echo $usuario['ViewMilitar']['email'] ?> </span>
                    E-Mail
                </li>
            </ul>
            <strong>Notes</strong>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <hr>
            <strong>Timeline activity</strong>
            <div id="vertical-timeline" class="vertical-container dark-timeline">

<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->            
            <?php if(0){ ?>
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon gray-bg">
                        <i class="fa fa-coffee"></i>
                    </div>
                    <div class="vertical-timeline-content">
                        <p>Conference on the sales results for the previous year.
                        </p>
                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                    </div>
                </div>
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon gray-bg">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="vertical-timeline-content">
                        <p>Many desktop publishing packages and web page editors now use Lorem.
                        </p>
                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                    </div>
                </div>
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon gray-bg">
                        <i class="fa fa-bolt"></i>
                    </div>
                    <div class="vertical-timeline-content">
                        <p>There are many variations of passages of Lorem Ipsum available.
                        </p>
                        <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                    </div>
                </div>
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon navy-bg">
                        <i class="fa fa-warning"></i>
                    </div>
                    <div class="vertical-timeline-content">
                        <p>The generated Lorem Ipsum is therefore.
                        </p>
                        <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                    </div>
                </div>
            <?php } ?>
            </div>
            
        </div>
    </div>
</div>