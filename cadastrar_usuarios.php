<?php
session_start();
require_once 'verifica_sessao.php';
require_once 'verificar_tipo_usuario_B.php';
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
  $tipo_usuario = $nome = $sobrenome = $matcpf = $email = $telefone = $celular = $login = $senha = "";
  $erro = $sucesso = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
   //Verificar se campos obrigatorios estao vazios
    if (empty($_POST['tipo_usuario']) || empty($_POST['nome']) || empty($_POST['matcpf']) || empty($_POST['email']) || empty($_POST['telefone']) || empty($_POST['celular']) || empty($_POST['login']) || empty($_POST['senha'])) {
      $erro = "*Preencha todos os campos Obrigatórios";
    } else {
      $tipo_usuario = $_POST["tipo_usuario"];
      $nome = $_POST["nome"];
      $matcpf = $_POST["matcpf"];
      $email = $_POST["email"];
      $telefone = $_POST["telefone"];
      $celular = $_POST["celular"];
      $login = $_POST["login"];
      $senha = md5($_POST["senha"]);
      include 'conexao_bd.php';//Abre conexao com o banco de dados
      $sql = "SELECT matcpf FROM cadastro_usuarios WHERE matcpf='$matcpf' ";
      $resultado = mysqli_query($conexao, $sql);
      if (mysqli_num_rows($resultado) > 0) {
        $erro = "Matricula ou CPF ja existem";
      } else {
        $sql = "SELECT login FROM cadastro_usuarios WHERE login='$login' ";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
          $erro = "Esse Login ja Existe";
        } else {
          $sql = "INSERT INTO cadastro_usuarios (tipo_usuario, nome, matcpf, email, telefone, celular,login ,senha)
      VALUES ('$tipo_usuario', '$nome', '$matcpf', '$email', '$telefone', '$celular', '$login', '$senha')";
          if (mysqli_query($conexao, $sql)) {
            $sucesso = "Cadastro realizado com sucesso";
          } else {
            $erro = "Erro ao tentar cadastrar usuario" . $sql . "<br>" . mysqli_error($conexao);
          }
        }
      }
    }
    mysqli_close($conexao);//Fecha conexao com o banco de dados
  }
   ?>
  <div class="bloco">
    <img src="./imagens/logo.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
    <form method="post" autocomplete="on" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <h1>Cadastro Usuario</h1>
      <p>*Campos Obrigatorios</p>
      <?php echo $erro . $sucesso ?><br>
      <select id="tipo_usuario" name="tipo_usuario">
        <option value="A">Aluno</option>
        <option value="P">Professor</option>
        <option value="B">Bibliotecario</option>
      </select><br>
      <input type="text" placeholder="Nome Completo " id="nome" name="nome">*<br>
      <input type="text" placeholder="Matrícula ou CPF" id="matcpf" name="matcpf">*<br>
      <input type="text" placeholder="Email" id="email" name="email">*<br>
      <input type="tel" placeholder="Telefone" id="telefone" name="telefone">*<br>
      <input type="tel" placeholder="Celular" id="celular" name="celular">*<br>
      <input type="text" placeholder="Login" id="login" name="login">*<br>
      <input type="password" placeholder="Senha" id="senha" name="senha">*<br>
      <br><input type="submit" value="Cadastrar">
    </form>
  </div>

  <body>

</html>