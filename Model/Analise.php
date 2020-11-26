<?php 
class Analise extends AppModel {
    public $tablePrefix = 'cor_';

	public $belongsTo = array(
        'Situacao' => array(
            'className' => 'Situacao',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Situacoes_id')
    );

    public $hasOne = array(
        'Processo' => array(
            'className' => 'Processo',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Processo_id')
    );

	public $validate = array(
        'processo_id' => array(
            'rule' => 'notBlank',
        ),
        'situacoes_id' => array(
            'rule' => 'notBlank'
        )
    );
}
?>