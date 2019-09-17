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
$Grupo = 2 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado
//$this-> Grupo -> find('list',array('fields' => array('Grupo.Dsc_grupo')));
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

$Grupo = 2 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado
//$this-> Grupo -> find('list',array('fields' => array('Grupo.Dsc_grupo')));
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
//        $this->loadModel('Relatorio');
        if ($this->request->is('post')) {
            $id_tipo = $this -> request -> data['Processo']['tipo_processos_id'];
            $tipoProcesso = $this -> Tipo_processo -> findById($id_tipo);
            $prazo = $tipoProcesso['Tipo_processo']['prazo_processo'];
//            $data_bgo = $this->request->data['Processo']['data_bgo'];
//            $data_termino = new DateTime($data_bgo);
//            $data_termino -> add (new DateInterval("P".$prazo."D"));
//$this -> request -> data ['Processo']['previsao_termino'] = $data_termino -> format("Y-m-d");
            $this -> request -> data ['Processo']['prazo'] = $prazo;
            $this -> request -> data ['Processo']['situacoes_id'] = 1;
            $this -> request -> data ['Processo']['estados_id'] = 1;
            $this -> request -> data ['Processo']['posse_id'] = 1;
          
//            $dataSourceProcesso = $this-> Processo ->getDataSource();
//            $dataSourceProcesso->begin();    
            $this -> Processo ->create();
            if ($this -> Processo -> save($this->request->data)) {
/*                $dataSourceRelatorio = $this-> Relatorio ->getDataSource();
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
*/                
                $this -> Flash->success('Processo adicionado');
                $this -> redirect(array('action' => 'lista'));
            }
            else{
//                $dataSourceProcesso->rollback();
                $this->Flash->success('Houve um erro, processo não adicionado');
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
                $this->Flash->success('Houve um erro, processo Não tramitado');
            }
        }
    }

    
    function prorrogar() {
        $this-> loadModel('Prorrogacao');
//        $this-> loadModel('Relatorio');
        if ($this-> request ->is('post')){

            $dataSourceProrrogacao = $this -> Prorrogacao -> getDataSource();
            $dataSourceProrrogacao -> begin();
            $this -> Prorrogacao -> create();
            if ($this-> Prorrogacao ->save($this->request->data)){
                                
                $id = $this-> request -> data['Prorrogacao']['processo_id'];
                $qtd_dias = $this-> request -> data['Prorrogacao']['qtd_dias'];
                $this -> Processo -> id = $id;
                $prazo = $this -> Processo -> field('prazo');
                $novo_prazo = $qtd_dias + $prazo;
                $prorrogacoes = $this -> Processo -> field('prorrogacoes');
                $prorrogacoes = $prorrogacoes + 1;
                $this -> Processo -> set(array('prazo'=>$novo_prazo,'prorrogacoes'=> $prorrogacoes));             
                if ($this -> Processo -> save()){
                    $dataSourceProrrogacao -> commit();
                    $this-> Flash -> success('Processo prorrogado');
                    $this -> redirect(array('action' => 'detalhe',$id));
                }else{
                    $dataSourceProrrogacao -> rollback();
                    $this->Flash->success('Houve um erro, não foi possível prorrogar o processo');
                    $this -> redirect(array('action' => 'detalhe',$id));
                }
            }

        }
    }

    function suspender() {
        $this-> loadModel('Suspensao');
//        $this-> loadModel('Relatorio');
        if ($this-> request ->is('post')){

            $dataSourceSuspensao = $this -> Suspensao -> getDataSource();
            $dataSourceSuspensao -> begin();
            $this -> Suspensao -> create();
            if ($this-> Suspensao ->save($this->request->data)){
                                
                $id = $this-> request -> data['Suspensao']['processo_id'];
                $this -> Processo -> id = $id;
                $this -> Processo -> set(array('estados_id'=>2));
                if ($this -> Processo -> save()){
                    $dataSourceSuspensao -> commit();
                    $this-> Flash -> success('Processo suspenso');
                    $this -> redirect(array('action' => 'detalhe',$id));
                }else{
                    $dataSourceSuspensao -> rollback();
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this->Flash->success('Houve um erro, não foi possível suspender o processo');
                }
            }

        }
    }
    
    function reabrir() {
        $this-> loadModel('Suspensao');

        $suspensao = $this->request->data;
        $this -> Suspensao -> id = $suspensao['Suspensao']['id'];

        $inicio = date_create($suspensao['Suspensao']['data_inicio']);
        $fim = date_create($suspensao['Suspensao']['data_termino']);
        $duracao = date_diff($fim,$inicio);
        $duracao = $duracao->days;

        $dataSourceSuspensao = $this -> Suspensao -> getDataSource();
        $dataSourceSuspensao -> begin();

        $this -> Suspensao -> set(array('data_termino'=>$suspensao['Suspensao']['data_termino']));
        if ($this -> Suspensao -> save ($this->request->data)){
            $id = $suspensao['Suspensao']['processo_id'];
            $this -> Processo -> id = $id;
            $novo_prazo = $this -> Processo->field('prazo') + $duracao;
            $this -> Processo -> set(array('estados_id'=>1,'prazo'=>$novo_prazo));
            if ($this -> Processo -> save()){
                $dataSourceSuspensao -> commit();
                $this-> Flash -> success('Processo reaberto');
                $this -> redirect(array('action' => 'detalhe',$id));    
            }else{
                $dataSourceSuspensao -> rollback();
                $this -> redirect(array('action' => 'detalhe',$id));
                $this->Flash->success('Houve um erro, não foi possível suspender o processo');
            }
        }else{
            $dataSourceSuspensao -> rollback();
            $this -> redirect(array('action' => 'detalhe',$id));
            $this->Flash->success('Houve um erro, não foi possível suspender o processo');
        }
    }
/*

            $dataSourceSuspensao = $this -> Suspensao -> getDataSource();
            $dataSourceSuspensao -> begin();
            $this -> Suspensao -> create();
            if ($this-> Suspensao ->save($this->request->data)){
                                
                $id = $this-> request -> data['Suspensao']['processo_id'];
                $this -> Processo -> id = $id;
                $this -> Processo -> set(array('estados_id'=>2));
                if ($this -> Processo -> save()){
                    $dataSourceSuspensao -> commit();
                    $this-> Flash -> success('Processo suspenso');
                    $this -> redirect(array('action' => 'detalhe',$id));
                }else{
                    $dataSourceSuspensao -> rollback();
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this->Flash->success('Houve um erro, não foi possível suspender o processo');
                }
            }

        }
        */
    

////////////////////////////////////////////////////////////////////

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