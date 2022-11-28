<?php
session_start();
require_once 'verifica_sessao.php';
require_once 'verificar_tipo_usuario_B.php';
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
  $matcpf = $tombo = "";
  $erro = $sucesso = $vertombo = $id_usuario = $id_livro = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $erro = $sucesso = "";
    if (empty($_POST['matcpf']) || empty($_POST['tombo'])) {
      $erro = "*Preencha todos os campos Obrigatórios";
    } else {
      $matcpf = $_POST["matcpf"];
      $tombo = $_POST["tombo"];
      include 'conexao_bd.php';//Abre conexao com o banco de dados
      $sql = "SELECT id_usuario FROM cadastro_usuarios WHERE matcpf='$matcpf'";
      $resultado = mysqli_query($conexao, $sql);
      $emmatcpf = mysqli_fetch_array($resultado);
      if (mysqli_num_rows($resultado) > 0) {
        $sql = "SELECT id_livro, tombo FROM cadastro_livros WHERE tombo='$tombo'";
        $resultado = mysqli_query($conexao, $sql);
        $emtombo = mysqli_fetch_array($resultado);
        if (mysqli_num_rows($resultado) > 0) {
          $id_livro = $emtombo['id_livro'];
          $sql = "SELECT id_livro, emstatus FROM emprestimos WHERE id_livro='$id_livro' AND emstatus='E'";
          $resultado = mysqli_query($conexao, $sql);
          $vemprestimos = mysqli_fetch_array($resultado);
          if (mysqli_num_rows($resultado) > 0) {
            $erro = "livro ja foi emprestado";
          } else {
            $id_usuario = $emmatcpf['id_usuario'];
            include 'conexao_bd.php';//Abre conexao com o banco de dados
            $data = date_create(date('d-m-Y'));
            $data = date_format($data, "d-m-Y");
            $data_devolucao = date_create(date('d-m-Y'));
            date_add($data_devolucao, date_interval_create_from_date_string("7 days"));
            $data_devolucao = date_format($data_devolucao, "d-m-Y");
            $renovacoes = 0;
            $emstatus = 'E';
            $sql = "INSERT INTO  emprestimos(id_livro, id_usuario, data, data_devolucao,renovacoes, emstatus)
      VALUES ('$id_livro', '$id_usuario', '$data', '$data_devolucao', '$renovacoes', '$emstatus')";
            if (mysqli_query($conexao, $sql)) {
              $sucesso = "Emprestado com sucesso";
            } else {
              $erro = "Erro ao tentar emprestar". $sql . "<br>" . mysqli_error($conexao);
            }
          }
        } else {
          $erro = "Livro nao encontrado";
        }
      } else {
        $erro = "Usuario nao encontrado";
      }
      mysqli_close($conexao);//Fecha conexao com o banco de dados
    }
  }
  ?>
  <div class="bloco">
    <img src="./imagens/library.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
    <form method="post" autocomplete="on " action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <?php echo $erro . $sucesso; ?><br>
      <input type="text" placeholder="Matrícula ou CPF " id="matcpf" name="matcpf">*<br>
      <input type="text" placeholder="Tombo" id="tombo" name="tombo">*<br>
      <br><input type="submit" value="Emprestar">
    </form>
  </div>
  <footer>
    <p>Desenvolvido pelos Alunos de Analise e Desenvolvimento de Sistemas</p>
  </footer>
</body>

</html>