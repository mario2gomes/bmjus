<?php

App::uses('AppController', 'Controller');

class UsuariosController extends AppController {
    public $helpers = array ('Html','Form','Flash','Estatistica');
    public $components = array('Flash','Acl');

    //função de login
/*  public function login() {

        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Session->error('Login ou senha inválidas! Por favor, tente novamente!');
        }
    }

    //função de logout
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    //index: 
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        $this -> loadModel('Extra');
        $this->set('users', $this->User->find('all'));
        $this->set('extras', $this->Extra->find('all'));
    }    
*/
    public function lista() {
        $this->set('usuarios', $this-> Usuario-> find('all', array('conditions'=>array('Usuario.grupo_bmjus !='=>0))));
        //Militares que podem ser encarregados
        //$this->set('usuarios_encarregados', $this-> Usuario-> find('all', array('conditions'=>array('ViewMilitar.quadro_id'=>array(111,121,131,141,151,161,122,123),'ViewMilitar.status_id'=>1))));
        //$this->set('usuarios', $this-> Usuario-> find('all', array('conditions'=>array('Usuario.grupo_bmjus !='=>0))));
        //$this->set('usuarios', $this-> Usuario-> find('all', array('conditions'=>array('Usuario.grupo_bmjus !='=>0))));
        //$this->set('nomes', $this-> Usuario-> find('list', array('fields' => 'nome')));

    }

    public function perfil($cpf=null){
        $this->layout = 'ajax';
        $this->set(compact('cpf'));
    }

    function detalhe($cpf = null) {
        $processo = $this->Processo->find('all');
        $this-> set ('processo', $processo);
        if ($this->request->is('get')){
            $this->request->data = $this->Usuario->findByCpf($cpf);
            $this->set('usuario', $this->Usuario->findByCpf($cpf));
        }
    }

    //Designação de autoridade instauradora (reduzir pra uma só função de designação com todos as funções por variável)
    public function novo_instaurador(){
        if ($this-> request->is('post')) {
            $this-> Usuario-> id= $this->request->data['Usuario']['cpf'];
            if($this-> Usuario->saveField('grupo_bmjus',4)){
                $this-> Flash-> success('Autoridade designada');
                $this-> redirect(array('action'=>'lista','ã…¤'));
            }
            else{
                $this-> Flash-> error('Erro na designaçãoo');
                $this-> redirect(array('action'=>'lista','ã…¤'));
            }
        }
    }

    //Designação de escrivão
    public function novo_escrivao(){
        if ($this-> request->is('post')) {
            $this-> Usuario-> id= $this->request->data['Usuario']['cpf'];
            $id = $this->request->data['Usuario']['id'];
            $this-> Processo-> id = $id;
            if($this-> Processo-> saveField('escrivao',$this->request->data['Usuario']['cpf'])){
                $this-> Flash-> success('Escrivão designado');
                $this-> redirect(array('controller'=>'processos','action'=>'detalhe',$id));
            }
            else{
                $this-> Flash-> error('Erro na designaçãoo');
                $this-> redirect(array('controller'=>'processos','action'=>'detalhe',$id));
            }
        }
    }

    //Designação de escrivão
    public function novo_encarregado(){
        if ($this-> request->is('post')) {
            $this-> Usuario-> id= $this->request->data['Usuario']['cpf'];
            $id = $this->request->data['Usuario']['id'];
            $this-> Processo-> id = $id;
            if($this-> Processo-> saveField('encarregado',$this->request->data['Usuario']['cpf'])){
                $this-> Flash-> success('Encarregado substituÃ­do');
                $this-> redirect(array('controller'=>'processos','action'=>'detalhe',$id));
            }
            else{
                $this-> Flash-> error('Erro na substituição');
                $this-> redirect(array('controller'=>'processos','action'=>'detalhe',$id));
            }
        }
    }

    function busca($oficial=null){
        if($oficial==1){
            $quadro = array(111,121,131,141,151,161,122,123);
        }else{
            $quadro = array(111,121,131,141,151,161,122,123,211,221,231,241,555);
        }

        $texto = utf8_decode($_POST['texto']);
            $texto = mb_strtoupper($texto);//Altera o encode e põe em caixa alta
            
            //Pesquisa o militar
            $this->ViewMilitar->recursive = -1;
            $militar = $this->ViewMilitar->find('all', array('conditions'=>array('ViewMilitar.nom_guerra LIKE '=> '%'.$texto.'%','ViewMilitar.status_id'=>1,"ViewMilitar.quadro_id"=>$quadro), 'order'=>array('nom_guerra')));

            //Monta a lista para enviar
            $src = array();     

            foreach($militar as $mil){
                    $temp = array();
                    $mat = substr($mil['ViewMilitar']['num_matricula'], 0, strlen($mil['ViewMilitar']['num_matricula'])-1) .'-'.substr($mil['ViewMilitar']['num_matricula'], strlen($mil['ViewMilitar']['num_matricula'])-1);
                    $temp['id'] = $mil['ViewMilitar']['num_cpf'];                    
                    $temp['name'] = utf8_encode($mil['ViewMilitar']['cargo_nome']) .' mat. '.$mat;
                    $src[] = $temp;
            }

            $json_response = json_encode($src);
            echo $json_response;

            $this->autoRender = false;
        }

    


//encarregados são designados pela autoridade (na abertura do processo)

//escrivães são designados pelo encarregado a qualquer momento

//invetigados sao incluÃ­dos na citação


//>>>>>>>>>>>>>>>>>>>>>>>>

    //exibição do usuários
/*    public function perfil($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        $this->set('user', $this->User->findById($id));
    }
*/
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


}

/*
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
                $this->Session->setFlash('A sua senha não pÃ´de ser alterada!Tente novamente!');
            }
        }
        if (empty($this->data)) {
            $usuario = $this->Auth->user();
            $this->data = $this->Usuario->read(null, $usuario['Usuario']['id']);
            $this->set('usuario', $this->data);
        }
    }

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

    //funções executadas sem autenticação (add)
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
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