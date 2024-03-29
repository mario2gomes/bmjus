<?php
/**
 * Classe auxiliar para ajustar as palavras na gera��o dos templates
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Inflexao
 *
 */
class Inflexao {

/**
 * Ajusta as palavras para por acentos
 *
 * @param string $palavra Palavra a ser modificada
 * @return string Palavra com acento
 * @access public
 */
	public function acentos($palavra) {
		$espacamentos = array(' ', '_');
		foreach ($espacamentos as $espacamento) {
			if (strpos($palavra, $espacamento) !== false) {
				$palavra = explode($espacamento, $palavra);
				$saida = '';
				foreach ($palavra as $pedaco) {
					$saida .= Inflexao::acentos($pedaco) . $espacamento;
				}
				return rtrim($saida, $espacamento);
			}
		}
		if (preg_match('/(.*)cao$/', $palavra, $matches)) {
			return $matches[1] . '��o';
		}
		if (preg_match('/(.*)ao(s)?$/', $palavra, $matches)) {
			return $matches[1] . '�o' . (isset($matches[2]) ? $matches[2] : '');
		}
		if (preg_match('/(.*)coes$/', $palavra, $matches)) {
			return $matches[1] . '��es';
		}
		if (preg_match('/(.*)oes$/', $palavra, $matches)) {
			return $matches[1] . '�es';
		}
		if (preg_match('/(.*)aes$/', $palavra, $matches)) {
			return $matches[1] . '�es';
		}
		return $palavra;
	}

}
