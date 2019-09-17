<?php 
class DocumentosController extends AppController {
    public $helpers = array ('Html','Form', 'Flash', 'CakePtbr.Formatacao');
    public $components = array('Flash');

    function index(){
        $this->set('title_for_layout', 'Corregedoria');           
    }

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

    /**
     * Verifica se o nome do arquivo já existe, se existir adiciona um numero ao nome e verifica novamente
     * @access public
     * @param Array $documento
     * @param String $data
     * @return nome do documento
    */ 
    public function checa_dir($diretorio)
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
    public function checa_nome($documento, $diretorio)
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
    public function trata_nome($documento_nome)
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
    public function move_arquivos($documento, $diretorio)
    {
        App::uses('File', 'Utility');
        $arquivo = new File($documento['tmp_name']);
        $arquivo->copy($diretorio.$documento['name']);
        $arquivo->close();
    }
}