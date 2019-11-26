<?php

App::uses('AppModel', 'Model');

class ViewMilitar extends AppModel {

    public $name = 'ViewMilitar';
    public $useDbConfig = 'bmrh';
    public $useTable = 'view_militares';
    public $displayField = 'cargo_nome';
    public $primaryKey = 'num_cpf';

    public $hasOne = array(
        'Usuario'=>array(
            'classname'=>'Usuario',
            'foreignKey'=>'cpf')
    );
    //Retorna os dados do limitar referente ao CPF informado
    public function getPessoa($cpf) {

//            $alocacao = new UsuariosSetor();
//            $setor = $alocacao->find('first', array('conditions'=>array('UsuariosSetor.mat_usuario'=>$mat)));
        $dados = array();
        $militar = $this->find('first', array('fields' => array('num_matricula', 'cargo_nome', 'obm_id', 'sig_obm','funcao_id','num_cpf'), 'conditions' => array('num_cpf' => $cpf)));

        if (count($militar)>0){
            //$dados['id'] = $militar['ViewMilitar']['id'];
            $dados['cargo_nome'] = $militar['ViewMilitar']['cargo_nome'];
            $dados['num_matricula'] = $militar['ViewMilitar']['num_matricula'];
            $dados['obm_id'] = $militar['ViewMilitar']['obm_id'];
            $dados['obm'] = $militar['ViewMilitar']['sig_obm'];
            $dados['funcao_id'] = $militar['ViewMilitar']['funcao_id'];
            $dados['cpf'] = $militar['ViewMilitar']['num_cpf'];
            $dados['grupo'] = $militar['Usuario']['grupo_bmjus'];
        }
        return $dados;
    }

    public function mat_valida($mat) {

        $valor = $this->find('count', array('conditions' => array('num_matricula' => $mat)));
        return $valor;
    }

    public function assinatura($id) {
        return $this->field('cargo_nome', array('id' => $id));
    }


    //Reetorna o nome de guerra com o cargo
    function getCargoNome($militarId = null) {

        $militar = $this->findById($militarId);

        if (!empty($militar)) {
            return $militar['ViewMilitar']['cargo_nome'];
        }
        return '';
    }

    //Retorna uma lista de nomes separados por vírgula
    function listaMilitares($string_ids) {

        $militares = explode(',', $string_ids);
        $result = array();

        foreach ($militares as $m) {
            $result[] = $this->getCargoNome($m);
        }

        return implode(', ', $result);
    }

    //Prepara o token para pre-popular o inputToken
    function preparaToken($string_ids) {
        if (empty($string_ids)) {
            return null;
        }

        $militares = $string_ids;
        if (!is_array($string_ids)) {
            $militares = explode(',', $string_ids);
        }

        $result = array();

        foreach ($militares as $m) {
            if (!empty($m)) {

                $temp = array();
                $temp['id'] = $m;
                $temp['name'] = utf8_encode($this->getCargoNome($m));
                $result[] = $temp;
            }
        }

        return json_encode($result);
    }

    /*
     * Retorna o telefone do militar
     */

    function getTelefone($id) {

        $this->id = $id;
        return $this->field('num_telefone');
    }

}

?>
