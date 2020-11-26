<?php
App::uses('AppModel', 'Model');
App::uses('ViewMilitar', 'Model');
App::uses('UsuariosGrupo','Model');

class Usuario extends AppModel {
    
	public $name = 'Usuario';
	public $useDbConfig = 'seg';
	public $useTable = 'cad_usuario';
	public $primaryKey = 'cpf';
	public $tablePrefix = 'seg_';
//	descomentar a linha abaixo pra ativar o ACL
	public $actsAs = array('Acl' => array('type' => 'requester'/*, 'enabled' => false*/));
	//Dados do Usuário Autenticado
	public $userData = null;
	
	//impedir permissões de usuário, aceitar apenas de grupo
/*	public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));
	public function bindNode($user) {
		return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}
*/
    public $belongsTo = array(
    	'Grupo'=>array(
    		'classname'=>'Grupo',
    		'foreignKey'=>'grupo_bmjus')
    );

	public $hasOne = array(
    	'ViewMilitar'=>array(
    		'classname'=>'ViewMilitar',
    		'foreignKey'=>'num_cpf')
    );

//	Funções do acl (descomentar as 2 próximas função pra ativar o ACL)
	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		if (isset($this->data['Usuario']['grupo_bmjus'])) {
			$groupId = $this->data['Usuario']['grupo_bmjus'];
		} else {
			$groupId = $this->field('grupo_bmjus');
		}
		if (!$groupId) {
			return null;
		}
		return array('Grupo' => array('id' => $groupId));
	}
        
	public function bindNode($user) {
		return array('model' => 'Grupo', 'foreign_key' => $user['Usuario']['grupo_bmjus']);
	}
        
	public function autenticar($cpf, $pass){
		
	   
		$password = $this->hashPassword($pass);  
   
		//$valor1 = $this->find('count', array('conditions'=>array('mat_usuario'=>$mat, 'sen_usuario'=>$password )));    
		$valor1 = $this->find('first', array('conditions'=>array('cpf'=>$cpf, 'sen_usuario'=>$password )));    

		if (!empty($valor1)){                  

			$ViewMilitar = new ViewMilitar();                
			$militar = $ViewMilitar->getPessoa($valor1['Usuario']['cpf']);
			//$user = $this->read(null, $mat);
			$user = array_merge($militar, $valor1['Usuario']);
			$this->userData = $user;
			return true;
			
		} else {
			
			return false;
		}          
	}
        
	public function hashPassword($pass){
		$salt = Configure::read('Security.salt');
		$password = md5($salt.$pass);

/*		$password = md5($pass);
		//Adaptação para o banco de dados legado
		$password = substr($password, 0, -2);
	*/	
		return $password;
		
	}
        
	public function getUsuarioAuth(){
		
		return  $this->userData;
	}
    	
    public $validate = array(
        'grupo_bmjus' => array(
            'rule' => 'notBlank',
        ),
        'cpf' => array(
            'rule' => 'notBlank',
        )
    );
    
	
}
?>