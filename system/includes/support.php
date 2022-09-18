<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solutiom 2016
 * @license Commercial License
 * 
 * @package Plugin Maker
 */
 
$query = '/?invoice=' . PURCHASE_CODE;
$content = '<iframe src="' . SUPPORT_URL . $query . '" style="border:0px none;height:100%;width:100%;min-height:480px;"></iframe>';

define('JZ_CONTENT', $content);

?>