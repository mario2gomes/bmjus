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
                $this->Session->setFlash('A sua senha nуo pєde ser alterada!Tente novamente!');
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
            $this->Session->error('Matricula ou senha invсlidas! Por favor, tente novamente!');
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

                $this->Session->setFlash('Matricula e senha invсlidas! Por favor, tente novamente!', 'Flash/error_animated');
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
                $this->Session->setFlash('Usuсrio nуo encontrado.', 'Flash/error');
            }
            $this->set(compact('perfis', 'usuario'));
        }
    }

    function edit_perfil() {
        //Faz a alteraчуo
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