<!-- File: /app/View/Militares/index.ctp -->
<h1>Relação dos militares</h1>

<button> <?php echo $this->Html->link('Inserir militar', array('controller' => 'users', 'action' => 'novo')); 
    ?> </button>

<table>
    <tr>
        <th>Militar</th> 
        <th>Folgas</th> 
		<th>Folgas gozadas</th> 
		<th>Saldo</th>       
    </tr>
	

    <?php 
    foreach ($users as $user):
    $folgas = $user['User']['extra_count'];
    $gozadas = 0;
    $saldo = $folgas - $gozadas; ?>
    <tr>
		<td><?php echo $user['User']['graduacao'], ' ', $this->Html->link($user['User']['username'],
            array('controller' => 'users', 'action' => 'perfil',
			$user['User']['id'])); ?></td>
        <td><?php echo $folgas,' Folgas'; ?></td>        
        <td><?php echo $gozadas,' folgas'; ?></td>        
        <td><?php echo $saldo,' folgas'; ?></td>        
        <td><button>
		<?php echo $this->Form->postLink('Apagar',
			array('action' => 'apagar', $user['User']['id']),
			array('confirm' => 'Confirma apagar o militar?'));
        ?>
		</button></td>
		
		
    </tr>
    <?php endforeach; ?>


</table>