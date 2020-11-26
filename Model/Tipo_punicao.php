<?php
	class Tipo_punicao extends AppModel {
		public $tablePrefix = 'cor_';
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        )
    );
}
?>