<?php
//define em alias as configurações de conexão
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'CaseMindConsulting');

//realiza a conexão ou apresenta erro
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die("Erro ao conectar com banco de dados");
