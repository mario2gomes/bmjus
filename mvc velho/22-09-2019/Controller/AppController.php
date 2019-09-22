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
/*
	public $components = array(
        'Session',
        'Auth' => array(
            'flash' => array(
                'element' => 'error',
                'key' => 'auth',
                'params' => array()
            ),
            'authError' => 'Você não tem permissão para acessar essa funcionalidade.',
/*                'authorize' => array(
                    'Actions' => array('actionPath' => 'controllers'),
                    'all' => array('userModel' => 'Usuario')
            ),*/
    }

	function beforeFilter(){

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
	
	function getUserId() {
		return 1;
	}