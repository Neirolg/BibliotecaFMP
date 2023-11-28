<?php
session_start();
require_once 'verifica_sessao.php';
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Biblioteca</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./estilos/estilo_02.css">
</head>

<body>
  <?php
  $nome = $sobrenome = $matcpf = $email = $telefone = $celular = "";
  $erro = $sucesso = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
   //Verificar se campos obrigatorios estao vazios
    if (empty($_POST['nome']) ||  empty($_POST['matcpf']) || empty($_POST['email']) || empty($_POST['telefone']) || empty($_POST['celular'])) {
      $erro = "*Preencha todos os campos Obrigatórios";
    } else {
      $nome = $_POST["nome"];
      $matcpf = $_POST["matcpf"];
      $email = $_POST["email"];
      $telefone = $_POST["telefone"];
      $celular = $_POST["celular"];
      include 'conexao_bd.php';//Abre conexao com o banco de dados
      $sql = "UPDATE cadastro_usuarios SET nome='$nome' , matcpf='$matcpf', email='$email', telefone='$telefone', celular='$celular' WHERE id_usuario='$id'";
      if (mysqli_query($conexao, $sql)) {
        $sucesso = "Cadastro alterado com Sucesso";
      } else {
        $erro = "Erro ao tentar alterar cadastro" . $sql . "<br>" . mysqli_error($conexao);;
      }
      mysqli_close($conexao); //Fecha conexao com o banco de dados
    }
  }
  ?>
  <div class="bloco">
    <img src="./imagens/logo.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
    <form method="POST" autocomplete="on" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <h1>Cadastro Usuario</h1>
      <p>*Campos Obrigatorios</p>
      <?php echo $erro . $sucesso ?><br>
      <input type="text" placeholder="Nome" id="nome" name="nome" value="<?php echo $dados['nome']; ?>">*<br>
      <input type="text" placeholder="Matrícula ou CPF" id="matcpf" name="matcpf" value="<?php echo $dados['matcpf']; ?>">*<br>
      <input type="text" placeholder="Email" id="email" name="email" value="<?php echo $dados['email']; ?>">*<br>
      <input type="tel" placeholder="Telefone" id="telefone" name="telefone" value="<?php echo $dados['telefone']; ?>">*<br>
      <input type="tel" placeholder="Celular" id="celular" name="celular" value="<?php echo $dados['celular']; ?>">*<br>
      <br><input type="submit" value="Alterar Cadastro">
    </form>

  </div>

  <body>

</html>