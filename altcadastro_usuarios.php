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
  $dados_usuarios = $matcpf_pesquisa = $tipo_usuario = $nome = $sobrenome = $matcpf = $email = $telefone = $celular = "";
  $erro = $erro_pmatcpf = $sucesso = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btn-pesquisar'])) {
      $matcpf_pesquisa = $_POST["matcpf_pesquisa"];
  //Verifica se campo obrigatorio esta vazio
      if (empty($matcpf_pesquisa)) {
        $erro_pmatcpf = "*Prencha todos os campos obrigatorios";
      } else {
        include 'conexao_bd.php';//Abre conexao com o banco de dados
        $sql = "SELECT tipo_usuario, nome, matcpf, email, telefone, celular FROM cadastro_usuarios WHERE matcpf='$matcpf_pesquisa' ";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
          $dados_usuarios = mysqli_fetch_array($resultado);
        } else {
          $erro_pmatcpf = "Usuario nao foi encontrado";
        }
        mysqli_close($conexao); //Fecha conexao com o banco de dados
      }
    }
    if (isset($_POST['btn-alterar'])) {
      //Verificar se campos obrigatorios estao vazios
      if (empty($_POST['tipo_usuario']) || empty($_POST['nome']) || empty($_POST['matcpf']) || empty($_POST['email']) || empty($_POST['telefone']) || empty($_POST['celular'])) {
        $erro = "*Prencha todos os campos obrigatorios";
      } else {
        $tipo_usuario = $_POST["tipo_usuario"];
        $nome = $_POST["nome"];
        $matcpf = $_POST["matcpf"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $celular = $_POST["celular"];
        include 'conexao_bd.php';//Abre conexao com o banco de dados
        $sql = "UPDATE cadastro_usuarios SET tipo_usuario='$tipo_usuario', nome='$nome', matcpf='$matcpf', email='$email', telefone='$telefone', celular='$celular' WHERE matcpf='$matcpf'";
        if (mysqli_query($conexao, $sql)) {
          $sucesso = "Cadastro alterado com Sucesso";
        } else {
          $erro = "Erro ao tentar alterar cadastro";
        }
        mysqli_close($conexao); //Fecha conexao com o banco de dados
      }
    }
  }
  ?>
  <div class="bloco">
    <img src="./imagens/logo.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
    <h1>Alterar Cadastro Usuarios</h1>
    <p>*Campos Obrigatorios</p>
    <form name=form_matcpf method="post" autocomplete="on" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <input type="text" placeholder="CPF ou Matricula" id="matcpf_pesquisa" name="matcpf_pesquisa">*<br>
      <button type="submit" name="btn-pesquisar">Pesquisar</button><br>
      <?php echo $erro_pmatcpf; ?>
    </form>
    <form name=cadastro_usuarios method="post" autocomplete="on" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <?php echo $erro . $sucesso; ?><br>
      <input type="text" placeholder="Matricula ou CPF" id="matcpf" name="matcpf" value="<?php echo $dados_usuarios['matcpf']; ?>"><?php echo "<li>Não é possivel alterar o Matricula ou CPF</li>" ?><br>
      <?php if (!empty($dados_usuarios['tipo_usuario'])) {
        echo "<p>" . "Tipo de Usuario" . "</p>";
        echo "B - Bibliotecario,";
        echo " A - Aluno,";
        echo " P - Professor<br>";
        echo "<select id='tipo_usuario' name='tipo_usuario'>
        <option value='$dados_usuarios[tipo_usuario]'>$dados_usuarios[tipo_usuario]</option>
        <option value='A'>Aluno</option>
        <option value='P'>Professor</option>
        <option value='B'>Bibliotecario</option>
      </select><br>";
      } ?>
      <input type="text" placeholder="Nome Completo" id="nome" name="nome" value="<?php echo $dados_usuarios['nome']; ?>">*<br>
      <input type="text" placeholder="Email" id="email" name="email" value="<?php echo $dados_usuarios['email']; ?>">*<br>
      <input type="tel" placeholder="Telefone" id="telefone" name="telefone" value="<?php echo $dados_usuarios['telefone']; ?>">*<br>
      <input type="tel" placeholder="Celular" id="celular" name="celular" value="<?php echo $dados_usuarios['celular']; ?>">*<br>
      <br><button type="submit" name="btn-alterar">Alterar Cadastro</button>


    </form>


  </div>


  <body>

</html>