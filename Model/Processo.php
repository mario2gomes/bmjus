<?php 
class Processo extends AppModel {

	public $belongsTo = array(
        'Situacao' => array(
            'className' => 'Situacao',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Situacoes_id'),        
        'Estado' => array(
            'className' => 'Estado',
            'dependent' => true,
            'foreignKey' => 'Estados_id'),
        'Tipo_processo' => array(
            'className' => 'Tipo_processo',
    		'foreignKey' => 'tipo_processos_id')
            //'dependent' => true)
    );
            
	public $validate = array(
        'num_portaria' => array(
            'rule' => 'notBlank',
            'rule' => 'isUnique',
            'message' =>'Já existe um processo com esse número'
        ),
        'num_bgo' => array(
            'rule' => 'notBlank'
        ),
        'obm' => array(
            'rule' => 'notBlank'
        ),       
        'instaurador' => array(
            'rule' => 'notBlank'
        ),       
        'encarregado' => array(
            'rule' => 'notBlank'
        ),       
        'num_processo' => array(
            'rule' => 'isUnique',
            'message' => 'Já existe um processo com esse número'
        ),  
        'situacoes_id' => array(
            'rule' => 'notBlank'
        ),       
        'data_bgo' => array(
            'rule' => 'notBlank'
        ),       
        'tipo_processos_id' => array(
            'rule' => 'notBlank'
        )       
    );
}
?>