<?php 

//App::Import('Core','File');
App::Import('Vendor', 'pdftools/pdftools');
App::Import('Vendor', 'fpdf/fpdf');
App::Import('Vendor', 'Phpqrcode', array('file' => 'Phpqrcode/qrlib.php'));

class DocumentosController extends AppController {
    
    public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Arquivo model
        $this->loadModel('Documento');
        
        // Set the layout
        $this->layout = 'frontend';
    }

    function enviar(){
        $this->loadModel('Tipo_documento');
        $uploadData = '';
        $this-> request-> data['Documento']['tipo_documento_id'] = intval($this-> request-> data['Documento']['tipo_documento_id']);
        if ($this-> request-> is('post')) {
            $numero_de_arquivos_no_processo = str_pad(1 + $this-> Documento-> find('count', array('conditions' => array('Documento.processo_id' => $this-> request-> data['Documento']['processo_id']))), 3, '0', STR_PAD_LEFT);
            if(!empty($this-> request-> data['Documento']['arquivo']['name'] )){
                $processo = $this-> Processo-> findById($this-> request-> data['Documento']['processo_id']);
                $tipo_documento = $this-> Tipo_documento-> findById($this-> request-> data['Documento']['tipo_documento_id']);
                $tipo_processo = $processo['Tipo_processo']['descricao'];
                $pasta_do_processo = str_replace('/','_',$processo['Processo']['num_processo']);
                $fileName = $numero_de_arquivos_no_processo.'_'.$tipo_documento['Tipo_documento']['descricao'].'.pdf';
                $uploadPath = WWW_ROOT.'arquivos'.DS.'processos'.DS.$tipo_processo.DS.$pasta_do_processo;
                $uploadFile = str_replace('?','_',$uploadPath.DS.$fileName);
                if (!is_dir($uploadPath)){
                    mkdir($uploadPath,null,true);
                }
                $pasta = new Folder();
                if($pasta-> create($uploadPath)){
                    pr($uploadPath);
                    pr($this->request->data);
                    if(move_uploaded_file($this-> request-> data['Documento']['arquivo']['tmp_name'],$uploadFile)){
                        $uploadData = new Documento([
                        'name' => $fileName,
                        'path' => $uploadPath,
                        'created' => date("Y-m-d H:i:s"),
                        'modified' => date("Y-m-d H:i:s"),]);
                        $this-> request-> data ['Documento']['nome_arquivo'] = $fileName;
                        $this-> request-> data ['Documento']['tipo_arquivo'] = $this-> request-> data ['Documento']['arquivo']['type'];
                        $this-> request-> data ['Documento']['tmp_name_arquivo'] = $this-> request-> data ['Documento']['arquivo']['tmp_name'];
                        $this-> request-> data ['Documento']['erro_arquivo'] = $this->request-> data ['Documento']['arquivo']['error'];;
                        $this-> request-> data ['Documento']['tamanho_arquivo'] = $this-> request-> data ['Documento']['arquivo']['size'];;
                        $this-> request-> data ['Documento']['numero_de_ordem'] = $numero_de_arquivos_no_processo;                      
                        
                        if ($this->Documento->save($this-> request-> data)) {
                            $id = $this-> request -> data['Documento']['processo_id'];
                            $this -> redirect(array('controller'=>'processos','action' => 'detalhe',$id));
                            $this->Flash->success('Arquivo enviado com sucesso');
                        }else{
                            pr(1);
                            $this->Flash->error('Arquivo não enviado por erro interno');
                        }
                    }else{
                        pr('erro 1');
                        $this->Flash->error('Arquivo não enviado por erro interno');
                    }
                }else{
                    echo 'pasta nao criada ainda';
                    $this->Flash->error('Por favor envie o arquivo para upload novamente');
                }
            }else{
                pr(3);
                $this->Flash->error('Arquivo não enviado por erro interno');
            }
        }

        $this->set('uploadData', $uploadData);
    }


    function visualizar($tipo=null, $num=null, $doc=null) {
        if(isset($_GET['hash'])){
            $hash = $_GET['hash'];
            $salt = Configure::read('Security.salt');
            $hash_valido = md5($salt.$tipo.$num.$doc);
            if($hash != md5($salt.$tipo.$num.$doc)){
                //$this->redirect( '/users/member_login' );
                $this->Session->setFlash( ('Informações para acesso ao link inválidas!'), 'default', array( 'class' => 'error-message') );
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

            //header("Content-Disposition: attachment; filename=" . urlencode($doc));   
            //header("Content-Type: application/download");
            //header("Content-Description: File Transfer");            

            readfile($path); // lê o arquivo
            exit;
        }
    }

/*
    public function lixo_xxxx_enviar_documento(){
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
                            $this->Flash->success('Arquivo enviado com sucesso');
                            $id = $this-> request -> data['Documento']['processo_id'];
                            $this -> redirect(array('controller'=>'processos','action' => 'detalhe',$id));
                        }else{
                            echo 'teste 4';
                            die();
                            $this->Flash->error('Arquivo não enviado por erro interno');
                        }
                    }else{
                        echo 'teste 5';
                        die();
                        $this->Flash->error('Arquivo não enviado por erro interno');
                    }
                }else{
                    echo 'pasta nao criada ainda';
                    die();
                    $this->Flash->error('Por favor envie o arquivo para upload novamente');
                }
            }else{
                echo 'teste 6';
                die();
                $this->Flash->error('Arquivo não enviado por erro interno');
            }
        }

        $this->set('uploadData', $uploadData);
    }

    public function lixoxxxlista(){
        $this->set('files',$this->Arquivo->find('all', ['order' => ['Arquivo.created' => 'DESC']]));
        $this->set('filesRowNum',$this->Arquivo->find('count'));
    }
*/
    //Assinatura do documento com código QR(copiado do DOCBM)
    function assinar($id=null){
        //a fazer: verificar se o assinante é o responsável por esse documento  ou se é escrivão
        
// QRCODE no documento        
        //$this->autoRender = false;
        //$qrcode = new QRcode();
        //$qrcode->png ('algum outro texto 1234');

        if (!empty($this->data)) {
            
            /* Verifica se o usuário para a função a qual está logado é protocolista (ver controller funcoes->gerir), caso seja não é permitida a assinatura */
            /*
            if($this->Session->read('Funcao.protocolista')){
				$this->Session->setFlash('Nesta funcao vc eh protocolista!!', 'default', array('class' => 'error'));
                $this->redirect(array('controller'=>'processos', 'action' => 'detalhe', $documento['Processo']['id']));
			}
			*/
			$cpf = $this->data['cpf'];
			$salt = Configure::read('Security.salt');
			$hash = md5($salt.$this->data['senha']);		
			$testa = $this->Usuario->find('count', array('conditions'=>array('Usuario.sen_usuario'=>$hash, 'Usuario.cpf'=>$cpf)));
            $documento = $this->Documento->find('first', array('conditions'=>array('Documento.id'=>$this->data['id'])));
pr($this->data)            ;
            //Confirmação de usuário/senha encontrado
            if($testa>0){

////parei aqui 17/11/2020 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Versão do primeiro documento
//                $versao_doc = 1;
//                $pdfTools = new PdfTools();
                
//                $path_docs = Configure::read('pathdocs');
                //Path do arquivo original
//                $file = $path_docs . $this->data['Documento']['seq_documento'] . '.pdf';
                //Path do arquivo temporário
//                $tmp_file = sys_get_temp_dir() . DS . $this->data['Documento']['seq_documento'] . '.pdf';   
                
                //Texto do QRCode
                //Usuário Responsável pela assinatura
                $usuario = $this->Usuario->find('first', array('contain'=>array('Perfil'=>array('Cargo')), 'conditions'=>array('Usuario.cpf'=> $cpf)));
                $nome_assinou = $usuario['Perfil']['Cargo']['sig_cargo'].' '.$usuario['Perfil']['nom_guerra'] . ' -  Mat: ' . $usuario['Perfil']['matricula'];
                $texto = utf8_encode('DocBM Nº: ' . $this->data['Documento']['seq_documento']  .  ' - Assinado por: ' . $nome_assinou . ' - Em: '.  date('d-m-Y H:i:s'));// . ' - Versão: ' . $versao_doc);
                $documento['Documento']['usuario_assina_id'] = $cpf;
                
                //Adicionando o código QRCode ao arquivo e gravando no repositório temporário                                                       
//                if($pdfTools->addQRCode($file, $tmp_file, $texto)){                                   
                if(1){
                    
                    //Fazendo uma cópia do arquivo original
                    $file_backup = sys_get_temp_dir() . DS . $this->data['Documento']['seq_documento'] . '_backup.pdf';   
                    $file_origin = new File($file, false );
                    $file_origin->copy($file_backup, true);
                    $file_origin->close();
                    
                    //Subtituindo o arquivo original pelo arquivo assinado com QRCode                                                                       
                    $fileRQCode = new File($tmp_file, false);
                    $resultado_copy = $fileRQCode->copy($file, true);
                    $fileRQCode->close();
                    
                    //Deletando arquivo de visualização sem assinatura, caso exista.                                    
                    $filePdfSwf = $file_backup = sys_get_temp_dir() . DS . $this->data['Documento']['seq_documento'] . '.pdf.swf';
                    if(file_exists($filePdfSwf)){
                            unlink($filePdfSwf); 
                    }
//                    if ($resultado_copy){
                    if(1){
//                        $hash = sha1_file($file);
                        $this -> Documento -> id = $this->data['id'];
                        $this -> Documento -> set(array('usuario_assina_id'=>$cpf, 'hash'=>$hash));
                        if ($this->Documento->save()) {
                            $this->Session->setFlash('Documento assinado com sucesso!', 'default', array('class' => 'success'));
                            $this->redirect(array('controller'=>'processos', 'action' => 'detalhe', $documento['Processo']['id']));                                       

                        } 
                        
                    } else {
                        $this->Session->setFlash('Erro ao assinar documento!', 'default', array('class' => 'error'));
                        $this->redirect(array('controller'=>'processos', 'action' => 'detalhe', $documento['Processo']['id']));        
                    }
                    
                    
                } else {
                        $this->Session->setFlash('Erro ao assinar documento!', 'default', array('class' => 'error'));
                        $this->redirect(array('controller'=>'processos', 'action' => 'detalhe', $documento['Processo']['id']));        
                }
				
			} else{
				$this->Session->setFlash('Senha ou usuário não conferem!');
				$this->redirect(array('controller'=>'processos', 'action' => 'detalhe', $documento['Processo']['id']));				
			}
		}	
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