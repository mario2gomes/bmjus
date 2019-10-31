<?php
	class Tipo_processo extends AppModel {

    public $hasMany = array(
    	'Processo' => array(
        'className' => 'Processo',
        'foreignKey' => 'tipo_processos_id')
    );
		
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>