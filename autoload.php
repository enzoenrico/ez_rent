<?php 
session_start();
define('__ROOT__', dirname(__FILE__)); 
require_once(__ROOT__.'/back/connection.php');
require_once(__ROOT__.'/back/api/User.php');
require_once(__ROOT__.'/back/api/Item.php');
require_once(__ROOT__.'/back/api/Aluguel.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
