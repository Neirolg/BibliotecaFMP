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
  $matcpf = $nova_senha = "";
  $erro = $sucesso = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['matcpf']) || empty($_POST['nova_senha'])) {
      $erro = "*Preencha todos os campos Obrigatórios";
    } else {
      $matcpf = $_POST["matcpf"];
      $nova_senha = md5($_POST["nova_senha"]);
      include 'conexao_bd.php';//Abre conexao com o banco de dados
      $sql = "SELECT id_usuario FROM cadastro_usuarios WHERE matcpf='$matcpf' ";
      $resultado = mysqli_query($conexao, $sql);
      if (mysqli_num_rows($resultado) > 0) {
        $resultado = mysqli_fetch_assoc($resultado);
        $id_usuario=$resultado['id_usuario'];
        $sql = "UPDATE cadastro_usuarios SET senha='$nova_senha' WHERE id_usuario='$id_usuario'";
        if (mysqli_query($conexao, $sql)) {
          $sucesso = "Senha alterada com sucesso";
        } else {
          $erro = "Erro ao tentar alterar senha" . $sql . "<br>" . mysqli_error($conexao);
        }
      } else {
        $erro = "Matrícula ou CPF nao foi encontrado";
      }
    }
    mysqli_close($conexao);//Fecha conexao com o banco de dados
  }
  ?>
  <div class="bloco">
    <img src="./imagens/logo.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
    <form method="POST" autocomplete="on" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <h1>Alterar Senha dos Usuarios</h1>
      <p>*Campos Obrigatorios</p>
      </select><?php echo $erro . $sucesso  ?><br>
      <input type="text" placeholder="Matrícula ou CPF" id="matcpf" name="matcpf">*<br>
      <input type="password" placeholder="Nova Senha" id="nova_senha" name="nova_senha">*<br>
      <br><input type="submit" value="Alterar Senha">
    </form>

  </div>


  <body>

</html>