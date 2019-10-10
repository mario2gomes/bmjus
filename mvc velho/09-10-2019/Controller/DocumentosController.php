<?php 
class DocumentosController extends AppController {
    public $helpers = array ('Html','Form', 'Flash', 'CakePtbr.Formatacao');
    public $components = array('Flash');

    public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Arquivo model
        $this->loadModel('Documento');
        
        // Set the layout
        $this->layout = 'frontend';
    }

    
    public function xxxx_enviar_documento(){
        $this->loadModel('Documento');
        $uploadData = '';
        if ($this-> request-> is('post')) {
            if(!empty($this-> request-> data['Documento']['file']['name'] )){
                $fileName = $this-> request-> data['Documento']['file']['name'];
                $uploadPath = WWW_ROOT.'uploads'.DS.'processos'.DS.$this-> request-> data['Arquivo']['num_processo'];
                $uploadFile = $uploadPath.DS.$fileName;
                $folder = new Folder();
                if($folder-> create($uploadPath)){
                    echo 'teste 3';
                    die();;
                    if(move_uploaded_file($this-> request-> data['Documento']['arquivo']['tmp_name'],$uploadFile)){
                        $uploadData = new Arquivo([
                        'name' => $fileName,
                        'path' => $uploadPath,
                        'created' => date("Y-m-d H:i:s"),
                        'modified' => date("Y-m-d H:i:s"),]);
                        echo 'teste1';;
                        die();
                        $this-> request-> data ['Documento']['nome_arquivo'] = $fileName;
                        if ($this->Documento->save($this-> request-> data)) {
                            echo 'teste 2';
                            die();;
                            $this->Flash->success(__('Arquivo enviado com sucesso'));
                            $id = $this-> request -> data['Documento']['processo_id'];
                            $this -> redirect(array('controller'=>'processos','action' => 'detalhe',$id));
                        }else{
                            echo 'teste 4';
                            die();
                            $this->Flash->error(__('Arquivo não enviado por erro interno'));
                        }
                    }else{
                        echo 'teste 5';
                        die();
                        $this->Flash->error(__('Arquivo não enviado por erro interno'));
                    }
                }else{
                    echo 'pasta nao criada ainda';
                    die();
                    $this->Flash->error(__('Por favor envie o arquivo para upload novamente'));
                }
            }else{
                echo 'teste 6';
                die();
                $this->Flash->error(__('Arquivo não enviado por erro interno'));
            }
        }

        $this->set('uploadData', $uploadData);
    }

    public function listar_documentos(){
        $this->set('files',$this->Arquivo->find('all', ['order' => ['Arquivo.created' => 'DESC']]));
        $this->set('filesRowNum',$this->Arquivo->find('count'));
    }
}

































/*
    public function enviarDocumento($documento = array(), $diretorio = 'documentos'){
            pr('name: ');
            pr($documento);
            pr('type: ');
            pr($documento['TYPE']);
            pr('tmp_name: ');
            pr($documento['TMP_NAME']);
            pr('error: ');
            pr($documento['ERROR']);
            pr('size: ');
            pr($documento['SIZES']);
            $diretorio = WWW_ROOT.$diretorio.DS;

            if(($documento['error']!=0) and ($documento['size']==0)) {
                throw new NotImplementedException('Alguma coisa deu errado, o upload retornou erro '.$documento['error'].' e tamanho '.$documento['size']);
            }

            $this->checa_dir($diretorio);

            $documento = $this->checa_nome($documento, $diretorio);

            $this->move_arquivos($documento, $diretorio);

            return $documento['name'];
    }

    function listaDocumento(){

        $dir = new Folder('/pasta');
        $files = $dir->find('.*\.ctp');

        foreach ($files as $file) {
        $file = new File($dir->pwd() . DS . $file);
        $contents = $file->read();
         $file->write('I am overwriting the contents of this file');
         $file->append('I am adding to the bottom of this file.');
        // $file->delete(); // I am deleting this file
        $file->close(); // Be sure to close the file when you're done
        }
    }

    function index(){
        $this->set('title_for_layout', 'Corregedoria');           
    }


    /**
     * Verifica se o nome do arquivo já existe, se existir adiciona um numero ao nome e verifica novamente
     * @access public
     * @param Array $documento
     * @param String $data
     * @return nome do documento
    */ 
/*    public function checa_dir($diretorio)
    {
        App::uses('Folder', 'Utility');
        $folder = new Folder();
        if (!is_dir($diretorio)){
            $folder->create($diretorio);
        }
    }

    /**
     * Verifica se o nome do arquivo já existe, se existir adiciona um numero ao nome e verifica novamente
     * @access public
     * @param Array $documento
     * @param String $data
     * @return nome da documento
    */ 
/*    public function checa_nome($documento, $diretorio)
    {
        $documento_info = pathinfo($diretorio.$documento['name']);
        $documento_nome = $this->trata_nome($documento_info['filename']).'.'.$documento_info['extension'];
        debug($documento_nome);
        $conta = 2;
        while (file_exists($diretorio.$documento_nome)) {
            $documento_nome  = $this->trata_nome($documento_info['filename']).'-'.$conta;
            $documento_nome .= '.'.$documento_info['extension'];
            $conta++;
            debug($documento_nome);
        }
        $documento['name'] = $documento_nome;
        return $documento;
    }

    /**
     * Trata o nome removendo espaços, acentos e caracteres em maiúsculo.
     * @access public
     * @param Array $documento
     * @param String $data
    */ 
/*    public function trata_nome($documento_nome)
    {
        $documento_nome = strtolower(Inflector::slug($documento_nome,'_'));
        return $documento_nome;
    }

    /**
     * Move o arquivo para a pasta de destino.
     * @access public
     * @param Array $documento
     * @param String $data
    */ 
 /*   public function move_arquivos($documento, $diretorio)
    {
        App::uses('File', 'Utility');
        $arquivo = new File($documento['tmp_name']);
        $arquivo->copy($diretorio.$documento['name']);
        $arquivo->close();
    }
}

*/