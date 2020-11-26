<?php echo $this->element('modal/usuarios/novo_instaurador') ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Rela��o de usu�rios</h2>
        <ol class="breadcrumb">
            <li>
                <a>Usu�rios</a>
            </li>
            <li class="active">
                <strong>lista</strong>
            </li>
        </ol>
    </div>
</div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                                    <h5>Usu�rios</h5>
<!--                                    
<select class="grupo_usuario">
    <option value="1">Encerregado</option>
    <option value="2">Instaurador</option>
    <option value="3">Escriv�o</option>
    <option value="4">Investigado</option>
    <option value="5">Todos</option>

</select>
<script type="text/javascript">
    //var grupo_usuario = 'jj';
    $('.grupo_usuario').on('change', function () {
        var grupo_usuario = $("option:selected", this).text();
        //$('.grupoPadrao').val(grupo_usuario);
        <?php
//$grupo_view = "<script>document.write(grupo_usuario)</script>";
        ?>
    });    
</script>
-->


                            <?php
//echo $grupo_view;
                                //Apenas a corregdoria pode adicionar um usu�rio como autoridade instauradora;
                                if ($usuario_atual['grupo'] == 2){ ?>
                                    <div class="ibox-tools">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#novo_instaurador">Designar Autoridade Instauradora</button>
                                    </div>
                            <?php } ?>
                        </div>
                        <div class="ibox-content">    
                            <div class="project-list">
                                <!--dataTables-example: tabela dinâmica mold�vel javascript-->
                                <table class="table table-hover table-mail table-striped dataTables-example">
                                    <thead>
                                        <?php
                                            if (strcmp($grupo_view,'ㅤ')) {
                                                $G = array($grupo_view);
                                                $como = " como ".$grupo_view;
                                            }else{
                                                $G = array('encarregado','instaurador','escrivao');
                                                $como = "";
                                            } ?>
                                        <tr>
                                            <th></th>
                                            <th>Usu�rio</th>
                                            <th>CPF</th>
                                            <th>OBM</th>
                                            <th>Fun��o atual</th>
                                            <th>Último processo<?php echo $como; ?></th>
                                            <th>Quantidade de processos conclusos<?php echo $como; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $i = 0;
                                    foreach ($usuarios as $usuario){ 
                                        //define se existem processos em que o usu�rio atuou no grupo especificado
                                        if (strcmp($grupo_view,'ㅤ')==0 || $this-> Estatistica-> ultimoEntregue($usuario['ViewMilitar']['num_cpf'],$grupo_view)){
                                            $i = $i +1;
                                        ?>
                                    <tr>
                                        <td> <?php echo $i ?></td>
<!--
<td class="project-title">
<a><?php //echo $processo['Tipo_processo']['descricao'], ' ', $this->Html->link($numero, array('controller' => 'processos', 'action' => 'detalhe', $processo['Processo']['id'])),' ', $processo['Processo']['obm']; ?></a>
<br/>
<small>Aberto em: <?php //echo $this-> Formatacao ->data($processo['Processo']['data_bgo']);?></small>
<td>
-->
                                        <td>
                                            <a><?php echo $this->Html->link($usuario['ViewMilitar']['cargo_nome'], array('controller' => 'usuarios', 'action' => 'detalhe', $usuario['Usuario']['cpf'])); ?></a>
                                        </td>
                                        </td>
                                        <td><?php echo $usuario['ViewMilitar']['num_cpf']?></td>
                                        <td>
                                            <?php echo $usuario['ViewMilitar']['sig_obm'];?>
                                        </td>
                                        <td>
                                            <?php echo $usuario['Grupo']['dsc_grupo']; ?>
                                        </td>
                                        <td>
                                            <?php
                                                $datas=array(null);
                                                $ultimo=null;
                                                foreach ($G as $g) {
                                                    $ultimo = $this-> Estatistica-> ultimoEntregue($usuario['ViewMilitar']['num_cpf'],$g);
                                                    if(strlen($ultimo) > 11){
                                                        break;
                                                    }elseif($ultimo != 0){
                                                        $datas[] = $ultimo;
                                                    }else{
                                                        continue;
                                                    }
                                                }
                                                if(strlen($ultimo) < 11){
                                                    $ultimo = max(array_map('strtotime', $datas));
                                                    echo $this-> Formatacao ->data($ultimo);
                                                }else{
                                                    echo $ultimo;
                                                } ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $soma = 0;
                                                foreach ($G as $g) {
                                                    $soma = $soma + $this-> Estatistica-> quantidadeProcessos($usuario['ViewMilitar']['num_cpf'],$g);
                                                }
                                                echo $soma ?>
                                        </td>
                                    </tr>
                                <?php }else{
                                    continue;
                                }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>