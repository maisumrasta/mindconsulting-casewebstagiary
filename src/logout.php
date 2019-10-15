<?php
    //indica o uso de sessions
    session_start();
    //destroi a sessao
    unset($_SESSION['email']);
    //redireciona para index
    header('Location: index.php');
    //fecha todos os headers
    exit();