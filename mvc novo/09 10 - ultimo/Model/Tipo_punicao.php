<?php
	class Tipo_punicao extends AppModel {
		
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>