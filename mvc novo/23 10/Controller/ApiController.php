<?php

App::uses('CronController', 'Controller');

class ApiController extends AppController {

    var $components = array('RequestHandler', 'Ad.GestorOcorrencia', 'Ad.GestorRecurso', 'Certidao.GestorCertidao', 'Certidao.GestorSolicitacao');
    
    /*
     * Retorna as ocorrъncias que estуo acontedendo agora
     */
    function ocorrencias_agora() {
        
        $cond['status_id'] = Configure::read('status_ocorrencia_andamento');
        $ocorrencias = $this->GestorOcorrencia->carregar($cond);
        
        echo json_encode($ocorrencias);
        $this->autoRender = false;
        
    }

    /*
     * Retorna as ocorrъncias atendidas nas ultimas 24 horas
     */
    function ocorrencias_atendidas() {
               
        $cond['status_id'] = array(Configure::read('status_ocorrencia_executada'), Configure::read('status_ocorrencia_homologada'));
        $ocorrencias = $this->GestorOcorrencia->ultimas($cond);
        
        echo json_encode($ocorrencias);
        $this->autoRender = false;
        
    }
	
	/*
     * Retorna a lista de vэtimas para emissуo de certidуo
     */
    function get_vitimas() {
        
        $data = $_POST['data'];
        $vitimas = $this->GestorCertidao->getVitimas($data);
        echo json_encode($vitimas);
        die();
    }
    
    /*
     * Retorna a lista de veэculos para emissуo de certidуo
     */
    function get_veiculos() {
        
        $data = $_POST['data'];
        $veiculos = $this->GestorCertidao->getVeiculos($data);        
        echo json_encode($veiculos);
        die();
    }
    
    /*
     * Gera a certidуo com os dados informados
     */
    function gerar_certidao() {
        
        $result = array();
        $dados = $_POST;        
        
        if($this->GestorCertidao->gerarCertidao($dados)){
            $link = $this->GestorCertidao->gerarLink();
            $this->GestorCertidao->enviarCertidao($dados['email'], $link);
            $result['link'] = $link;
        }else{
            $result['erros'] = $this->GestorCertidao->erros;
        }       
        
        echo json_encode($result);
        die();
    }
    
    /*
     * Registra a solicitaчуo de certidуo
     */
    function registrar_sol() {
        
        $result = array();
        $dados = $_POST;
        if($this->GestorSolicitacao->registrar($dados)){
            $result['chave'] = $this->GestorSolicitacao->chave;
        }else{
            $result['erros'] = $this->GestorSolicitacao->erros;
        }                
        
        echo json_encode($result);
        die();
    }
    
    /*
     * Valida certidуo
     */
    function valida_certidao() {
        
        $result = array();
        $dados = $_POST;
        
        if($this->GestorCertidao->valida($dados['id'], $dados['chave'])){
            $link = $this->GestorCertidao->gerarLink();
            $result['link'] = $link;
        }else {
            $result['erros'] = $this->GestorCertidao->erros;
        }
        
        echo json_encode($result);
        die();
        
    }
    
    /*
     * Retorna os dados da solicitaчуo via chave
     */
    function consulta_sol() {
        
        $result = array();
        $chave = $_POST['chave'];
        
        if($this->GestorSolicitacao->get($chave)){
            $result = $this->GestorSolicitacao->dados;               
        }else{
            $result['erros'] = $this->GestorSolicitacao->erros;
        }                
        
        echo json_encode($result);
        die();
        
    }
	
	/*
	* Retorna os proximos servicos do militar
	*/
	function proximos_servicos($militar_id){
	
        $this->loadModel('Escalas.ViewDia');
        
        $conditions = array();
        $conditions['ViewDia.militar_id'] = $militar_id;
        $conditions['ViewDia.dia >= '] = date('Ymd');
        $conditions['ViewDia.publicada'] = 'S';

        $dias = $this->ViewDia->find('all', array('conditions' => $conditions, 'order' => array('ViewDia.dia' => 'asc')));
        
        $dias = $this->array_map_recursive('utf8_encode', $dias);
        
        echo json_encode($dias);
        
        $this->autoRender = false;
    }
}

?>