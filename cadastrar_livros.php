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
  $genero = $isbn = $tombo = $titulo = $autores = $edicao = $ano = $editora = $exemplar = $observacoes = "";
  $erro = $sucesso = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Verificar se campos obrigatorios estao vazios
    if (empty($_POST['genero']) || empty($_POST['isbn']) || empty($_POST['tombo']) || empty($_POST['titulo']) || empty($_POST['autores']) || empty($_POST['edicao']) || empty($_POST['ano']) || empty($_POST['editora']) || empty($_POST['exemplar'])) {
      $erro = "*Preencha todos os campos Obrigatórios";
    } else {
      $genero = $_POST["genero"];
      $isbn = $_POST["isbn"];
      $tombo = $_POST["tombo"];
      $titulo = $_POST["titulo"];
      $autores = $_POST["autores"];
      $edicao = $_POST["edicao"];
      $ano = $_POST["ano"];
      $editora = $_POST["editora"];
      $exemplar = $_POST["exemplar"];
      $observacoes = $_POST["observacoes"];
      include 'conexao_bd.php';//Abre conexao com o banco de dados
      $sql = "SELECT tombo FROM cadastro_livros WHERE tombo='$tombo'";
      $resultado = mysqli_query($conexao, $sql);
      if (mysqli_num_rows($resultado) > 0) {
        $erro = "Tombo ja existe";
        mysqli_close($conexao);//Fecha conexao com o banco de dados
      } else {
        $sql = "INSERT INTO cadastro_livros (genero, isbn, tombo, titulo, autores, edicao, ano, editora, exemplar,observacoes)
      VALUES ('$genero','$isbn','$tombo','$titulo','$autores','$edicao','$ano','$editora','$exemplar','$observacoes')";
        if (mysqli_query($conexao, $sql)) {
          $sucesso = "Cadastro realizado com sucesso";
        } else {
          $erro = "Erro ao tentar cadastrar livro" . $sql . "<br>" . mysqli_error($conexao);
        }
        mysqli_close($conexao);//Fecha conexao com o banco de dados
      }
    }
  }
 
  ?>
  <div class="bloco">
    <img src="./imagens/library.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
    <form method="post" autocomplete="on " action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <h1>Cadastro Livros</h1>
      <p>*Campos Obrigatorios</p>
      <?php echo $erro . $sucesso; ?><br>
      <select id="genero" name="genero">
        <option value="literatura">Literatura</option>
        <option value="didatico">Didatico</option>
        <option value="tecnico">Tecnico</option>
      </select><br>
      <input type="text" placeholder="ISBN " id="isbn" name="isbn">*<br>
      <input type="text" placeholder="Tombo" id="tombo" name="tombo">*<br>
      <input type="text" placeholder="Título" id="titulo" name="titulo">*<br>
      <input type="text" placeholder="Autores" id="autores" name="autores">*<br>
      <input type="text" placeholder="Edição" id="edicao" name="edicao">*<br>
      <input type="text" placeholder="Ano" id="ano" name="ano">*<br>
      <input type="text" placeholder="Editora" id="editora" name="editora">*<br>
      <input type="text" placeholder="Exemplar" id="exemplar" name="exemplar">*<br>
      <label for="observacoes">Observações</label><br>
      <textarea name="observacoes" rows="5" cols="30">
   </textarea><br>
      <br><input type="submit" value="Cadastrar">
    </form>
  </div>
  <footer>
    <p>Desenvolvido pelos Alunos de Analise e Desenvolvimento de Sistemas</p>
  </footer>
</body>

</html>