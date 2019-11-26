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
            <a><?php 
                echo $this->Html->image('a2.jpg', array('alt' => 'CakePHP'));
                ?>
            </a>
        </td>
        <td>
            <a cpf="<?php echo $usuario['Usuario']['cpf'];?>" class="client-link"><?php 
            echo $usuario['ViewMilitar']['cargo_nome']; ?></a>
        </td>
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
