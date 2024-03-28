<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/connection.php');
require_once(__ROOT__.'/api/User.php');
require_once(__ROOT__.'/api/Item.php');
$u = new User(1, 'user', '', '');
?>
