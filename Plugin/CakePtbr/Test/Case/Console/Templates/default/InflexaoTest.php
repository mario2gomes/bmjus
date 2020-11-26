<?php
/**
 * Teste do ajuste de inflex�o
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require CakePlugin::path('CakePtbr') . DS . 'Console' . DS . 'Templates' . DS . 'default' . DS . 'Inflexao.php';

/**
 * Inflexao
 *
 */
class InflexaoTest extends CakeTestCase {

/**
 * testAcentos
 *
 * @retun void
 * @access public
 */
	public function testAcentos() {
		$this->assertEqual('caminh�o', Inflexao::acentos('caminhao'));
		$this->assertEqual('P�o', Inflexao::acentos('Pao'));
		$this->assertEqual('can��o', Inflexao::acentos('cancao'));
		$this->assertEqual('can��es', Inflexao::acentos('cancoes'));
		$this->assertEqual('lim�es', Inflexao::acentos('limoes'));
		$this->assertEqual('m�es', Inflexao::acentos('maes'));

		$this->assertEqual('jo�o do caminh�o', Inflexao::acentos('joao do caminhao'));
		$this->assertEqual('jo�o_do_caminh�o', Inflexao::acentos('joao_do_caminhao'));
	}

}
