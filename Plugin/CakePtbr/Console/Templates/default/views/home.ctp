<?php
$output = "
<iframe src=\"http://cakephp.org/bake-banner\" width=\"830\" height=\"160\" style=\"overflow:hidden; border:none;\">
	<p>For updates and important announcements, visit http://cakefest.org</p>
</iframe>\n";
$output = "<h2>\"" . Inflector::humanize($app) . "\" gerado pelo Bake do CakePHP!</h2>\n";
$output .="
<?php
App::uses('Debugger', 'Utility');
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>
<p>
<?php
	if (version_compare(PHP_VERSION, '5.2.8', '>=')):
		echo '<span class=\"notice success\">';
			echo __d('cake_dev', 'Sua vers�o do PHP � 5.2.8 ou superior.');
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
			echo __d('cake_dev', 'Sua vers�o do PHP � muito antiga. Voc� precisa PHP 5.2.8 ou superior para utilizar o CakePHP.');
		echo '</span>';
	endif;
?>
</p>
<p>
<?php
	if (is_writable(TMP)):
		echo '<span class=\"notice success\">';
			echo __d('cake_dev', 'Seu diret�rio tmp est� habilitado para escrita.');
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
			echo __d('cake_dev', 'Seu diret�rio tmp NÃO est� habilitado para escrita.');
		echo '</span>';
	endif;
?>
</p>
<p>
<?php
	\$settings = Cache::settings('_cake_core_');
	if (!empty(\$settings)):
		echo '<span class=\"notice success\">';
				echo __d('cake_dev', 'O %s est� sendo usado para cache. Para alterar, edite o arquivo APP/Config/core.php ', '<em>'. \$settings['engine'] . 'Engine</em>');
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
				echo __d('cake_dev', 'Seu cache NÃO est� funcionando. Por favor, verifique suas configura��es em APP/Config/core.php');
		echo '</span>';
	endif;
?>
</p>
<p>
<?php
	\$filePresent = null;
	if (file_exists(APP . 'Config' . DS . 'database.php')):
		echo '<span class=\"notice success\">';
			echo __d('cake_dev', 'Seu arquivo de configura��o do banco de dados est� presente.');
			\$filePresent = true;
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
			echo __d('cake_dev', 'Seu arquivo de configura��o do banco de dados NÃO est� presente.');
			echo '<br/>';
			echo __d('cake_dev', 'Renomeie o arquivo APP/Config/database.php.default para APP/Config/database.php');
		echo '</span>';
	endif;
?>
</p>
<?php
if (isset(\$filePresent)):
	App::uses('ConnectionManager', 'Model');
	try {
		\$connected = ConnectionManager::getDataSource('default');
	} catch (Exception \$e) {
		\$connected = false;
	}
?>
<p>
<?php
	if (\$connected && \$connected->isConnected()):
		echo '<span class=\"notice success\">';
			echo __d('cake_dev', 'Cake est� apto para conectar no banco de dados.');
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
			echo __d('cake_dev', 'Cake NÃO est� apto para conectar no banco de dados.');
		echo '</span>';
	endif;
?>
</p>
<?php endif;?>
<?php
	App::uses('Validation', 'Utility');
	if (!Validation::alphaNumeric('cakephp')) {
		echo '<p><span class=\"notice\">';
		__d('cake_dev', 'O PCRE n�o foi compilado com suporte a Unicode.');
		echo '<br/>';
		__d('cake_dev', 'Recompile o PCRE com suporte a Unicode, adicionando <code>--enable-unicode-properties</code> ao configurar');
		echo '</span></p>';
	}
?>\n";
$output .= "<h3><?php echo __d('cake_dev', 'Editando esta p�gina'); ?></h3>\n";
$output .= "<p>\n";
$output .= "<?php\n";
$output .= "\techo __d('cake_dev', 'Para alterar o conte�do desta p�gina, edite: %s\n";
$output .= "\t\tPara alterar o layout, edite: %s\n";
$output .= "\t\tVoc� tamb�m pode adicionar alguns estilos de CSS para suas p�ginas em: %s',\n";
$output .= "\t\tAPP . 'View' . DS . 'Pages' . DS . 'home.ctp.<br />',  APP . 'View' . DS . 'Layouts' . DS . 'default.ctp.<br />', APP . 'webroot' . DS . 'css');\n";
$output .= "?>\n";
$output .= "</p>\n";
?>