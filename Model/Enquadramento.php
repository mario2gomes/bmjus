<?php
	class Enquadramento extends AppModel {
    public $tablePrefix = 'cor_';
    
    public $hasMany = array(
    	'Solucao' => array(
        'className' => 'Solucao',
        'foreignKey' => 'Enquadramento_id')
    );
		
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>