<?php
//Abre conexao com o banco de dados
require_once 'conexao_bd.php';
//Inicializa Sessao 
session_start();
if (isset($_SESSION['logado'])) {
  $id = $_SESSION['id_usuario'];
  $sql = "SELECT * FROM cadastro_usuarios WHERE id_usuario  = '$id' ";
  $resultado = mysqli_query($conexao, $sql);
  $dados = mysqli_fetch_array($resultado);
  mysqli_close($conexao);//Fecha conexao com o banco de dados
  //verifica se usuario é um bibliotecario 
  if ($dados['tipo_usuario'] == 'B') {
    header('location: bibliotecario.php');
  } else {
    header('location: usuario.php');
  }
}
if (isset($_POST['btn-entrar'])) {
  $erros = array();
  $login = mysqli_escape_string($conexao, $_POST['login']);
  $senha = mysqli_escape_string($conexao, $_POST['senha']);
  if (empty($login) or empty($senha)) {
    $erros[] = "<li>Campo login e Senha nao foram prenchidos </li>";
  } else {
    $sql = "SELECT login FROM cadastro_usuarios WHERE login = '$login'";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0) {
      $senha = md5($senha);
      $sql = "SELECT * FROM cadastro_usuarios WHERE login = '$login' AND senha = '$senha'";
      $resultado = mysqli_query($conexao, $sql);
      if (mysqli_num_rows($resultado) > 0 ) {
        $dados = mysqli_fetch_array($resultado);
        mysqli_close($conexao);//Fecha conexao com o banco de dados
        $_SESSION['logado'] = true;
        $_SESSION['id_usuario'] = $dados['id_usuario'];
        if ($dados['tipo_usuario'] == 'B') {
          header('location: bibliotecario.php');
        } elseif ($dados['tipo_usuario'] == 'A' or 'P') {
          header('location: usuario.php');
        }
      } else {
        $erros[] = "<li>Senha Incorreta</li>";
      }  
    } else {
      $erros[]="<li>Usuario nao existe</li>";
      }
  }
}
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Library</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./estilos/estilo.css">
</head>

<body>
  <div class="login">
    <img src="./imagens/library.png" style="width:12%" ;br>
    <?php if (!empty($erros)) {
      foreach ($erros as $erro) {
        echo $erro;
      }
    }
    ?>
    <form action="./login.php" autocomplete="on" method="POST">
      <input type="text" placeholder="Login " id="login" name="login"><br>
      <input type="password" placeholder="Senha " id="senha" name="senha"><br>
      <button type="submit" name="btn-entrar">Fazer Login</button>
    </form>
  </div>

  <body>

</html>