<?php
/**
 * Vendor para centralizar a lista de estados brasileiros
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Estados
 *
 */
class Estados {

/**
 * Lista dos estados brasileiros
 *
 * @return array Lista dos estados
 * @access public
 */
	public static function lista() {
		return array(
			'AC' => 'Acre',
			'AL' => 'Alagoas',
			'AP' => 'Amap�',
			'AM' => 'Amazonas',
			'BA' => 'Bahia',
			'CE' => 'Cear�',
			'DF' => 'Distrito Federal',
			'ES' => 'Espírito Santo',
			'GO' => 'Goi�s',
			'PA' => 'Par�',
			'PB' => 'Paraíba',
			'PR' => 'Paran�',
			'PE' => 'Pernambuco',
			'PI' => 'Piauí',
			'MA' => 'Maranh�o',
			'MT' => 'Mato Grosso',
			'MS' => 'Mato Grosso do Sul',
			'MG' => 'Minas Gerais',
			'RJ' => 'Rio de Janeiro',
			'RN' => 'Rio Grande do Norte',
			'RS' => 'Rio Grande do Sul',
			'RO' => 'Rondônia',
			'RR' => 'Roraima',
			'SC' => 'Santa Catarina',
			'SP' => 'S�o Paulo',
			'SE' => 'Sergipe',
			'TO' => 'Tocantins'
		);
	}

}
