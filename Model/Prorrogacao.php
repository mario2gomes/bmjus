<?php 
class Prorrogacao extends AppModel {
    public $tablePrefix = 'cor_';
    public $sequence = 'cor_prorrogacoes_seq';
    
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
        'bgo' => array(
            'rule' => 'notBlank',
        ),
        'qtd_dias' => array(
            'rule' => 'notBlank',
            'rule' => 'naturalNumber',
            'message' => 'Apenas números',
        )
    );
} ?>