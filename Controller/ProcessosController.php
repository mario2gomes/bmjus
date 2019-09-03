<?php 
class ProcessosController extends AppController {
    public $helpers = array ('Html','Form', 'Flash', 'CakePtbr.Formatacao');
    public $components = array('Flash');

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
        
        $this->loadModel('Usuario');
        $this->loadModel('Grupo');
$Grupo = 2 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado//$this-> Grupo -> find('list',array('fields' => array('Grupo.Dsc_grupo')));
$this->set('grupos',$Grupo);
$Usuario = 1;//$this-> Usuario -> find('list',array('fields' => array('Usuario.grupo_bmjus')));
$this->set('usuarios',$Usuario);
    }

    function detalhe($id = null) {
        $this->loadModel('Tramitacao');
        $tramitacao = $this-> Tramitacao -> find('all');
        $this -> set ('tramitacoes', $tramitacao);

        $this->loadModel('Grupo');
        $funcoes = $this -> Grupo -> find('list', array('fields'=>array('Grupo.dsc_grupo')));
        $this->set('funcoes', $funcoes);

$Grupo = 2 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado//$this-> Grupo -> find('list',array('fields' => array('Grupo.Dsc_grupo')));
$this->set('grupos',$Grupo);
$Usuario = 1;//$this-> Usuario -> find('list',array('fields' => array('Usuario.grupo_bmjus')));
$this->set('usuarios',$Usuario);


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
        $this->loadModel('Relatorio');
        if ($this->request->is('post')) {
            $id_tipo = $this -> request -> data['Processo']['tipo_processos_id'];
            $tipoProcesso = $this -> Tipo_processo -> findById($id_tipo);
            $prazo = $tipoProcesso['Tipo_processo']['prazo_processo'];
            $data_bgo = $this->request->data['Processo']['data_bgo'];
            $data_termino = new DateTime($data_bgo);
            $data_termino -> add (new DateInterval("P".$prazo."D"));
            $this -> request -> data ['Processo']['previsao_termino'] = $data_termino -> format("Y-m-d");
            $this -> request -> data ['Processo']['situacoes_id'] = 1;
            $this -> request -> data ['Processo']['estados_id'] = 1;
            $this -> request -> data ['Processo']['posse_id'] = 1;
          
            $dataSourceProcesso = $this-> Processo ->getDataSource();
            $dataSourceProcesso->begin();    
            $this -> Processo ->create();
            if ($this -> Processo -> save($this->request->data)) {
                $dataSourceRelatorio = $this-> Relatorio ->getDataSource();
                $dataSourceRelatorio->begin();    
                $this -> request -> data ['Relatorio']['situacao_id'] = 1;
                $this -> request -> data ['Relatorio']['processo_id'] = $this-> Processo -> id;
                $this -> request -> data ['Relatorio']['prazo'] = $prazo;

                $this -> Relatorio ->create();
                if ($this -> Relatorio -> save($this->request->data)) {
                    $dataSourceRelatorio->commit();
                }
                else{
                    $dataSourceRelatorio->rollback();
                    $dataSourceProcesso->rollback();
                   $this->Flash->success('erro, processo Não adicionado');
               }
                $dataSourceProcesso->commit();
                $this -> Flash->success('Processo adicionado');
                $this -> redirect(array('action' => 'lista'));
            }
            else{
                $dataSourceProcesso->rollback();
                $this->Flash->success('Houve um erro, processo Não adicionado');
            }
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


    public function tramitar(){
        $this->loadModel('Tramitacao');
        $this->loadModel('Grupo');
        if ($this->request->is('post')) {
            if ($this->Tramitacao->save($this->request->data)) {
                $this -> Flash->success('Processo tramitado');              
                $id = $this->request->data['Tramitacao']['processos_id'];
                $funcao_recebe_id = $this->request->data['Tramitacao']['funcao_recebe_id'];

                $this -> Processo ->id = $id;
                $this-> Processo ->saveField('posse_id', $funcao_recebe_id);
                $this -> redirect(array('action' => 'detalhe',$id));
            }
            else{
                $this->Flash->success('Houve um erro, processo Não tramitado
                    ');
            }
        }
    }

    
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