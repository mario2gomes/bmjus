<?php
	class Envio extends AppModel {
        public $tablePrefix = 'cor_';
    public $hasMany = array(
    	'parecer' => array(
        'className' => 'parecer',
        'foreignKey' => 'envios_id')
    );
		
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>