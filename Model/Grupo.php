<?php
App::uses('AppModel', 'Model');

class Grupo extends AppModel {
    public $useTable = 'grupos';
    public $tablePrefix = 'cor_';
    public $displayField = 'dsc';    
    public $actsAs = array('Acl' => array('type' => 'requester'));
    
    public function parentNode() {
        return null;
    }
}
?>