<?php 
define('__ROOT__', dirname(__FILE__)); 
require_once(__ROOT__.'back/connection.php');
require_once(__ROOT__.'back/api/User.php');
require_once(__ROOT__.'back/api/Item.php');

$p = new User(1, "pedroca", "omsdjfoj@", "9320-11");
?>
