<?php
    echo $this->element('modal/usuarios/novo_instaurador');
    // Compara se $a é menor que $b
    // Ordem decrescente
    function cmp($a, $b) {
        return $a['Processo']['data_termino'] < $b['Processo']['data_termino'];
    }

?>                   

<div id="wrapper">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Usuários</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="lista.ctp">Usuarios</a>
                </li>
                <li class="active">
                    <strong>Relação de usuários</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <span class="text-muted small pull-right">
                            <?php
                            //Apenas a corregdoria pode adicionar um usuário como autoridade instauradora;
                                if ($usuario_atual['grupo'] == 2){ ?>
                                    <div class="ibox-tools">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#novo_instaurador">Designar Autoridade Instauradora</button>
                                    </div>
                            <?php } ?>
                        </span>
                        <h2>Relação de usuários</h2>
                        <p>
                            Relação de todos militares envolvidos em processos.
                        </p>
                        
                        <div class="clients-list">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Todos usuários</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i> Autoridade instauradora</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-briefcase"></i> Encarregado</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-briefcase"></i> Escrivão</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-briefcase"></i> Investigado</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <?php echo $this->element('Usuarios/tabela_lista', array( "grupo_view" => "todos")); ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <?php
                                            echo $this->element('Usuarios/tabela_lista', array( "grupo_view" => "instaurador"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-3" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <?php
                                            echo $this->element('Usuarios/tabela_lista', array( "grupo_view" => "encarregado"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <?php
                                            echo $this->element('Usuarios/tabela_lista', array( "grupo_view" => "escrivao"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-5" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <?php
                                            echo $this->element('Usuarios/tabela_lista', array( "grupo_view" => "investigado"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="tab-content">
                            <div id='resumo'>
                                <!-- Aqui será renderizada a view com o perfil de cada usuário ou o resumo do processo-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<script>
    $(document).ready(function(){
        $('.usuario-link').click(function(){
            let cpf = $(this).attr('cpf');
            console.log(cpf);
            $.get("<?=$this->Html->url(array('controller'=>'usuarios',  'action'=>'perfil'))?>/"+cpf,function(data){
                $('#resumo').html(data);
            });
        });
    });

    $(document).ready(function(){
        $('.processo-link').click(function(){
            let id_processo = $(this).attr('id_processo');
            console.log(id_processo);
            $.get("<?=$this->Html->url(array('controller'=>'processos',  'action'=>'resumo'))?>/"+id_processo,function(data){
                $('#resumo').html(data);
            });
        });
    });
</script>