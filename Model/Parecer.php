<?php
	class Parecer extends AppModel {
        public $tablePrefix = 'cor_';
    public $belongsTo=array(
        'tipo_parecer' => array(
            'className' => 'tipo_parecer',
            //'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Tipo_id'),
        'envio' => array(
            'className' => 'envio',
            //'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Envios_id'),
        'processo' => array(
            'className' => 'processo',
            //'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Processo_id'),
    );
		
	public $validate = array(
        'tipo_id' => array(
            'rule' => 'notBlank'
        ),
        'emissor_id' => array(
            'rule' => 'notBlank'
        ),
        'processo_id' => array(
            'rule' => 'notBlank'
        ),
        'envios_id' => array(
            'rule' => 'notBlank'
        ),
        'despacho' => array(
            'rule' => 'notBlank'
        )
    );
}
?>