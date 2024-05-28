<?php
session_start();
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/back/connection.php');
require_once(__ROOT__ . '/back/api/User.php');
require_once(__ROOT__ . '/back/api/Item.php');
require_once(__ROOT__ . '/back/api/Aluguel.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function showToast() {
        var toast = document.getElementById('toast_search');
        toast.style.display = 'block';
        setTimeout(function() {
            toast.style.display = 'none';
        }, 5000);
    }

    window.onload = function() {
        showToast();
    };
</script>