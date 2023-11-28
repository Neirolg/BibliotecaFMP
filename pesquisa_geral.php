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
  $dados_pesquisa = "";
  $erro = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['tipo_pesquisa']) || empty($_POST['barra_pesquisa'])) {
      $erro = "*Preencha todos os campos Obrigatórios";
    } else {
      $tipo_pesquisa = $_POST["tipo_pesquisa"];
      $barra_pesquisa = $_POST["barra_pesquisa"];
      if ($tipo_pesquisa == "ISBN") {
        include 'conexao_bd.php';//Abre conexao com o banco de dados
        $sql = "SELECT id_livro, genero, isbn, tombo, titulo, autores, edicao, ano, editora, exemplar, observacoes 
        FROM cadastro_livros WHERE ISBN='$barra_pesquisa'";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
          $dados_pesquisa = $resultado;
        } else {
          $erro = "Não foi encontrado nenhum livro com este ISBN";
        }
        mysqli_close($conexao);//Fecha conexao com o banco de dados
      }
      if ($tipo_pesquisa == "TITULO") {
        include 'conexao_bd.php';//Abre conexao com o banco de dados
        $sql = "SELECT id_livro, genero, isbn, tombo, titulo, autores, edicao, ano, editora, exemplar, observacoes 
        FROM cadastro_livros WHERE titulo='$barra_pesquisa'";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
          $dados_pesquisa = $resultado;
        } else {
          $erro = "Não foi encontrado nenhum livro com este Título";
        }
        mysqli_close($conexao);//Fecha conexao com o banco de dados
      }
      if ($tipo_pesquisa == "TOMBO") {
        include 'conexao_bd.php';//Abre conexao com o banco de dados
        $sql = "SELECT id_livro, genero, isbn, tombo, titulo, autores, edicao, ano, editora, exemplar, observacoes 
        FROM cadastro_livros WHERE tombo='$barra_pesquisa'";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
          $dados_pesquisa = $resultado;
        } else {
          $erro = "Não foi encontrado nenhum livro com este Tombo";
        }
        mysqli_close($conexao);//Fecha conexao com o banco de dados
      }
    }
  }
  ?>
  <div class="bloco">
    <img src="./imagens/logo.png" style="width:12%" ;br>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
      <h1>Pesquisar Livros</h1>
      <p>*Campos Obrigatorios</p>
      <?php echo $erro; ?><br>
      <select id="tipo_pesquisa" name="tipo_pesquisa">
        <option value="ISBN">ISBN</option>
        <option value="TOMBO">Tombo</option>
        <option value="TITULO">Título</option>
      </select><br>
      <input type="search" placeholder="Buscar" id="barra_pesquisa" name="barra_pesquisa">*<br>
      <br><input type="submit" value="pesquisar">
    </form>
    <?php
    //Saida de Dados
    if (!empty($dados_pesquisa)) {
      while ($row = mysqli_fetch_assoc($dados_pesquisa)) {
        echo "<br><table><tr><th>ID</th><th>Genero</th><th>ISBN</th><th>Tombo</th><th>Titulo</th><th>Autores</th><th>Edicao</th><th>Ano</th><th>Editora</th><th>Exemplar</th><th>Observações</th></tr>";
        echo  "<tr><td>" . $row["id_livro"] . "</td><td>" . $row["genero"] . "</td><td>" . $row["isbn"] . "</td><td>" . $row["tombo"] . "</td><td>" . $row["titulo"] . "</td><td> " . $row["autores"] . "</td><td> " . $row["edicao"] . "</td><td> " . $row["ano"] . "</td><td> " . $row["editora"] . "</td><td> " . $row["exemplar"] . "</td><td> " . $row["observacoes"] . "</td></tr>" . "</table>";
      }
    }
    ?>

    <body>

</html>