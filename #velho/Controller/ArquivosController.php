<?php 
class ArquivosController extends AppController {
    public $helpers = array ('Html', 'Flash');
    public $components = array('Flash');

    function index(){
        $this->set('title_for_layout', 'Corregedoria');           
    }
    
    function lista() {
        $this->loadModel('Processo');
        $this -> set('processos', $this -> Processo -> find('all',['order'=> ['Processo.created'=> 'DESC']]));
      
        $this->loadModel('Usuario');
        $this->loadModel('Grupo');
$Grupo = 2 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado
//$this-> Grupo -> find('list',array('fields' => array('Grupo.Dsc_grupo')));
$this->set('grupos',$Grupo);
$Usuario = 1;//$this-> Usuario -> find('list',array('fields' => array('Usuario.grupo_bmjus')));
$this->set('usuarios',$Usuario);
    }

    function listar($id = null) {
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
    }
   
public function enviar(){
        $this->loadModel('Documento');
        $uploadData = '';
        if ($this-> request-> is('post')) {
            $numero_de_arquivos_no_processo = $this-> Documento-> find('count', array('conditions' => array('Documento.processo_id' => $this-> request-> data['Documento']['processo_id'])));
            if(!empty($this-> request-> data['Documento']['arquivo']['name'] )){
                $processo = $this-> Processo-> findById($this-> request-> data['Documento']['processo_id']);
                $tipo_processo = $processo['Tipo_processo']['descricao'];
                $pasta_do_processo = str_replace('/','_',$processo['Processo']['num_processo']);
                $fileName = $this-> request-> data['Documento']['arquivo']['name'];
                $uploadPath = WWW_ROOT.'uploads'.DS.'processos'.DS.$tipo_processo.DS.$pasta_do_processo;
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
            $path = WWW_ROOT.'uploads'.DS.'processos'.DS.$tipo.DS.$num.DS.$doc;
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

    function apagar($id) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Extra->delete($id)) {
            $this->Flash->success('Serviço extra removido');
            $this->redirect(array('action' => 'lista'));
        }
    }

}
?>