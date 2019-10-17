<?php
	class Tipo_documento extends AppModel {

    public $hasMany = array(
    	'Documento' => array(
        'className' => 'Documento',
        'foreignKey' => 'tipo_documento_id')
    );
		
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>