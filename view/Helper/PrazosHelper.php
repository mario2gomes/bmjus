<?php
App::uses('AppHelper', 'View/Helper');
class PrazosHelper extends AppHelper {
    
    function data_termino($inicio,$prazo){
	    $termino = new DateTime($inicio);
	    $termino -> add (new DateInterval("P".$prazo."D"));
	    $termino = $termino -> format("d/m/Y");
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
}
?>