<?php
	class Tipo_processo extends AppModel {
        public $tablePrefix = 'cor_';
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