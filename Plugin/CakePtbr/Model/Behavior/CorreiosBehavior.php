<?php
/**
 * Behavior de acesso a servi�os dos Correios
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

// Tipo de frete
define('CORREIOS_SEDEX', 40010);
define('CORREIOS_SEDEX_A_COBRAR', 40045);
define('CORREIOS_SEDEX_10', 40215);
define('CORREIOS_SEDEX_HOJE', 40290);
define('CORREIOS_E_SEDEX', 81019);
define('CORREIOS_ENCOMENDA_NORMAL', 41017);
define('CORREIOS_PAC', 41106);

// Erros
define('ERRO_CORREIOS_PARAMETROS_INVALIDOS', -1000);
define('ERRO_CORREIOS_EXCESSO_PESO', -1001);
define('ERRO_CORREIOS_FALHA_COMUNICACAO', -1002);
define('ERRO_CORREIOS_CONTEUDO_INVALIDO', -1003);

App::uses('Xml', 'Utility');
App::uses('HttpSocket', 'Network/Http');

/**
 * CorreiosBehavior
 *
 * @link http://wiki.github.com/jrbasso/cake_ptbr/behavior-correios
 */
class CorreiosBehavior extends ModelBehavior {

/**
 * C�lculo do valor do frete
 *
 * @param object $model
 * @param integer $servico C�digo do servi�o, ver as defines CORREIOS_*
 * @param string $cepOrigem CEP de origem no formato XXXXX-XXX
 * @param string $cepDestino CEP de destino no formato XXXXX-XXX
 * @param float $peso Peso do pacote, em quilos
 * @param boolean $maoPropria Usar recurso de m�o pr�pria?
 * @param float $valorDeclarado Valor declarado do pacote
 * @param boolean $avisoRecebimento Aviso de recebimento?
 * @return mixed Array com os dados do frete ou integer com erro. Ver defines ERRO_CORREIOS_* para erros.
 * @access public
 */
	public function valorFrete(&$model, $servico, $cepOrigem, $cepDestino, $peso, $maoPropria = false, $valorDeclarado = 0.0, $avisoRecebimento = false) {
		// Valida��o dos parâmetros
		$tipos = array(CORREIOS_SEDEX, CORREIOS_SEDEX_A_COBRAR, CORREIOS_SEDEX_10, CORREIOS_SEDEX_HOJE, CORREIOS_ENCOMENDA_NORMAL);
		if (!in_array($servico, $tipos)) {
			return ERRO_CORREIOS_PARAMETROS_INVALIDOS;
		}
		
		if (!$this->_validaCep($cepOrigem) || !$this->_validaCep($cepDestino)) {
			return ERRO_CORREIOS_PARAMETROS_INVALIDOS;
		}
		if (!is_numeric($peso) || !is_numeric($valorDeclarado)) {
			return ERRO_CORREIOS_PARAMETROS_INVALIDOS;
		}
		if ($peso > 30.0) {
			return ERRO_CORREIOS_EXCESSO_PESO;
		} elseif ($peso < 0.0) {
			return ERRO_CORREIOS_PARAMETROS_INVALIDOS;
		}
		if ($valorDeclarado < 0.0) {
			return ERRO_CORREIOS_PARAMETROS_INVALIDOS;
		}

		// Ajustes nos parâmetros
		if ($maoPropria) {
			$maoPropria = 'S';
		} else {
			$maoPropria = 'N';
		}
		if ($avisoRecebimento) {
			$avisoRecebimento = 'S';
		} else {
			$avisoRecebimento = 'N';
		}

		$query = array(
			'resposta' => 'xml',
			'servico' => $servico,
			'cepOrigem' => $cepOrigem,
			'cepDestino' => $cepDestino,
			'peso' => $peso,
			'MaoPropria' => $maoPropria,
			'valorDeclarado' => $valorDeclarado,
			'avisoRecebimento' => $avisoRecebimento
		);
		$retornoCorreios = $this->_requisitaUrl('/encomendas/precos/calculo.cfm', 'get', $query);
		if (is_integer($retornoCorreios)) {
			return $retornoCorreios;
		}
		$Xml = new Xml($retornoCorreios);
		$infoCorreios = $Xml->toArray();
		if (!isset($infoCorreios['CalculoPrecos']['DadosPostais'])) {
			return ERRO_CORREIOS_CONTEUDO_INVALIDO;
		}
		extract($infoCorreios['CalculoPrecos']['DadosPostais']);
		return array(
			'ufOrigem' => $uf_origem,
			'ufDestino' => $uf_destino,
			'capitalOrigem' => ($local_origem == 'Capital'),
			'capitalDestino' => ($local_destino == 'Capital'),
			'valorMaoPropria' => $mao_propria,
			'valorTarifaValorDeclarado' => $tarifa_valor_declarado,
			'valorFrete' => ($preco_postal - $tarifa_valor_declarado - $mao_propria),
			'valorTotal' => $preco_postal
		);
	}

/**
 * Pegar o endere�o de um CEP específico
 *
 * @param object $model
 * @param string $cep CEP no format XXXXX-XXX
 * @return mixed Array com os dados do endere�o ou interger para erro. Ver defines ERRO_CORREIOS_* para os erros.
 * @access public
 */
	public function endereco(&$model, $cep) {
		if (!$this->_validaCep($cep, '-')) {
			return ERRO_CORREIOS_PARAMETROS_INVALIDOS;
		}

		$data = array(
			'resposta' => 'paginaCorreios',
			'data' => date('d/m/Y'),
			'dataAtual' => date('d/m/Y'),
			'servico' => CORREIOS_SEDEX,
			'cepOrigem' => $cep,
			'cepDestino' => $cep,
			'peso' => 1,
			'MaoPropria' => 'N',
			'valorDeclarado' => '',
			'avisoRecebimento' => 'N',
			'Altura' => '',
			'Comprimento' => '',
			'Diametro' => '',
			'Formato' => 1,
			'Largura' => '',
			'embalagem' => 116600055,
			'valorD' => ''
		);
		$retornoCorreios = $this->_requisitaUrl('/encomendas/prazo/prazo.cfm', 'post', $data);
		if (is_integer($retornoCorreios)) {
			return $retornoCorreios;
		}

		// Convertendo para o encoding da aplica��o. Isto s� funciona se a extens�o multibyte estiver ativa
		$encoding = Configure::read('App.encoding');
		if (function_exists('mb_convert_encoding') && $encoding != null && strcasecmp($encoding, 'iso-8859-1') != 0) {
			$retornoCorreios = mb_convert_encoding($retornoCorreios, $encoding, 'ISO-8859-1');
		}
		// Checar se o conte�do est� l� e reduzir o escopo de busca dos valores
		if (!preg_match('/\<b\>CEP:\<\/b\>(.*)\<b\>Prazo de Entrega/sm', $retornoCorreios, $matches)) {
			return ERRO_CORREIOS_CONTEUDO_INVALIDO;
		}
		$escopoReduzido = $matches[1];
		// Logradouro
		preg_match('/\<b\>Endere&ccedil;o:\<\/b\>\s*\<\/td\>\s*\<td[^\>]*>([^\<]*)\</', $escopoReduzido, $matches);
		$logradouro = $matches[1];
		// Bairro
		preg_match('/\<b\>Bairro:\<\/b\>\s*\<\/td\>\s*\<td[^\>]*>([^\<]*)\</', $escopoReduzido, $matches);
		$bairro = $matches[1];
		// Cidade e Estado
		preg_match('/\<b\>Cidade\/UF:\<\/b\>\s*\<\/td\>\s*\<td[^\>]*>([^\<]*)\</', $escopoReduzido, $matches);
		list($cidade, $uf) = explode('/', $matches[1]);

		$result = compact('logradouro', 'bairro', 'cidade', 'uf');
		return array_map('trim', $result);
	}

/**
 * Verificar se o CEP digitado est� correto
 *
 * @param string $cep CEP
 * @return boolean CEP Correto
 * @access protected
 */
	protected function _validaCep($cep) {
		return (bool)preg_match('/^\d{5}\-?\d{3}$/', $cep);
	}

/**
 * Requisita dados dos Correios
 *
 * @param string $url Caminho relativo da p�gina nos Correios
 * @param string $method M�todo de requisi��o (POST/GET)
 * @param array $query Dados para enviar na p�gina
 * @return string P�gina solicitada
 * @access protected
 */
	protected function _requisitaUrl($url, $method, $query) {
		$defaultHeader = array(
			'Origin' => 'http://www.correios.com.br',
			'Referer' => 'http://www.correios.com.br/encomendas/prazo/default.cfm',
			'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.1 (KHTML, like Gecko) Ubuntu/11.04 Chromium/14.0.835.202 Chrome/14.0.835.202 Safari/535.1'
		);
		$HttpSocket = new HttpSocket(array('request' => array('header' => $defaultHeader)));
		$uri = array(
			'scheme' => 'http',
			'host' => 'www.correios.com.br',
			'port' => 80,
			'path' => $url
		);
		if ($method === 'get') {
			$uri['query'] = $query;
			$retornoCorreios = trim($HttpSocket->get($uri));
		} else {
			$retornoCorreios = $HttpSocket->post($uri, $query);
		}
		if ($HttpSocket->response['status']['code'] != 200) {
			return ERRO_CORREIOS_FALHA_COMUNICACAO;
		}
		return $retornoCorreios;
	}

}
