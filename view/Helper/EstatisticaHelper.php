<?php
App::uses('AppHelper', 'View/Helper');
App::import('Usuario','Processo');
class EstatisticaHelper extends AppHelper {
	
public function ordenaArray(){
	$this-> Processo = new Processo();
	return $this-> Processo-> find('all', array('fields'=>array('Processo.data_bgo')));
}
	//Quantidade de processos ativos por grupo do usuário 
	public function processoAtual($cpf,$grupo){
        $this-> Processo = new Processo();
        $processosAtivos = 0;
        $processosAtivos = $processosAtivos + $this-> Processo-> find('count', array('conditions'=>array('Processo.'.$grupo => $cpf, 'Processo.estados_id !=' => 5)));
        return $processosAtivos;
	}

	//Data de entrega do ultimo Processo entregue por grupo do usuário
	public function ultimoEntregue($cpf,$grupo){
		$this-> Processo = new Processo();
		$processo = $this-> Processo-> find('first', array('conditions' => array('Processo.'.$grupo => $cpf, 'Processo.estados_id !=' => 5),'fields' => array('id','obm','num_processo','Tipo_processo.descricao')));
		if($processo){
			$nome_processo = $processo['Tipo_processo']['descricao'].' '.$processo['Processo']['num_processo'].' '.$processo['Processo']['obm'];
			return $nome_processo.'</br>'.' (processo aberto)';
		}else{
			$ultimoEntregue = $this-> Processo-> find('first', array('order' => array('	Processo.data_termino' => 'desc'), 'conditions' => array('Processo.'.$grupo => $cpf),'fields' => array('id','num_processo','Tipo_processo.descricao','data_termino')));
			if($ultimoEntregue){
				$nome_processo = $ultimoEntregue['Tipo_processo']['descricao'].' '.$ultimoEntregue['Processo']['num_processo'];
				return $nome_processo.'</br>'.$ultimoEntregue['Processo']['data_termino'];
				//$this-> Formatacao-> data($ultimoEntregue['Processo']['data_termino'])
			}else{
				return 0;
			}
		}

	}

	//Quantidade de processos já envolvido por grupo do usuário
	public function quantidadeProcessos($cpf,$grupo){
		$this-> Processo = new Processo();		
		$quantosProcessos = $this-> Processo-> find('count', array('conditions'=>array('Processo.estados_id' => 5, 'Processo.'.$grupo => $cpf)));
		return $quantosProcessos;
		}	


// Tudo junto:
/*
	public function processoAtual($cpf){
        $this-> Processo = new Processo();

        $groups = array('encarregado','instaurador','escrivao','investigado');
        $processosAtivos = 0;
        foreach ($groups as $group) {
        	$ativo = $this-> Processo-> find('count', array('conditions'=>array("Processo.".$group => $cpf, 'Processo.estados_id !=' => 5)));
        	$processosAtivos= $processosAtivos + $ativo;
        }
        return $processosAtivos;
	}

	public function ultimoEntregue($cpf){
		$this-> Processo = new Processo();		
		$ultimoEntregue = $this-> Processo-> find('first', array('order' => array('Processo.data_termino' => 'desc'), 'conditions'=>array('or'=>array('Processo.encarregado' => $cpf, 'Processo.instaurador' => $cpf)),'fields' => array('Processo.data_termino')));
		if($ultimoEntregue){
			return $ultimoEntregue['Processo']['data_termino'];
		}else{
			return 0;
		}

	}

	public function quantidadeProcessos($cpf){
		$this-> Processo = new Processo();		
		$quantosProcessos = $this-> Processo-> find('count', array('conditions'=>array('Processo.estados_id' => 5, 'or'=>array('Processo.encarregado' => $cpf, 'Processo.instaurador' => $cpf))));
		return $quantosProcessos;
		}
*/		
}
?>