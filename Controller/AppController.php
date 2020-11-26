<?php 
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('Folder','Utility');
App::uses('File','Utility');
App::uses('HttpSocket','Network/Http');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {

    public $helpers = array ('Html','Form', 'Session', 'Flash', 'CakePtbr.Formatacao');
	public $components = array(
        'Acl',
        'Flash',
        'Prazos',
        'Auth' => array(
            'flash' => array(
                'element' => 'error',
                'key' => 'auth',
                'params' => array()
            ),
            'authError' => 'Você não tem permissão para acessar essa funcionalidade.',
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers'),
                'all' => array('userModel' => 'Usuario')
            ),

            'loginAction' => array(
                'controller' => 'usuarios',
                'action' => 'login',
            ),

            'logoutRedirect' => array(
                'controller' => 'usuarios',
                'action' => 'login',
            ),

            'loginRedirect' => array(
                'controller' => 'processos',
                'action' => 'index',
            )
        ),
        'Session',
//      'DebugKit.Toolbar'
      );

	function beforeFilter(){
        $this->Auth->allow();
        $this->loadModel('ViewMilitar');
        $this->loadModel('Usuario');
        $this->loadModel('Processo');
        

        $this-> loadModel('Documento');
        $documentos = $this-> Documento-> find('all', ['order'=> ['Documento.numero_de_ordem'=>'ASC']]);
        $this-> set('documentos',$documentos);

        $this->loadModel('Tipo_documento');
        $tipo_documento = $this-> Tipo_documento -> find('list', array('fields'=>array('descricao')));
        $this->set('tipo_documentos', $tipo_documento);

        //$usuario_atual = $this-> ViewMilitar->getPessoa('02382122463'); // administrador       
        //$usuario_atual = $this-> ViewMilitar->getPessoa('64796094415'); // instaurador       
        //$usuario_atual = $this-> ViewMilitar->getPessoa('78674611400'); // corregedoria       
//trocar o CPF entre parenteses pelo id dinamico do usuário da sessão
        //pr($this-> Auth);
        $usuario_cpf = $this-> Session-> read()['Auth']['User']['cpf'];
        $usuario_atual = $this-> ViewMilitar->getPessoa($usuario_cpf); // encarregado
        //pr($usuario_atual);
        //App::uses('HttpSocket','Network/Http');

        //$httpsocket = new HttpSocket();
        //$resposta = $httpsocket->get('https://nominatim.openstreetmap.org/search?q=rua+industrial+climerio+sarmento&format=json');
        //pr($resposta);



        
        //$Grupo = pr($this-> Session-> read('Auth'));;
        //$Grupo_atual = 4;
        //$this->set('processos',$this-> Processo-> find('all'));
        $this->set('usuario_atual',$usuario_atual);
        //$this->set('grupo_atual',$Grupo_atual);
        //pr ('Grupo id: '.$Grupo_atual);
        //pr ('Usuário: ');
        //pr($Usuario_atual);

        //Configure AuthComponent (de acordo com o tutorial cakephp, mas essa configuração já está no component auth)
/*        $this->Auth->loginAction = array(
          'controller' => 'users',
          'action' => 'login'
        );
        $this->Auth->logoutRedirect = array(
          'controller' => 'users',
          'action' => 'login'
        );
        $this->Auth->loginRedirect = array(
          'controller' => 'posts',
          'action' => 'add'
        );
*/
/*        $allow = array(
            'escalas' => array(
                'permutas' => array(
                    'confirmar'
                )
            ),
            'roi' => array(
                'fotos' => array(
                    'upload'
                )
            ),
            'uploader' => array(
                'upload' => array(
                    'fazer'
                )
            ),
            'certidao' => array(
                'gestao' => array(
                    'imprimir', 
                    'qrcode'
                )
            )
        );

        $plugin = $this->params['plugin'];
        $controller = $this->params['controller'];
        $action = $this->params['action'];
        //Checa as ações públicas e libera
        if (isset($allow[$plugin][$controller])) {
            if (in_array($action, $allow[$plugin][$controller])) {
                $this->Auth->allow();
            }
        }
        
        //API
      $controller = $this->params['controller'];
        if($controller == 'api'){
            $this->Auth->allow();
        }
*/        
        
	}
	
	function getUserId($cpf) {
        $usuario_atual = $cpf;
		return $usuario_atual;
	}

    function getGrupoId($id){
        $usuario_atual['grupo'] = $id;
        return $usuario_atual['grupo'];
    }
}