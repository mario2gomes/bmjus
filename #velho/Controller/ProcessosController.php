<?php 
class ProcessosController extends AppController {

    var $components = array('RequestHandler');

    function index(){
        $this->set('title_for_layout', 'Corregedoria');
        $this -> set('criados', $this -> Processo -> find('count',array('conditions'=> array('Processo.estados_id'=>0))));
        $this -> set('instaurados', $this -> Processo -> find('count',array('conditions'=> array('Processo.estados_id'=>1))));
        $this -> set('suspensos', $this -> Processo -> find('count',array('conditions'=> array('Processo.estados_id'=>2))));
        $this -> set('aguardando_solucao', $this -> Processo -> find('count',array('conditions'=> array('Processo.estados_id'=>3))));
        $this -> set('em_analise', $this -> Processo -> find('count',array('conditions'=> array('Processo.estados_id'=>4))));
        $this -> set('atrasados', $this -> Processo -> find('count',array('conditions'=> array('Processo.situacoes_id'=>2))));
        $this -> set('no_prazo', $this -> Processo -> find('count',array('conditions'=> array('Processo.situacoes_id'=>1))));
    }

    function testejava(){
        $this->set('title_for_layout', 'Corregedoria');
    }
    
    function lista() {
        $this->loadModel('Tipo_processo');
        $this->loadModel('Usuario');        
        $tipo = $this-> Tipo_processo -> find('list',array('fields' => array('Tipo_processo.descricao')));
        $this->set('tipos', $tipo);
        $this->loadModel('Punicao');
        $this -> set('processos', $this -> Processo -> find('all',['order'=> ['Processo.created'=> 'DESC']]));
        $this->set('punicoes', $this-> Punicao ->find('all'));
        $this->set('nomes', $this-> Usuario-> find('list', array('fields' => 'nome')));
//        $this->loadModel('Usuario');
//        $this->loadModel('Grupo');
//$Grupo = 2 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado
//$this-> Grupo -> find('list',array('fields' => array('Grupo.Dsc_grupo')));
//$this->set('grupos',$Grupo);
//$Usuario = 1;//$this-> Usuario -> find('list',array('fields' => array('Usuario.grupo_bmjus')));
//$this->set('usuarios',$Usuario);
    }

    function detalhe($id = null) {
        $this->loadModel('Tramitacao');
        $tramitacao = $this-> Tramitacao -> find('all', ['order'=> ['Tramitacao.created'=> 'asc']]);
        $this -> set ('tramitacoes', $tramitacao);
        
        $documentos_desse_processo = $this-> Documento -> find('all',['order'=>['numero_de_ordem'=>'asc'], 'conditions'=>['Documento.processo_id'=>$id]]);
        $this->set('documentos_desse_processo',$documentos_desse_processo);

        $tipo_documento_desse_processo = array();
        foreach ($documentos_desse_processo as $documento) {
            $tipo_documento_desse_processo[] = $documento['Documento']['tipo_documento_id'];
        }
        $this->set('tipo_documento_desse_processo',$tipo_documento_desse_processo);

        $tipos_obrigatorios = array(1=>'autuação', 2=>"portaria de abertura", 3=>"termo de abertura");
        $this->set('tipos_obrigatorios', $tipos_obrigatorios = array(1=>'autuação', 2=>"portaria de abertura", 3=>"termo de abertura"));

        //$this->loadModel('Parecer');
        //$this->loadModel('Tipo_parecer');
        //$this->loadModel('Envio');
        //$this->set('pareceres',$this-> Parecer->find('all'));
        //$this->set('envios',$this-> Envio->find('list',['fields'=>'descricao']));
        //$this->set('tipos_parecer',$this-> Tipo_parecer->find('list',['fields'=>'descricao']));

//        $this->loadModel('Tipo_documento');
//        $tipo_documento = $this-> Tipo_documento -> find('list',array('fields' => array('Tipo_documento.descricao')));
//        $this->set('tipo_documentos', $tipo_documento);
        
///        $this->loadModel('Tipo_solucao');
   ///             $tipos_solucao = $this-> Tipo_solucao -> find('list',array('fields' => array('Tipo_solucao.descricao')));
      ///          $this->set('tipos_solucao', $tipos_solucao);

        $this->loadModel('Enquadramento');
        $enquadramento = $this-> Enquadramento -> find('list',array('fields' => array('Enquadramento.descricao')));
        $this->set('enquadramentos', $enquadramento);

        $this->loadModel('Grupo');
        $funcoes = $this -> Grupo -> find('list', array('fields'=>array('Grupo.dsc_grupo')));
        $this->set('funcoes', $funcoes);

//        $this->loadModel('Usuario');
  //      $this->set('nomes', $this-> Usuario-> find('list', array('fields' => 'nome')));

//$Grupo = 2 ;//grupos: 1-adm; 2- corregedoria, 3-encarregado,4-autoridade,5-acusado
//$this-> Grupo -> find('list',array('fields' => array('Grupo.Dsc_grupo')));
//$this->set('grupos',$Grupo);
//$Usuario = 1;//$this-> Usuario -> find('list',array('fields' => array('Usuario.grupo_bmjus')));
//$this->set('usuarios',$Usuario);


        $processo = $this->Processo->find('all');
        $this-> set ('processo', $processo);
        $this->Processo->id = $id;
        if ($this->request->is('get')){
            $this->request->data = $this->Processo->findById($id);
            $this->set('processo', $this->Processo->findById($id));
            $this->set('encarregado', $this-> ViewMilitar-> getPessoa($this->request->data['Processo']['encarregado']));
            $this->set('instaurador', $this-> ViewMilitar-> getPessoa($this->request->data['Processo']['instaurador']));
            $this->set('escrivao', $this-> ViewMilitar-> getPessoa($this->request->data['Processo']['escrivao']));
            $this->set('investigado', $this-> ViewMilitar-> getPessoa($this->request->data['Processo']['investigado']));
            $this->set('criador', $this-> ViewMilitar-> getPessoa($this->request->data['Processo']['criador_processo_id']));
            $this->set('id', $id);
        }
    }

    //ACL: AUT INST E CORREGEDORIA
    function novo() {
        $this->layout= 'default';
        $this->loadModel('Tipo_processo');
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
            $this -> request -> data ['Processo']['situacoes_id'] = 1;
            $this -> request -> data ['Processo']['estados_id'] = 1;
            $this -> request -> data ['Processo']['posse_id'] = 3;
            $this -> request -> data ['Processo']['prorrogacoes'] = 0;
            $this -> request -> data ['Processo']['previsao_termino'] = $termino->format('Y-m-d');
            $data_bgo = $this -> request -> data ['Processo']['data_bgo'];
            $this -> request -> data ['Processo']['ano'] = date("Y", strtotime($data_bgo));
            $numero_ultimo_processo = $this -> Processo -> find('first', array('order' => array('Processo.num_ordem'=>'desc'), 'conditions'=>array('Processo.ano'=>$this-> request-> data ['Processo']['ano'], 'Processo.obm'=>$this-> request-> data ['Processo']['obm'])));
            if ($numero_ultimo_processo['Processo']['num_ordem']){
               $this -> request -> data ['Processo']['num_ordem'] = $numero_ultimo_processo['Processo']['num_ordem'] + 1;
            }else{
                $this -> request -> data ['Processo']['num_ordem'] = 1;
            }
            $this -> request -> data ['Processo']['num_processo'] = $this -> request -> data ['Processo']['num_ordem'].'/'.$this -> request -> data ['Processo']['ano'].'-'.$this -> request -> data ['Processo']['obm'];
            if (!($this -> request -> data['Processo']['num_portaria'])){
                $this -> request -> data ['Processo']['num_portaria'] = $this -> request -> data ['Processo']['num_processo'];
            }
          
                //            $dataSourceProcesso = $this-> Processo ->getDataSource();
                //            $dataSourceProcesso->begin();    
            $this -> Processo ->create();
            if ($this -> Processo -> save($this-> request-> data)) {
                //pr($this -> request -> data);
                //echo 2;
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
                $this -> redirect(array('action' => 'lista'));
                $this -> Flash->success('Processo adicionado');
            }
            else{
//                $dataSourceProcesso->rollback();
                //pr($this -> request -> data);
                //echo 3;
                //die();
                $this -> redirect(array('action' => 'lista'));
                $this-> Flash-> success('Houve um erro, processo não adicionado');
            }
        }
    }



    function tramitar(){
        $this->loadModel('Tramitacao');
        $this->loadModel('Grupo');
        if ($this->request->is('post')) {
            if ($this->Tramitacao->save($this->request->data)) {
                $id = $this->request->data['Tramitacao']['processos_id'];
                $funcao_recebe_id = $this->request->data['Tramitacao']['funcao_recebe_id'];
                $this -> Flash->success('Processo tramitado');
                $this -> Processo ->id = $id;
                if( ($this->request->data['Tramitacao']['funcao_entrega_id'] == 3 || $this->request->data['Tramitacao']['funcao_entrega_id'] == 4) &&
                    $this->request->data['Tramitacao']['funcao_recebe_id'] == 2 ){
                        $this-> Processo ->saveField('estados_id', 4);        
                }elseif($this->request->data['Tramitacao']['funcao_entrega_id'] == 2 &&
                        $this->request->data['Tramitacao']['funcao_recebe_id'] == 3){
                            $this-> Processo ->saveField('estados_id', 1);
                }elseif($this->request->data['Tramitacao']['funcao_entrega_id'] == 2 &&
                        $this->request->data['Tramitacao']['funcao_recebe_id'] == 4){
                    $this-> Processo ->saveField('estados_id', 3);
                }
                $this-> Processo ->saveField('posse_id', $funcao_recebe_id);
                $this -> redirect(array('action' => 'detalhe',$id));
                $this -> Flash->success('Processo tramitado');
            }
            else{
                $this->Flash->success('Houve um erro, processo Não tramitado');
            }
        }
    }

    //ACL: AUT INST, CORREGEDORIA E COMANDO?
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
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this-> Flash -> success('Processo prorrogado');
                }else{
                    $dataSourceProrrogacao -> rollback();
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this->Flash->success('Houve um erro, não foi possÃ­vel prorrogar o processo');
                }
            }

        }
    }

    //ACL: AUT INST, CORREGEDORIA E COMANDO
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
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this-> Flash -> success('Processo suspenso');
                }else{
                    $dataSourceSuspensao -> rollback();
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this->Flash->success('Houve um erro, não foi possível suspender o processo');
                }
            }
        }
    }
    
    //ACL: AUT INST, CORREGEDORIA E COMANDO
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
                $this -> redirect(array('action' => 'detalhe',$id));    
                $this-> Flash -> success('Processo reaberto');
            }else{
                $dataSourceSuspensao -> rollback();
                $this -> redirect(array('action' => 'detalhe',$id));
                $this->Flash->success('Houve um erro, não foi possÃ­vel suspender o processo');
            }
        }else{
            $dataSourceSuspensao -> rollback();
            $this -> redirect(array('action' => 'detalhe',$id));
            $this->Flash->success('Houve um erro, não foi possÃ­vel suspender o processo');
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
                    $this->Flash->success('Houve um erro, não foi possÃ­vel suspender o processo');
                }
            }

        }
        */

    function enviarDocumento(){
        $this->loadModel('Tipo_documento');
        $uploadData = '';
        if ($this-> request-> is('post')) {
            $numero_de_arquivos_no_processo = str_pad(1 + $this-> Documento-> find('count', array('conditions' => array('Documento.processo_id' => $this-> request-> data['Documento']['processo_id']))), 3, '0', STR_PAD_LEFT);
            if(!empty($this-> request-> data['Documento']['arquivo']['name'] )){
                $processo = $this-> Processo-> findById($this-> request-> data['Documento']['processo_id']);
                $tipo_documento = $this-> Tipo_documento-> findById($this-> request-> data['Documento']['tipo_documento_id']);
                $tipo_processo = $processo['Tipo_processo']['descricao'];
                $pasta_do_processo = str_replace('/','_',$processo['Processo']['num_processo']);
                $fileName = $numero_de_arquivos_no_processo.'_'.$tipo_documento['Tipo_documento']['descricao'].'.pdf';
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
                        $this-> request-> data ['Documento']['erro_arquivo'] = $this->request-> data ['Documento']['arquivo']['error'];;
                        $this-> request-> data ['Documento']['tamanho_arquivo'] = $this-> request-> data ['Documento']['arquivo']['size'];;
                        $this-> request-> data ['Documento']['numero_de_ordem'] = $numero_de_arquivos_no_processo;                      
                        if ($this->Documento->save($this-> request-> data)) {
                            $id = $this-> request -> data['Documento']['processo_id'];
                            $this -> redirect(array('controller'=>'processos','action' => 'detalhe',$id));
                            $this->Flash->success(__('Arquivo enviado com sucesso'));
                        }else{
                            echo '1';
                            $this->Flash->error(__('Arquivo não enviado por erro interno'));
                        }
                    }else{
                        echo '2';
                        $this->Flash->error(__('Arquivo não enviado por erro interno'));
                    }
                }else{
                    echo 'pasta nao criada ainda';
                    $this->Flash->error(__('Por favor envie o arquivo para upload novamente'));
                }
            }else{
                echo '3';
                $this->Flash->error(__('Arquivo não enviado por erro interno'));
            }
        }

        $this->set('uploadData', $uploadData);
    }


    function abrirDocumento($tipo=null, $num=null, $doc=null) {
        if(isset($_GET['hash'])){
            $hash = $_GET['hash'];
            $salt = Configure::read('Security.salt');
            $hash_valido = md5($salt.$tipo.$num.$doc);
            if($hash != md5($salt.$tipo.$num.$doc)){
                //$this->redirect( '/users/member_login' );
                $this->Session->setFlash( __('Informações para acesso ao link inválidas!'), 'default', array( 'class' => 'error-message') );
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

    public function resumo($id_processo=null){
        $this->layout = 'ajax';
        $this->set(compact('id_processo'));
    }

    function emitirParecer(){
        $this-> loadModel('Parecer');
        if ($this->request->is('post')) {
            $dataSourceParecer = $this-> Parecer-> getDataSource();
            $dataSourceParecer-> begin();
            $this-> Parecer-> create();
            if ($this-> Parecer-> save($this->request->data)) {
                $id = $this-> request-> data['Parecer']['processo_id'];
                $this-> Processo-> id = $id;
                //Se é um parecer de relatório
                if($this->request->data['Parecer']['envios_id'] == 1){
                    //se foi homologado
                    if ($this->request->data['Parecer']['tipo_id'] == 1){
                        $funcao_recebe_id = 4;
                        $despacho = 'Relatório homologado pela corregedoria';
                        $this-> Processo-> set(array('estados_id'=>3,'posse_id'=>$funcao_recebe_id));
                    //se foi rejeitado                        
                    }elseif ($this->request->data['Parecer']['tipo_id'] == 2) {
                        $funcao_recebe_id = 3;
                        $despacho = 'Relatório rejeitado pela corregedoria';
                        $this-> Processo-> set(array('estados_id'=>1,'posse_id'=>$funcao_recebe_id));
                    }
                //Se é um parecer de solução                    
                }elseif ($this->request->data['Parecer']['envios_id'] == 2) {
                    //se foi homologado
                    if ($this->request->data['Parecer']['tipo_id'] == 1){
                        $funcao_recebe_id = 2;
                        $despacho = 'Solução homologada pela corregedoria';
                        $this-> Processo-> set(array('estados_id'=>5));
                    //se foi rejeitado                        
                    }elseif ($this->request->data['Parecer']['tipo_id'] == 2) {
                        $funcao_recebe_id = 4;
                        $despacho = 'Solução rejeitada pela corregedoria';
                        $this-> Processo-> set(array('estados_id'=>3,'posse_id'=>$funcao_recebe_id));
                    }
                }
                if($this-> Processo-> save()){
                    $this-> loadModel('Tramitacao');
                    $dataSourceTramitacao = $this-> Tramitacao-> getDataSource();
                    $dataSourceTramitacao -> begin();
                    $tramitacao = $this-> Tramitacao-> create();
                    $tramitacao = $this-> Tramitacao-> set(array('funcao_entrega_id'=>2,'funcao_recebe_id'=>$funcao_recebe_id,'usuario_tramita_id'=>$this-> request-> data['Parecer']['emissor_id'],'processos_id'=>$id,'despacho'=>$despacho));
                    if ($this-> Tramitacao-> save($tramitacao)) {
                        $dataSourceTramitacao-> commit();
                        $dataSourceParecer-> commit();
                        $this -> redirect(array('controller'=>'processos','action' => 'detalhe',$id));
                        $this -> Flash->success('Parecer emitido com sucesso');
                    }
                    else{
                        $dataSourceTramitacao -> rollback();
                        $dataSourceParecer -> rollback();
                        $this -> redirect(array('action' => 'detalhe',$id));
                        $this->Flash->success('Houve um erro, não foi possÃ­vel emitir o parecer');
                    }
                }else{
                    $dataSourceParecer -> rollback();
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this->Flash->success('Houve um erro, não foi possÃ­vel emitir a solução');
                }
            }else{
                $dataSourceParecer -> rollback();
                $this -> redirect(array('action' => 'detalhe',$id));
                $this->Flash->success('Houve um erro, não foi possÃ­vel emitir a solução');
            }
        }
    }

    
    public function solucionar(){
        $this-> loadModel('Solucao');
        if ($this-> request ->is('post')){
            $dataSourceSolucao = $this -> Solucao -> getDataSource();
            $dataSourceSolucao -> begin();
            $this -> Solucao -> create();
            if ($this-> Solucao ->save($this->request->data)){                        
                $id = $this-> request -> data['Solucao']['processo_id'];
                $this -> Processo -> id = $id;
                $this -> Processo -> set(array('estados_id'=>4,'posse_id'=>2));
                
                if ($this -> Processo -> save()){
                    $this->loadModel('Tramitacao');
                    $dataSourceTramitacao = $this -> Tramitacao -> getDataSource();
                    $dataSourceTramitacao-> begin();
                    $tramitacao = $this-> Tramitacao-> create();
                    $tramitacao = $this -> Tramitacao -> set(array('funcao_entrega_id'=>4,'funcao_recebe_id'=>2,'usuario_tramita_id'=>$usuario_atual['cpf'],'processos_id'=>$id,'despacho'=>'soluçao emitida pelo instaurador do processo'));
                    if($this-> Tramitacao-> save($tramitacao)){
                        $dataSourceTramitacao -> commit();
                        $dataSourceSolucao -> commit();
                        $this -> redirect(array('action' => 'detalhe',$id));
                        $this-> Flash -> success('Solução emitida e processo tramitado Ã  corregedoria');
                    }else{
                    $dataSourceTramitacao -> rollback();
                    $dataSourceSolucao -> rollback();
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this->Flash->success('Houve um erro, não foi possÃ­vel emitir a solução');
                    }
                }else{
                    $dataSourceSolucao -> rollback();
                    $this -> redirect(array('action' => 'detalhe',$id));
                    $this->Flash->success('Houve um erro, não foi possÃ­vel emitir a solução');
                }
            }
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
                $novoPath = PATH_DOCUMENTOS.DS.$tipo_processo+'NÂº '.$numero_processo;
                
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
                    $this->Session->setFlash("Não foi possÃ­vel fazer o carregamento. Tente novamente.", 'default', array( 'class' => 'error-message'));
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
                $this -> redirect(array('action' => 'detalhe',$id));
                $this->Flash->success('Processo editado');
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
            $this->redirect(array('action' => 'lista'));
            $this->Flash->success('Serviço extra removido');
        }
    }

    function filtro(){
        echo $this->element('menu/menu_left');
    }
}