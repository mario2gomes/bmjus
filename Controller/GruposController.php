<?php

App::uses('AppController', 'Controller');

class GruposController extends AppController {
    //public $helpers = array ('Html','Form','Flash','Estatistica');
    public $components = array('Flash','Acl');
//Necess�rio para o ACL
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
}

?>