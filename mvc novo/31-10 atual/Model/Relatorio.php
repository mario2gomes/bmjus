<?php 
class Relatorio extends AppModel {

    public $sequence = 'cor_relatorios_seq';
    
	public $belongsTo = array(
        'Situacao' => array(
            'className' => 'Situacao',
            //'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Situacao_id')
    );

    public $hasOne = array(
        'Processo' => array(
            'className' => 'Processo',
            //'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Processo_id')
    );

	public $validate = array(
        'processo_id' => array(
            'rule' => 'notBlank',
        ),
        'situacao_id' => array(
            'rule' => 'notBlank'
        ),       
        'prazo' => array(
            'rule' => 'notBlank'
        )
    );
}
?>