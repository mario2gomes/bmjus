<?php
	class Situacao extends AppModel {

    public $hasMany = array(
    	'Processo' => array(
        'className' => 'Processo',
        'foreignKey' => 'Situacoes_id',
        'dependent' => true)
        //'type' => 'RIGHT')
    );

	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        ),
    );
}
?>