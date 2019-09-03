<?php 
class Solucao extends AppModel {

	public $belongsTo = array(
        'Situacao' => array(
            'className' => 'Situacao',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Situacoes_id'),
        'Solucao_parecer' => array(
            'className' => 'Solucao_parecer',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Parecer_id')
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
        ),       
    );
}
?>