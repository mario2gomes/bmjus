<?php
    //uso do componente auth para autentica��o
    App::uses('AuthComponent', 'Controller/Component');
	class User extends AppModel {

    public $hasMany = array(
        'Extras' => array(
            'className' => 'Extras',
            'foreignKey' => 'users_id',
            'dependent' => true)
    );

    public $belongsTo = array(
        'Roles' => array(
            'className' => 'Roles',
            'foreignKey' => 'roles_id',
            'dependent' => true)
    );
		
	public $validate = array(
        'graduacao' => array(
            'rule' => 'notBlank'
        ),
        'username' => array(
            'required'=> array (
                'rule' => array('notBlank'),
                'message' => 'Preencha o nome do usu�rio'
            )
        ),
        'password' => array(
            'required'=> array (
                'rule' => array('notBlank'),
                'message' => 'Escolha uma senha'
            )
        ),
        'role' => array(
            'valid'=> array (
                'rule' => array('inList', array(1,2,3)),
                'message' => 'Fun��o inv�lida',
                'allowEmpty' => false
            )
        )
    );

    //fun��o de encripta��o da senha
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }}
?>