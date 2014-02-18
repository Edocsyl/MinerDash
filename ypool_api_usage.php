<?php
/**
* @author Edocsyl <kaj@edocsyl.ch>
* @version 1.0
* @category YPool API
* @copyright Copyright (c) 2014, gigaIT.net
* @license Apache License 2.0
*/

require 'ypool.php';

//Parameter is the api-key. If you call something else than the global_stats an api-key is required.
$y = new YPool(); 


echo '<pre>';
print_r($y->global_stats(Coins::DOGE));
echo '</pre>';

?>