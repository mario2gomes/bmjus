<?php
	class Intensidade extends AppModel {
    	
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        ),
    );

}
?>