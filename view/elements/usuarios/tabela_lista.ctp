<!--dataTables-example: tabela dinâmica moldável javascript-->

<table class="table table-hover table-mail table-striped dataTables-example">
    <thead>
        <?php
            if (strcmp($grupo_view,'todos')) {
                $G = array($grupo_view);
                //$como = " como ".$grupo_view;
            }else{
                $G = array('encarregado','instaurador','escrivao');
                //$como = "";
            } ?>
        <tr>
            <th></th>
            <th></th>
            <th>Usuário</th>
            <th>Matrícula</th>
            <th>OBM</th>
            <th>Função atual</th>
            <th>Último processo</th>
            <th>Processos conclusos</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $i = 0;
    foreach ($usuarios as $usuario){
        //define se existem processos em que o usuário atuou no grupo especificado
        if (strcmp($grupo_view,'todos')==0 || $this-> Estatistica-> ultimoEntregue($usuario['Usuario']['cpf'],$grupo_view)){
            $i = $i +1;
        ?>
    <tr>
        <td> <?php echo $i ?></td>
        <td class="client-avatar">
            <a> 
                <?php//echo $this->Html->image('a2.jpg', array('alt' => 'CakePHP'));?>
                <img src="<?php echo $this->Html->url(array("controller" => "usuarios", "action" => "foto", $usuario['ViewMilitar']['num_matricula'])); ?>">
            </a>
        </td>
        <td>
            <a cpf="<?php echo $usuario['Usuario']['cpf'];?>" class="client-link usuario-link"><?php 
            echo $usuario['ViewMilitar']['cargo_nome']; ?></a>
        </td>
        <td><?php echo $usuario['ViewMilitar']['num_matricula']?></td>
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
                    $ultimo_processo = $ultimo[0];
                    $situacao = $ultimo[1];
                    if(strcmp($situacao,'ativo') == 0){
                        break;
                    }elseif(strcmp($situacao,'concluso') == 0){
                        $ultimos_processos[] = $ultimo_processo;
                    }else{
                        continue;
                    }
                }
                if(strcmp($situacao,'concluso') == 0){

                    //ordena o array de acordo com a função cmp
                    usort($ultimos_processos, 'cmp');
                    //pega o último processo do array ordenado pela data de término
                    $ultimo_processo = $ultimos_processos[0];
                    //echo $this-> Formatacao ->data($ultimo_processo);
                }
                if(gettype($situacao) == 'string'){

                    $ultimo_processo_exibicao = $ultimo_processo['Tipo_processo']['descricao'].' '.$ultimo_processo['Processo']['num_processo'].' '.$ultimo_processo['Processo']['obm'];
                    ?>
                    <a id_processo="<?php echo $ultimo_processo['Processo']['id']; ?>"class="client-link processo-link">
                    <?php
                    echo $ultimo_processo_exibicao;
                    ?>
                    </a>
                <?php
                    echo '</br>'.' (processo '.$situacao.')'.'</br>'.$this-> Formatacao ->data($ultimo_processo['Processo']['data_termino']);
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