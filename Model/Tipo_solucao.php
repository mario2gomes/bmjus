<?php
	class Tipo_solucao extends AppModel {
        public $tablePrefix = 'cor_';
    public $hasMany = array(
    	'Solucao' => array(
        'className' => 'Solucao',
        'foreignKey' => 'tipo_id')
    );
		
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>