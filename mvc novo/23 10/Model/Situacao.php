<?php
	class Situacao extends AppModel {

    public $hasMany = array(
    	'Processo' => array(
            'className' => 'Processo',
            'foreignKey' => 'Situacoes_id',
            'dependent' => true),
        'Relatorio' => array(
            'className' => 'Relatorio',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Situacao_id'),
    );

	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        ),
    );
}
?>