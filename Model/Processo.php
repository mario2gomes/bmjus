<?php 
class Processo extends AppModel {
    public $sequence = 'cor_processos_seq';
    public $tablePrefix = 'cor_';
	public $belongsTo = array(
        'Situacao' => array(
            'className' => 'Situacao',
            'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'Situacoes_id'),        
        'Estado' => array(
            'className' => 'Estado',
            'dependent' => true,
            'foreignKey' => 'Estados_id'),
        'Posse' => array(
            'className' => 'Grupo',
            'dependent' => true,
            'foreignKey' => 'Posse_id'),
        'Tipo_processo' => array(
            'className' => 'Tipo_processo',
            'dependent' => true,
    		'foreignKey' => 'tipo_processos_id')
    );

    public $hasOne = array(
        'Relatorio' => array(
            'className' => 'Relatorio',
            //'dependent' => true,
            //'type' => 'RIGHT',
            'foreignKey' => 'processo_id')
    );

    public $hasMany = array(
        'Suspensao' => array(
            'className' => 'Suspensao',
            'foreignKey' => 'processo_id'
        ),
        'Solucao' => array(
                    'className' => 'Solucao',
                    'foreignKey' => 'processo_id'
                ),
        'Prorrogacao' => array(
            'className' => 'Prorrogacao',
            'foreignKey' => 'processo_id'
        )
    );
            
	public $validate = array(
        'prorrogacoes' => array(
            'rule' => array('range',-1,3),
            'message' =>'Esse processo já foi prorrogado 2 vezes, portanto não cabem mais prorrogações'
        ),
        'num_bgo' => array(
            'rule' => 'notBlank'
        ),
        'obm' => array(
            'rule' => 'notBlank'
        ),       
        'instaurador' => array(
            'rule' => 'notBlank'
        ),       
        'encarregado' => array(
            'rule' => 'notBlank'
        ),       
        'num_processo' => array(
            'rule' => 'notBlank'
        ),  
        'num_ordem' => array(
            'rule' => 'notBlank'
        ),  
        'ano' => array(
            'rule' => 'notBlank'
        ),  
        'criador_processo_id' => array(
            'rule' => 'notBlank'
        ),  
        'situacoes_id' => array(
            'rule' => 'notBlank'
        ),       
        'data_bgo' => array(
            'rule' => 'notBlank'
        ),
        'resumo' => array(
            'rule' => 'notBlank'
        ),
        'tipo_processos_id' => array(
            'rule' => 'notBlank'
        )       
    ); 
}
?>