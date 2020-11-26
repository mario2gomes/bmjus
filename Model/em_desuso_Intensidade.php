<?php
	class em_desuso_Intensidade extends AppModel {
    	
	public $validate = array(
        'descricao' => array(
            'rule' => 'notBlank'
        ),
    );

}
?>