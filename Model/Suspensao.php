<?php 
class Suspensao extends AppModel {
    public $tablePrefix = 'cor_';
    public $sequence = 'cor_suspensoes_seq';
    
	public $belongsTo = array(
        'Processo' => array(
            'className' => 'Processo',
            //'dependent' => true,
            'foreignKey' => 'processo_id')
    );

    public $validate = array(
        'motivo' => array(
            'rule' => 'notBlank',
        ),
        'processo_id' => array(
                    'rule' => 'notBlank',
                ),
        'responsavel_legal' => array(
                    'rule' => 'notBlank',
                ),
        'responsavel_funcional' => array(
                    'rule' => 'notBlank',
                ),
        'data_inicio' => array(
                    'rule' => 'notBlank',
                ),
        'bgo' => array(
                    'rule' => 'notBlank',
                ),
    );
} ?>