<?php 
class Solucao extends AppModel {
    public $tablePrefix = 'cor_';
	public $belongsTo = array(
        'Processo' => array(
            'className' => 'Processo',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Processo_id'),
        'Tipo_solucao' => array(
            'className' => 'Tipo_solucao',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Tipo_id'),        
        'Enquadramento' => array(
            'className' => 'Enquadramento',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Enquadramento_id'),
        'Situacao' => array(
            'className' => 'Situacao',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Situacoes_id'),
        'Parecer' => array(
            'className' => 'Parecer',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Parecer_id')
    );
    
	public $validate = array(
        'processo_id' => array(
            'rule' => 'notBlank',
        ),
        'situacoes_id' => array(
            'rule' => 'notBlank'
        ),       
        'tipo_id' => array(
            'rule' => 'notBlank'
        ),       
        'enquadramento_id' => array(
            'rule' => 'notBlank'
        ),       
        'parecer_id' => array(
            'rule' => 'notBlank'
        ),       
    );
}
?>