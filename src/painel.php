<?php
    //avisa ao php o uso de sessions
    session_start();
    //importa o arquivo conexao.php
    include('conexao.php');
    //verifica se esta ou não logado
    include('verificaLogin.php');
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Case Mind Consulting</title>

    <!-- CDN CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- CSS -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center bg-info">
  <?php
  //prepara o parâmetro de busca
    $paramQuery = $_SESSION['email'];
    //prepara query de busca
    $query = "SELECT nivel, nome FROM users WHERE email = '{$paramQuery}'";
    //método mysqli_prepare têm retorno booleano
    if ($result = mysqli_query($conexao, $query)) {
        $row = mysqli_fetch_row($result);
        $nivelUser = (int) $row[0];
        $nomeUser = $row[1];

        mysqli_free_result($result);
    };
?>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <a class="navbar-brand" href="#">Case Mind Consulting</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Nav" aria-controls="Nav" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="Nav">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $nomeUser?></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">Sair</a>
        </div>
      </li>
    </ul>
    </div>
    </nav>
  </div>
  <div class="container">
    
    <?php 
      if($nivelUser == 0) {
        $queryAcessos = "SELECT * FROM logacess";
        echo "<table class='table table-dark'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col'>#</th>";
        echo "<th scope='col'>email</th>";
        echo "<th scope='col'>nivel de acesso</th>";
        echo "<th scope='col'>data acessada</th>";
        echo "</tr>";
        echo  "</thead>";
        echo "<tbody>";

        if($dataAcessos = mysqli_query($conexao, $queryAcessos)) {
          while($rowAcess = mysqli_fetch_row($dataAcessos)) {
            echo "<tr>";
            echo "<th scope='row'>{$rowAcess[0]}</th>";
            echo "<td>{$rowAcess[1]}</td>";
            echo "<td>{$rowAcess[2]}</td>";
            echo "<td>{$rowAcess[3]}</td>";
            echo "</tr>";
          }
          echo "</thead>";
          echo "</tbody>";
        }
      }

      elseif($nivelUser == 1) {
      $queryUsuario = "SELECT * FROM users WHERE email = '{$paramQuery}'";

        echo "<table class='table table-dark'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col'>Nome</th>";
        echo "<th scope='col'>Email</th>";
        echo "<th scope='col'>Nivel</th>";
        echo "<th scope='col'>RG</th>";
        echo "<th scope='col'>CPF</th>";
        echo "</tr>";
        echo "</thead>";

      if($dadosUsuario = mysqli_query($conexao, $queryUsuario)) {
        $row = mysqli_fetch_row($dadosUsuario);
        $idUsuario = $row[0];
        $nomeUsuario = $row[1];
        $emailUsuario = $row[2];
        $nivelUsuario = $row[4];
        $rgUsuario = $row[5];
        $cpfUsuario = $row[6];
      };

      echo "<tr>";
      echo "<td>{$nomeUsuario}</td>";
      echo "<td>{$emailUsuario}</td>";
      echo "<td>{$nivelUsuario}</td>";
      echo "<td>{$rgUsuario}</td>";
      echo "<td>{$cpfUsuario}</td>";
      echo "</tr>";
        echo "</thead>";
      }
    ?>

  </div>
    <!-- CDN JS, Jquery e Popper do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
