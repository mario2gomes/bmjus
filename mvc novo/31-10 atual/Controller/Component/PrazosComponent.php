<?php 

class PrazosComponent extends Component {

	public function data_termino($inicio,$prazo){
	    $termino = new DateTime($inicio);
	    $termino -> add (new DateInterval("P".$prazo."D"));
	    //$termino = $termino -> format("d/m/Y");
	    return $termino;
	}

	function progresso($inicio,$prazo){
	    $hoje = date_create();
	    $inicio = date_create($inicio);
	    $concluso = date_diff($hoje,$inicio);
	    $concluso = $concluso->days;
	    $prog = 100 * $concluso / $prazo;
	    if ($prog > 100){
	    	$prog = 100;
	    }
	    $progresso = $prog.'%';
	    return $progresso;

	}

	function resto($inicio,$prazo){
	    $hoje = date_create();
	    $inicio = date_create($inicio);
	    $resto = $prazo - date_diff($hoje,$inicio)->days;
	    return $resto;
	}

	function dias_feriados($ano = null){
	  if ($ano === null)
	  {
	    $ano = intval(date('Y'));
	  }

	  $pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
	  $dia_pascoa = date('j', $pascoa);
	  $mes_pascoa = date('n', $pascoa);
	  $ano_pascoa = date('Y', $pascoa);

	  $feriados = array(
	    // Tatas Fixas dos feriados Nacionail Basileiras
	    mktime(0, 0, 0, 1,  1,   $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
	    mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei nº 662, de 06/04/49
	    mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
	    mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independência - Lei nº 662, de 06/04/49
	    mktime(0, 0, 0, 10,  12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
	    mktime(0, 0, 0, 11,  2,  $ano), // Todos os santos - Lei nº 662, de 06/04/49
	    mktime(0, 0, 0, 11, 15,  $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
	    mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei nº 662, de 06/04/49

	    // These days have a date depending on easter
	    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa),//2ºfeira Carnaval
	    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa),//3ºfeira Carnaval	
	    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa),//6ºfeira Santa  
	    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa),//Pascoa
	    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa),//Corpus Cirist
	  );

	  //sort($feriados);

	  return $feriados;
	}


	function termino_em_dia_util($inicio, $prazo){
		$termino = $this-> data_termino($inicio, $prazo) -> format('Y-m-d');
		$termino = strtotime($termino);
		$dia_semana = date('N', $termino);
		$feriados = $this->dias_feriados(date('Y',$termino));
		if (in_array($termino, $feriados) || $dia_semana>5){
			$prazo = $prazo+1;
			return $this -> termino_em_dia_util($inicio, $prazo);
		}
		else{
			$termino = $this -> data_termino($inicio,$prazo);
			return $termino;
		}
	}

	function verifica_atraso($inicio, $prazo){
		$termino = $data_termino($inicio, prazo);
		if (in_array($termino, dias_feriados($termino))){

		}

	}
	
}

?>