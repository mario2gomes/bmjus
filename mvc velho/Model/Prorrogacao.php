<?php 
class Prorrogacao extends AppModel {

    public $sequence = 'cor_prorrogacoes_seq';
    
	public $belongsTo = array(
        'Relatorio' => array(
            'className' => 'Relatorio',
            //'dependent' => true,
            'foreignKey' => 'Relatorio_id')
    );

    public $validate = array(
        'motivo' => array(
            'rule' => 'notBlank',
        ),
        'relatorio_id' => array(
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
    );
} ?>