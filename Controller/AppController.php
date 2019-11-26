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

    public $helpers = array ('Html','Form', 'Flash', 'CakePtbr.Formatacao');
	public $components = array(
        'Flash',
        'Prazos',
/*        'Session',
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
                'plugin' => null
            ),
            'logoutRedirect' => array(
                'controller' => 'usuarios',
                'action' => 'login',
            ),
            'loginRedirect' => array(
                'controller' => 'painel',
                'action' => 'index',
                'plugin' => false
            )
           ),
*/
//          'Acl'
//        'DebugKit.Toolbar'
      );

	function beforeFilter(){
        $this->loadModel('ViewMilitar');
        $this->loadModel('Usuario');
        $this->loadModel('Processo');
        
        //$Usuario = $this-> ViewMilitar->getPessoa(287555); 
        $Usuario_atual = $this-> ViewMilitar->getPessoa('02382122463'); // administrador       
        //$Usuario_atual = $this-> ViewMilitar->getPessoa('20827202415'); // corregedoria       
        //$Usuario_atual = $this-> ViewMilitar->getPessoa('05125027499'); // encarregado       
        //$Grupo = pr($this-> Session-> read('Auth'));;
        //$Grupo_atual = 4;
        //$this->set('processos',$this-> Processo-> find('all'));
        $this->set('usuario_atual',$Usuario_atual);
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