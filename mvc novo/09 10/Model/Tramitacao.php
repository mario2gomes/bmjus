<?php 
class Tramitacao extends AppModel {

	public $belongsTo = array(
        'Processo' => array(
            'className' => 'Processo',
            //'dependent' => true,
            'foreignKey' => 'Processos_id'),
        'Funcao_recebe' => array(
            'className' => 'Grupo',
            //'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Funcao_recebe_id'),
		'Funcao_entrega' => array(
            'className' => 'Grupo',
            //'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Funcao_entrega_id')
    );

    public $validate = array(
        'funcao_entrega_id' => array(
            'rule' => 'notBlank'
        ),        
        'funcao_recebe_id' => array(
            'rule' => 'notBlank'
        ),
        'processos_id' => array(
            'rule' => 'notBlank',
        ),
    );
} ?>