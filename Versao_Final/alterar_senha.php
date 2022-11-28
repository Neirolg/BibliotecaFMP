<?php
session_start();
require_once 'verifica_sessao.php';
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Library</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./estilos/estilo_02.css">
</head>

<body>
  <?php
  $senha_anterior = $nova_senha = $confimar_senha = "";
  $erro = $sucesso = $erro_confirmar = $erro_incorreta = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['senha_anterior']) || empty($_POST['nova_senha']) || empty($_POST['confirmar_senha'])) {
      $erro = "*Preencha todos os campos Obrigatórios";
    } else {
      $senha_anterior = md5($_POST["senha_anterior"]);
      $nova_senha = md5($_POST["nova_senha"]);
      $confirmar_senha = md5($_POST["confirmar_senha"]);
      if ($nova_senha == $confirmar_senha) {
        if ($senha_anterior == $dados['senha']) {
          include 'conexao_bd.php';//Abre conexao com o banco de dados
          $sql = "UPDATE cadastro_usuarios SET senha='$confirmar_senha' WHERE id_usuario='$id'";

          if (mysqli_query($conexao, $sql)) {
            $sucesso = "Senha alterada com sucesso";
          } else {
            $erro = "Erro ao tentar alterar senha" . $sql . "<br>" . mysqli_error($conexao);
          }
          mysqli_close($conexao); //Fecha conexao com o banco de dados
          session_unset();
          session_destroy(); 
        } else {
          $erro_incorreta = "Senha incorreta";
        }
      } else {
        $erro_confirmar = "Senhas não conferem";
      }
    }
  }
   ?>
  <div class="bloco">
    <img src="./imagens/library.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
    <form method="POST" autocomplete="on" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <h1>Alterar Senha</h1>
      <p>*Campos Obrigatorios</p>
      </select><?php echo $erro . $sucesso  ?><br>
      <input type="password" placeholder="Senha Anterior" id="senha_anterior" name="senha_anterior">*<?php echo $erro_incorreta; ?><br>
      <input type="password" placeholder="Nova Senha" id="nova_senha" name="nova_senha">*<br>
      <input type="password" placeholder="Confirmar Senha" id="confirmar_senha" name="confirmar_senha">*<br>
      <?php echo $erro_confirmar; ?>
      <br><input type="submit" value="Alterar Senha">
    </form>

  </div>

  <footer>
    <p>Desenvolvido pelos Alunos de Analise e Desenvolvimento de Sistemas</p>
  </footer>

  <body>

</html>