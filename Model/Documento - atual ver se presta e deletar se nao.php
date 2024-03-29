<?php
class Documento extends AppModel{

    public function initialize(array $config){
        $this->addBehavior('Timestamp');
    }

//public $sequence = 'cor_documentos_seq';

	public $belongsTo = array(
        'Processo' => array(
            'className' => 'Processo',
            'dependent' => true,
            'foreignKey' => 'Processo_id'),        
        'Tipo_documento' => array(
            'className' => 'Tipo_documento',
            'dependent' => true,
            'foreignKey' => 'tipo_documento_id')
	    );

	public $validate = array(
        'tipo_documento_id' => array(
            'rule' => 'notBlank'
        ),
        'usuario_envia_id' => array(
            'rule' => 'notBlank'
        ),
        'nome_arquivo' => array(
            'rule' => 'notBlank'
        ),
        'tipo_arquivo' => array(
            'rule' => 'notBlank'
        ),

        'tipo_arquivo' => array(
            'rule' => array(
            'extension', array('pdf')),
            'message' => 'Envie um arquivo em PDF v�lido'),

        'tamanho_arquivo' => array(
            'rule' => 'notBlank'
        ),
        'tmp_name_arquivo' => array(
            'rule' => 'notBlank'
        ),
        'erro_arquivo' => array(
            'rule' => 'notBlank'
        ),
        'numero_de_ordem' => array(
            'rule' => 'notBlank'
        )
    ); 
}
?>