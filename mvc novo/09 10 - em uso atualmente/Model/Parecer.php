<?php
	class Pareceres extends AppModel {

    public $hasMany = array(
    	'Solucao' => array(
        'className' => 'Solucao',
        'foreignKey' => 'parecer_id')
    );
		
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>