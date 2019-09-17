<?php 
class ProcessosController extends AppController {
    public $helpers = array ('Html','Form', 'Flash', 'CakePtbr.Formatacao');
    public $components = array('Flash');

    function beforeFilter(){

    }

    function index(){
        $this->set('title_for_layout', 'Corregedoria');           
    }
	
	function lista() {
        $this->loadModel('Tipo_processo');
        $tipo = $this-> Tipo_processo -> find('list',array('fields' => array('Tipo_processo.descricao')));
        $this->set('tipos', $tipo);

		$this->loadModel('Punicao');
        $this -> set('processos', $this -> Processo -> find('all'));
        $this->set('punicoes', $this-> Punicao ->find('all'));
		
//        $this->loadModel('Usuario');
//        $Usuario = $this-> Usuario -> find('list',array('fields' => array('Usuario.grupo_bmjus')));
        $Usuario = 1;
		$this->set('usuarios',$Usuario);
        $this->loadModel('Grupo');
//        $Grupo = $this-> Grupo -> find('list',array('fields' => array('Grupo.Dsc_grupo')));
        $Grupo = 2 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado
        $this->set('grupos',$Grupo);
    }

    function detalhe($id = null) {
    	$this->loadModel('Tramitacao');
		$tramitacao = $this-> Tramitacao -> find('all');
		$this -> set ('tramitacoes', $tramitacao);

        $this->loadModel('Grupo');
        $funcoes = $this -> Grupo -> find('list', array('fields'=>array('Grupo.dsc_grupo')));
        $this->set('funcoes', $funcoes);
    	
        $Usuario = 'b';
        $this->set('usuarios',$Usuario);
        $Grupo = 3 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado
        $this->set('grupos',$Grupo);

    	$processo = $this->Processo->find('all');
		$this-> set ('processo', $processo);
    	$this->Processo->id = $id;
    	if ($this->request->is('get')){
    		$this->request->data = $this->Processo->findById($id);
    		$this->set('processo', $this->Processo->findById($id));
    	}
	}

    public function novo() {
        $this->loadModel('Tipo_processo');
        $tipo = $this-> Tipo_processo -> find('list',array('fields' => array('Tipo_processo.descricao')));
        $this->set('tipos', $tipo);
        if ($this->request->is('post')) {
            $id_tipo = $this->request->data['Processo']['tipo_processos_id'];
            $tipoProcesso = $this -> Tipo_processo -> findById($id_tipo);
            $prazo = $tipoProcesso['Tipo_processo']['prazo_processo'];
            $data_bgo = $this->request->data['Processo']['data_bgo'];
            $data_termino = new DateTime($data_bgo);
            $data_termino -> add (new DateInterval("P".$prazo."D"));
            $this -> request -> data ['Processo']['previsao_termino'] = $data_termino -> format("Y-m-d");
            $this -> request -> data ['Processo']['situacoes_id'] = 1;
            $this -> request -> data ['Processo']['estados_id'] = 1;
            $this -> request -> data ['Processo']['posse'] = 3;
            if ($this -> Processo -> save($this->request->data)) {
                $this -> Flash->success('Processo adicionado');
                $this -> redirect(array('action' => 'lista'));
            }
            else{
                $this->Flash->success('Houve um erro, processo Não adicionado');
            }
        }
    }

    public function tramitar() {
        $this->loadModel('tramitacao');
//        $tipo = $this-> Tipo_processo -> find('list',array('fields' => array('Tipo_processo.descricao')));
//        $this->set('tipos', $tipo);
        if ($this->request->is('post')) {
            $t = $this->request->data;
            pr($t);
            die();
            $funcao_entrega_id = $this->request->data['tramitacao']['funcao_entrega_id'];
            $tipoProcesso = $this -> Tipo_processo -> findById($id_tipo);
            $prazo = $tipoProcesso['Tipo_processo']['prazo_processo'];
            $data_bgo = $this->request->data['Processo']['data_bgo'];
            $data_termino = new DateTime($data_bgo);
            $data_termino -> add (new DateInterval("P".$prazo."D"));
            $this -> request -> data ['Processo']['previsao_termino'] = $data_termino -> format("Y-m-d");
            $this -> request -> data ['Processo']['situacoes_id'] = 1;
            $this -> request -> data ['Processo']['estados_id'] = 1;
            $this -> request -> data ['Processo']['posse'] = 'encarregado';
            if ($this -> Processo -> save($this->request->data)) {
                $this -> Flash->success('Processo adicionado');
                $this -> redirect(array('action' => 'lista'));
            }
            else{
                $this->Flash->success('Houve um erro, processo Não adicionado');
            }
            $this -> redirect(array('action' => 'lista'));
        }
    }



	function editar($id = null) {
        $processo=$this-> Processo -> findById($id);
        $this -> set ('processo', $processo);
        $this-> Processo -> id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Processo->findById($id);
		} else {
			if ($this->Processo->save($this->request->data)) {
				$this->Flash->success('Processo editado');
                $this -> redirect(array('action' => 'detalhe',$id));
			}
            else{
                $this->Flash->success('Processo não editado, por erro interno!');
            }
		}
	}

/*    public function tramitar(){
        $this->loadModel('Tramitacao');
        $this -> Tramitacao ->create();
        $tramitacao = array('funcao_entrega_id'=>1,'funcao_recebe_id'=>$recebedor, 'processos_id'=>$id);
        if ($this -> Tramitacao -> save($tramitacao)) {
            $this -> Flash->success('Processo tramitado');
            return $this -> redirect(array('action' => 'detalhe',$processo['Processo']['id']));
        }
        else{
            $this->Flash->success('Processo não tramitado, por erro interno!');
        }
    }
    
    public function tramitar(){
        $this->loadModel('Grupo');
        $this->loadModel('Tramitacao');
        if ($this->request->is('post')) {
            //$this->Tramitacao->create();
            $processo = $this -> Processo -> findById($this->request->data['Tramitacao']['processos_id']);
            $Funcao_recebe = $this -> Grupo -> findById($this->request->data['Tramitacao']['Funcao_recebe_id']);
            //pr ($this->request->data); exit();
            if ($this -> Tramitacao -> save($this->request->data)) {
                $this -> Flash->success('Processo tramitado');
                return $this -> redirect(array('action' => 'detalhe',$processo['Processo']['id']));
            }
            else{
                $this->Flash->success('Processo não tramitado, por erro interno!');
            }
        }
    }
*/
    function prorrogar($id = null, $prazo = null) {
        $processo  = $this-> Processo -> findById($id);
        $this -> Processo -> id = $id;
        $data = $processo['Processo']['previsao_termino'];
        $nova_data = new Datetime($data);
        $nova_data -> add (new Dateinterval("P".$prazo."D"));
        $processo['Processo']['previsao_termino'] = $nova_data -> format("Y-m-d");
        if ($this -> Processo -> save($processo)) {
            $this -> Flash->success('Processo prorrogado por ',$prazo,' dias');
            return $this -> redirect(array('action' => 'detalhe',$id));
        }
        else{
            $this->Flash->success('Processo não tramitado, por erro interno!');
        }
    }

////////////////////////////////////////////////////////////////////


	function apagar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Extra->delete($id)) {
			$this->Flash->success('Serviço extra removido');
			$this->redirect(array('action' => 'lista'));
		}
	}

	function filtro(){
        echo $this->element('menu/menu_left');
	}
}