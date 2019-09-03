<?php 
class Prorrogacao extends AppModel {

	public $belongsTo = array(
        'Relatorio' => array(
            'className' => 'Relatorio',
            //'dependent' => true,
            'foreignKey' => 'Relatorio_id')
    );

    public $validate = array(
        'relatorio_id' => array(
            'rule' => 'notBlank',
        ),
    );
} ?>