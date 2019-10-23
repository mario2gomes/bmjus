<?php 
class ProcessosController extends AppController {
    public $helpers = array ('Html','Form', 'Flash', 'CakePtbr.Formatacao');
    public $components = array('Flash', 'Prazos');

    function index(){
        $this->set('title_for_layout', 'Corregedoria');           
    }
    
    function lista() {
        $this->loadModel('Tipo_processo');
        $tipo = $this-> Tipo_processo -> find('list',array('fields' => array('Tipo_processo.descricao')));
        $this->set('tipos', $tipo);
        $this->loadModel('Punicao');
        $this -> set('processos', $this -> Processo -> find('all',['order'=> ['Processo.created'=> 'DESC']]));
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
        $tramitacao = $this-> Tramitacao -> find('all', ['order'=> ['Tramitacao.created'=> 'DESC']]);
        $this -> set ('tramitacoes', $tramitacao);
        
        $this->loadModel('Tipo_documento');
        $tipo = $this-> Tipo_documento -> find('list',array('fields' => array('Tipo_documento.descricao')));
        $this->set('tipos', $tipo);

        $this-> loadModel('Documento');
        $documentos = $this-> Documento-> find('all', ['order'=> ['Documento.numero_de_ordem'=>'ASC']]);
        $this-> set('documentos',$documentos);

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
            $inicio = $this -> request -> data['Processo']['data_bgo'];
            $prazo = $tipoProcesso['Tipo_processo']['prazo_processo'];
            $termino = $this -> Prazos -> termino_em_dia_util($inicio, $prazo);
//            $data_bgo = $this->request->data['Processo']['data_bgo'];
//            $data_termino = new DateTime($data_bgo);
//            $data_termino -> add (new DateInterval("P".$prazo."D"));
//$this -> request -> data ['Processo']['previsao_termino'] = $data_termino -> format("Y-m-d");
            $this -> request -> data ['Processo']['prazo'] = $prazo;
            $this -> request -> data ['Processo']['numero'] = str_replace('/', '_',$this -> request -> data ['Processo']['numero']);
            $this -> request -> data ['Processo']['situacoes_id'] = 1;
            $this -> request -> data ['Processo']['estados_id'] = 1;
            $this -> request -> data ['Processo']['posse_id'] = 3;
            $this -> request -> data ['Processo']['previsao_termino'] = $termino->format('Y-m-d');
          
//            $dataSourceProcesso = $this-> Processo ->getDataSource();
//            $dataSourceProcesso->begin();    
            $this -> Processo ->create();
            if ($this -> Processo -> save($this-> request-> data)) {
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
                $this-> Flash-> success('Houve um erro, processo não adicionado');
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
                $inicio = $this -> Processo -> field('data_bgo');;
                $prazo = $this -> Processo -> field('prazo');
                $novo_prazo = $qtd_dias + $prazo;
                $termino = $this -> Prazos -> termino_em_dia_util($inicio, $novo_prazo);
                $prorrogacoes = $this -> Processo -> field('prorrogacoes');
                $prorrogacoes = $prorrogacoes + 1;
                $this -> Processo -> set(array('prazo'=>$novo_prazo,'prorrogacoes'=> $prorrogacoes,'previsao_termino' => $termino->format('Y-m-d')));

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
            $inicio = $this -> Processo->field('data_bgo');;
            $novo_prazo = $this -> Processo->field('prazo') + $duracao;
            $termino = $this -> Prazos -> termino_em_dia_util($inicio, $novo_prazo);
            $this -> Processo -> set(array('estados_id'=>1,'prazo'=>$novo_prazo, 'previsao_termino' => $termino->format('Y-m-d')));
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

public function enviar_documento(){
        $this->loadModel('Documento');
        $uploadData = '';
        if ($this-> request-> is('post')) {
            $numero_de_arquivos_no_processo = $this-> Documento-> find('count', array('conditions' => array('Documento.processo_id' => $this-> request-> data['Documento']['processo_id'])));
            if(!empty($this-> request-> data['Documento']['arquivo']['name'] )){
                $processo = $this-> Processo-> findById($this-> request-> data['Documento']['processo_id']);
                $tipo_processo = $processo['Tipo_processo']['descricao'];
                $pasta_do_processo = str_replace('/','_',$processo['Processo']['num_processo']);
                $fileName = $this-> request-> data['Documento']['arquivo']['name'];
                $uploadPath = WWW_ROOT.'arquivos'.DS.'processos'.DS.$tipo_processo.DS.$pasta_do_processo;
                $uploadFile = $uploadPath.DS.$fileName;
                if (!is_dir($uploadPath)){
                    mkdir($uploadPath,null,true);
                }
                $pasta = new Folder();
                if($pasta-> create($uploadPath)){
                    if(move_uploaded_file($this-> request-> data['Documento']['arquivo']['tmp_name'],$uploadFile)){
                        $uploadData = new Documento([
                        'name' => $fileName,
                        'path' => $uploadPath,
                        'created' => date("Y-m-d H:i:s"),
                        'modified' => date("Y-m-d H:i:s"),]);
                        $this-> request-> data ['Documento']['nome_arquivo'] = $fileName;
                        $this-> request-> data ['Documento']['tipo_arquivo'] = $this-> request-> data ['Documento']['arquivo']['type'];
                        $this-> request-> data ['Documento']['tmp_name_arquivo'] = $this-> request-> data ['Documento']['arquivo']['tmp_name'];
                        $this-> request-> data ['Documento']['erro_arquivo'] = $this-> request-> data ['Documento']['tmp_name_arquivo'] = $this-> request-> data ['Documento']['arquivo']['error'];;
                        $this-> request-> data ['Documento']['tamanho_arquivo'] = $this-> request-> data ['Documento']['arquivo']['size'];;
                        $this-> request-> data ['Documento']['numero_de_ordem'] = $numero_de_arquivos_no_processo + 1;
                        if ($this->Documento->save($this-> request-> data)) {
                            echo 'teste 2';
                            $this->Flash->success(__('Arquivo enviado com sucesso'));
                            $id = $this-> request -> data['Documento']['processo_id'];
                            $this -> redirect(array('controller'=>'processos','action' => 'detalhe',$id));
                        }else{
                            $this->Flash->error(__('Arquivo não enviado por erro interno'));
                        }
                    }else{
                        $this->Flash->error(__('Arquivo não enviado por erro interno'));
                    }
                }else{
                    echo 'pasta nao criada ainda';
                    $this->Flash->error(__('Por favor envie o arquivo para upload novamente'));
                }
            }else{
                $this->Flash->error(__('Arquivo não enviado por erro interno'));
            }
        }

        $this->set('uploadData', $uploadData);
    }


    function abrir_documento($tipo, $num, $doc) {
        if(isset($_GET['hash'])){
            $hash = $_GET['hash'];
            $salt = Configure::read('Security.salt');
            $hash_valido = md5($salt.$tipo.$num.$doc);
            if($hash != md5($salt.$tipo.$num.$doc)){
                $this->Session->setFlash( __('Informações para acesso ao link inválidas!'), 'default', array( 'class' => 'error-message') );
                //$this->redirect( '/users/member_login' );
            }
        }
        
        if (!empty($doc)) {
            // o arquivo para download
            $path = WWW_ROOT.'arquivos'.DS.'processos'.DS.$tipo.DS.$num.DS.$doc;
            // informa o tipo do arquivo ao navegador
            header("Content-Type: application/pdf");
            // informa o tamanho do arquivo ao navegador
            header("Content-Length: " . filesize($path));
            // informa ao navegador que o arquivo deve ser aberto para download
            // informa ao navegador o nome do arquivo
            header("filename=" . basename($path));

            readfile($path); // lê o arquivo
            exit;
        }
    }






/*






    function upload(){
        $tipo_processo = 'pad';
        $numero_processo = 123;
        $tipo_documento = 'portaria';
        $pagina = 12;
        $numero_de_ordem = 1;

        if(!empty($this->data)){
            
            $erro = false;
            foreach($this->data['Auto'] as $campo => $valor){
                if(empty($valor)){
                    $this->Session->setFlash("O campo '$campo' não pode ser vazio.", 'default', array( 'class' => 'error-message'));
                    $erro = true;
                }
            }
            
            if(!$erro){
//$numero_de_ordem = str_pad($this->data['Documento']['numero'], 3, '0', STR_PAD_LEFT);
//$ano = substr($this->data['Auto']['Data'], 6, 4);
                
//$dt_bgo = $this->data['Auto']['Data'];

                $fileName = "$tipo_processo-$numero_processo-$numero_de_ordem-$tipo_documento.pdf";
                $novoPath = PATH_DOCUMENTOS.DS.$tipo_processo+'Nº '.$numero_processo;
                
                if(!is_dir($novoPath)){
                    mkdir($novoPath, 0777, true);
                }
                $novoPath .= DS.$fileName;
                /*
                echo $this->data['Auto']['filename'];
                echo '<br>';
                echo $novoPath;
                die();
                */
 //               if(copy($this->data['Auto']['filename'], $novoPath)){
                    
//Se salvar seta os dados para gerar o alerta BGO no BMRH - ver alertas/alerta_bgo
//$dados = "file_path=$novoPath&num_bgo=$numero&data_bgo=$dt_bgo";
//$path_job = WWW_ROOT.'cron_job.php';
//executa o script em background
//exec("/usr/local/zend/bin/php $path_job /boletins/envia_alertas '$dados' > /dev/null 2>&1 &");

                    /*$dados['file_path'] = $novoPath;
                    $dados['num_bgo'] = $numero;
                    $dados['data_bgo'] = $dt_bgo;                   
                    $this->set(compact('dados'));
                    $this->data = array();
                    */
/*                    $this->Session->setFlash("Arquivo carregado com sucesso.");
                }else{                  
                    $this->Session->setFlash("Não foi possível fazer o carregamento. Tente novamente.", 'default', array( 'class' => 'error-message'));
                }
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