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
  $dados_livros = $genero = $isbn = $tombo = $titulo = $autores = $edicao = $ano = $editora = $exemplar = $observacoes = "";
  $erro = $sucesso = $tombo_pesquisa = $erro_ptombo = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (isset($_POST['btn-pesquisar'])) {
      $tombo_pesquisa = $_POST["tombo_pesquisa"];
      //Verificar se campo obrigatorio esta vazio
      if (empty($tombo_pesquisa)) {
        $erro_ptombo = "*Prencha todos os campos Obrigatorios";
      } else {
              
        include 'conexao_bd.php';//Abre conexao com o banco de dados
        $sql = "SELECT  genero, isbn, tombo, titulo, autores, edicao, ano, editora, exemplar, observacoes 
        FROM cadastro_livros WHERE tombo='$tombo_pesquisa'";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
          $dados_livros = mysqli_fetch_array($resultado);
        } else {
          $erro_ptombo = "Livro nao foi encontrado";
        }
        mysqli_close($conexao);//Fecha conexao com o banco de dados
      }
    }
    if (isset($_POST['btn-alterar'])) {
      //Verificar se campos obrigatorios estao vazios
      if (empty($_POST['genero']) || empty($_POST['isbn']) || empty($_POST['tombo']) || empty($_POST['titulo']) || empty($_POST['autores']) || empty($_POST['edicao']) || empty($_POST['ano']) || empty($_POST['editora']) || empty($_POST['exemplar'])) {
        $erro = "*Prencha todos os campos obrigatorios";
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
        $sql = "UPDATE cadastro_livros SET genero='$genero', isbn='$isbn', tombo='$tombo', titulo='$titulo', autores='$autores', edicao='$edicao', ano='$ano', editora='$editora', exemplar='$exemplar', observacoes='$observacoes' WHERE tombo='$tombo'";
        if (mysqli_query($conexao, $sql)) {
          $sucesso = "Cadastro alterado com Sucesso";
        } else {
          $erro = "Erro ao tentar alterar cadastro";
        }
        mysqli_close($conexao);//Fecha conexao com o banco de dados
      }
    }
  }

  ?>
  <div class="bloco">
    <img src="./imagens/library.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
    <h1>Alterar Cadastro Livros</h1>
    <p>*Campos Obrigatorios</p>
    <form name=form_tombo method="post" autocomplete="on" action="<?php $_SERVER["PHP_SELF"]; ?>">
      <input type="text" placeholder="Tombo" id="tombo_pesquisa" name="tombo_pesquisa">*<br>
      <button type="submit" name="btn-pesquisar">Pesquisar</button><br>
      <?php echo $erro_ptombo; ?>
    </form>
    <form name=form_livros method="post" autocomplete="on " action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <?php echo $erro . $sucesso; ?><br>
       <input type="text" placeholder="Tombo" id="tombo" name="tombo" value="<?php echo  $dados_livros['tombo']; ?>"><?php echo"<li>Não é possivel alterar o tombo</li>" ?><br>
      <?php if (!empty($dados_livros['genero'])) {
        echo "<select id='genero' name='genero'>
        <option value='$dados_livros[genero]'>$dados_livros[genero]</option>                                                                            
        <option value='literatura'>Literatura</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
      </select><br>";
      } ?>
      <input type="text" placeholder="ISBN" id="isbn" name="isbn" value="<?php echo $dados_livros['isbn']; ?>">*<br>
      <input type="text" placeholder="Titulo" id="titulo" name="titulo" value="<?php echo $dados_livros['titulo']; ?>">*<br>
      <input type="text" placeholder="Autores" id="autores" name="autores" value="<?php echo $dados_livros['autores']; ?>">*<br>
      <input type="text" placeholder="Edição" id="edicao" name="edicao" value="<?php echo $dados_livros['edicao']; ?>">*<br>
      <input type="text" placeholder="Ano" id="ano" name="ano" value="<?php echo $dados_livros['ano']; ?>">*<br>
      <input type="text" placeholder="Editora" id="editora" name="editora" value="<?php echo $dados_livros['editora']; ?>">*<br>
      <input type="text" placeholder="Exemplar" id="exemplar" name="exemplar" value="<?php echo $dados_livros['exemplar']; ?>">*<br>
      <label for="observacoes">Observaçoes</label><br>
      <textarea name="observacoes" rows="5" cols="30">
   </textarea><br>
      <br><button type="submit" name="btn-alterar">Alterar Cadastro</button>
    </form>
  </div>
  <footer>
    <p>Desenvolvido pelos Alunos de Analise e Desenvolvimento de Sistemas</p>
  </footer>

</body>

</html>