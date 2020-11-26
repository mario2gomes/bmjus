<?php
/**
 * Arquivo para adapta��o da aplica��o para Portugu�s-Brasil
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

// Tradu��o das mensagens do core
include CakePlugin::path('CakePtbr') . 'Config' . DS . 'traducao_core.php';

// Altera��o das regras de inflections
include CakePlugin::path('CakePtbr') . 'Config' . DS . 'inflections.php';
