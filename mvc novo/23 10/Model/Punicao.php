<?php class Punicao extends AppModel {

    public $hasOne = array(
            'Processo' => array(
            'className' => 'Processo',
            'foreignKey' => 'Punicoes_id',
            'dependent' => true
            //'type' => 'RIGHT'
        )
    );

    public $belongsTo = array(
    	    'Tipo_punicao' => array(
            'className' => 'Tipo_punicao',
            'dependent' => true,
            'type' => 'RIGHT',  
            'foreignKey' => 'Tipo_punicoes_id'
        ),
            'Intensidade' => array(
            'foreignKey' => 'Intensidades_id'
        )
	);

	public $validate = array(
        'qtd_dias' => array(
            'rule' => 'notBlank'
        ),
        'num_bgo' => array(
            'rule' => 'notBlank'
        ),
        'data_inicio' => array(
            'rule' => 'notBlank'
        ),       
        'alteracao' => array(
            'rule' => 'notBlank'
        ),       
        'intensidade' => array(
            'rule' => 'notBlank'
        ),       
        'tipo_punicoes_id' => array(
            'rule' => 'notBlank'
        )       
    );
}
?>