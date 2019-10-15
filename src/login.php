<?php
    //diz para o php que iremos trabalhar com session
    session_start();
    //importa o arquivo conexao.php
    include('conexao.php');
    //valida se a requisição de post foi ralizada com campos em branco
    if(empty($_POST['email']) || empty($_POST['senha'])) {
        echo "Algo deu errado";
        header('Location: index.php');
        exit();
    };
    //msqli_real_escape_string trata entradas de caracteres especiais contra sql injection
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    //query para busca de usuario e senha digitados no formulario
    $query = "select id, email, nome, nivel from users where email = '{$email}' and senha = md5('{$senha}')";

    //aplica consulta no banco da query gerada
    $result = mysqli_query($conexao, $query);

    //verifica quantas linhas retornaram
    $row = mysqli_num_rows($result);
    //se o registro for único
    if ($row == 1) {
        //coleta o nivel
        if($nivelUsuario = mysqli_query($conexao, $query)){
            $userNivel = mysqli_fetch_row($nivelUsuario);
            $nivelUsuario = $userNivel[3];
        }
        //insere o acesso na tabela logacess
            //cria a query
        $queryLogAcess = "insert into logacess (email, nivel) values ('{$email}', {$nivelUsuario})";

            //prepara a query no banco
        $inputAcess = mysqli_prepare($conexao, $queryLogAcess);

            //executa a query
        mysqli_stmt_execute($inputAcess);

        //registra a session
        $_SESSION['email'] = $email;
        //redireciona para o painel
        header('Location: painel.php');
        exit();
    } 
    //senao retrocede para index.php
    else {
        header('Location: index.php');
        exit();
    };