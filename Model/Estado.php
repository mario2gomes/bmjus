<?php
	class Estado extends AppModel {
        public $tablePrefix = 'cor_';
    public $hasMany = array(
    	'Processo' => array(
        'className' => 'Processo',
        'foreignKey' => 'Estados_id',
        'dependent' => true,
        'type' => 'RIGHT')
    );

	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        ),
    );
}
?>