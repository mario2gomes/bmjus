<?php

App::uses('AppController', 'Controller');

class UsuariosController extends AppController {
    var $components = array('RequestHandler');
	
    public function index() {
        $this->Usuario->recursive = 0;
        $this->set('usuarios', $this->paginate());
    }

    public function perfil() {

        if (!empty($this->data)) {
            if ($this->Usuario->save($this->data)) {
                $this->Session->setFlash('A sua senha foi alterada com sucesso!', 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'perfil'));
            } else {
                $this->Session->setFlash('A sua senha não pôde ser alterada!Tente novamente!');
            }
        }
        if (empty($this->data)) {
            $usuario = $this->Auth->user();
            $this->data = $this->Usuario->read(null, $usuario['Usuario']['id']);
            $this->set('usuario', $this->data);
        }
    }

    public function login() {
/*
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Session->error('Matricula ou senha inválidas! Por favor, tente novamente!');
        }
    }
*/
        $this->set('title_for_layout', 'BMJUS - Login');
        $this->layout = 'login';
		if ($this->request->is('mobile')) {
			$this->layout = 'mobile_publico';
		}
		
        if ($this->request->is('post')) {
            $cpf = $this->request->data['cpf'];
            $pass = $this->request->data['sen_usuario'];

            if ($this->Usuario->autenticar($cpf, $pass)) {
                $user = $this->Usuario->getUsuarioAuth();
                $this->Auth->login($user);
              $this->redirect($this->Auth->redirect());
//            $this->redirect(array('Controller' => 'processos', 'action'=>'lista'));
            } else {

                $this->Session->setFlash('Matricula e senha inválidas! Por favor, tente novamente!', 'Flash/error_animated');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function busca_nome($status_id = null) {
        $this->loadModel('ViewMilitar');
        $texto = utf8_decode($_POST['texto']);
        $texto = mb_strtoupper($texto); //Altera o encode e p??m caixa alta
        //Pesquisa o militar
        $conditions = array('ViewMilitar.nom_guerra LIKE ' => '%' . $texto . '%');
        
        if($status_id){
            $conditions['status_id'] = $status_id;
        }
        
        $militar = $this->ViewMilitar->find('all', array('fields'=>array('id', 'cargo_nome', 'num_telefone', 'num_matricula'), 'conditions' => $conditions, 'order' => 'nom_guerra asc', 'limit' => 30));
        //pr($militar); die();
        //Monta a lista para enviar
        $src = array();

        foreach ($militar as $m) {
            $temp = array();
            $id = $m['ViewMilitar']['id'];
            $temp['id'] = $id;
            $temp['name'] = utf8_encode($m['ViewMilitar']['cargo_nome']) . ' mat. ' . $m['ViewMilitar']['num_matricula'];
            $temp['tel'] = $m['ViewMilitar']['num_telefone'];
            $src[] = $temp;
        }

        $json_response = json_encode($src);
        echo $json_response;

        $this->autoRender = false;
    }
	
	public function busca_nome_por_matricula($status_id = null) {
        $this->loadModel('ViewMilitar');
        $texto = utf8_decode($_POST['texto']);
        $texto = mb_strtoupper($texto); //Altera o encode e p??m caixa alta
        //Pesquisa o militar com status ativo
        $conditions = array('ViewMilitar.num_matricula LIKE ' => $texto . '%', 'ViewMilitar.status_id' => 1);
        
        if($status_id){
            $conditions['status_id'] = $status_id;
        }
        
        $militar = $this->ViewMilitar->find('all', array('fields'=>array('id', 'cargo_nome', 'num_telefone', 'num_matricula'), 'conditions' => $conditions, 'order' => 'nom_guerra asc', 'limit' => 30));
        //pr($militar); die();
        //Monta a lista para enviar
        $src = array();

        foreach ($militar as $m) {
            $temp = array();
            $id = $m['ViewMilitar']['id'];
            $temp['id'] = $id;
            $temp['name'] = utf8_encode($m['ViewMilitar']['cargo_nome']) . ' mat. ' . $m['ViewMilitar']['num_matricula'];
            $temp['tel'] = $m['ViewMilitar']['num_telefone'];
            $src[] = $temp;
        }

        $json_response = json_encode($src);
        echo $json_response;

        $this->autoRender = false;
    }
	
    function buscar_usuario() {
        $this->loadModel('Perfil');
        if ($this->request->is(array('post', 'put'))) {
            $this->loadModel('Usuario');
            $perfis = $this->Perfil->find('list');
            $usuario = $this->Usuario->find('first', array('fields'=>array('mat_usuario', 'grupo_sgo', 'cpf'), 'conditions' => array('mat_usuario' => $this->request->data['Usuario']['mat_busca'])));
            
            if(empty($usuario)){
                $this->Session->setFlash('Usuário não encontrado.', 'Flash/error');
            }
            $this->set(compact('perfis', 'usuario'));
        }
    }

    function edit_perfil() {
        //Faz a alteração
        if ($this->request->is('post')) {
            $this->loadModel('Usuario');
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash('O perfil foi alterado com sucesso!', 'Flash/success');
            } else {
                $this->Session->setFlash('Houve algum erro. Tente novamente', 'Flash/error');
            }
        }
        
        $this->render('buscar_usuario');
    }	

}

?>





<?php
//tirado do app folgas
/*
    class UsersController extends AppController {
    public $helpers = array ('Html','Form','Flash');
    public $components = array('Flash','Acl');

    //funções executadas sem autenticação (add)
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }

    //função de login
    public function login() {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Flash->error('Usuário ou senha inválidos, tente novamente');
        }
    }

    //função de logout
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    //index
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        $this -> loadModel('Extra');
        $this->set('users', $this->User->find('all'));
        $this->set('extras', $this->Extra->find('all'));
    }    

    //exibição do usuários
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        $this->set('user', $this->User->findById($id));
    }


    public function lista() {
        $this->set('users', $this->User->find('all'));
    }

    //adicionar usuário
    public function add() {
        $this->set('userId', $this->Auth->user('id'));
        $this->set('userRolesId', $this->Auth->user('roles_id'));
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Militar adicionado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Ocorreu um erro, por favor tente novamente'));
            }
        }
    }

    //editar usuário
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Dados do militar alterados'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Erro, por favor tente novamente'));
            }
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }    
    
    public function perfil($id = null) {
        $this->set('users', $this->User->findById($id));
    }

    public function novo() {
        if ($this->request->is('Post')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success('Militar adicionado');
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('Militar removido'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Erro, militar não removido'));
        $this->redirect(array('action' => 'index'));
    }

    public function apagar($id) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        if ($this->User->delete($id)) {
            $this->Flash->success('Militar removido');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function criar_aro_grupos() {
    $aro = $this->Acl->Aro;

        //Criação do array com descrição dos grupos
        $groups = array(
            0 => array(
                'alias' => 'administrador'
            ),
            1 => array(
                'alias' => 'oficial'
            ),
            2 => array(
                'alias' => 'militar'
            ),
        );

        // Iteraçao para criação do ARO grupo
        foreach ($groups as $data) {
            // Remember to call create() when saving in loops...
            $aro->create();

            // Save data
            $aro->save($data);
        }

        $this->Flash->success('Grupo de usuários criado');
        $this->redirect(array('action' => 'index'));
        // Other action logic goes here...
    }

    public function class_aro_users() {
        $aro = new Aro();

        // Here are our user records, ready to be linked to new ARO records.
        // This data could come from a model and be modified, but we're using static
        // arrays here for demonstration purposes.

        $users = array(
            0 => array(
                'alias' => 'Mario',
                'parent_id' => 1,
                'model' => 'User'
            ),
            1 => array(
                'alias' => 'Hugo',
                'parent_id' => 2,
                'model' => 'User'
            ),
            2 => array(
                'alias' => 'Jonas',
                'parent_id' => 3,
                'model' => 'User'
            ),
        );

        // Iterate and create AROs (as children)
        foreach ($users as $data) {
            // Remember to call create() when saving in loops...
            $aro->create();

            //Save data
            $aro->save($data);
        }

        $this->Flash->success('Grupo de usuários criado');
        $this->redirect(array('action' => 'index'));

        // Other action logic goes here...
    }
}
*/
?>