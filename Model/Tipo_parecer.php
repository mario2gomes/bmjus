<?php
	class Tipo_parecer extends AppModel {
        public $tablePrefix = 'cor_';
    public $hasMany = array(
    	'parecer' => array(
        'className' => 'parecer',
        'foreignKey' => 'tipo_id')
    );
		
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>