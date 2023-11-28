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
  <div class="bloco">
    <img src="./imagens/logo.png" style="width:12%" ;br>
    <h2>Olá, <?php echo $dados['login']; ?> <a href='logout.php'>Sair</a></h2>
    <?php
    $erro = $sucesso = "";
    echo $erro . $sucesso;
    include 'conexao_bd.php';//Abre conexao com o banco de dados
    $sql = "SELECT emprestimos.id_emprestimo, emprestimos.data, emprestimos.data_devolucao, emprestimos.renovacoes, emprestimos.emstatus,cadastro_livros.isbn, cadastro_livros.tombo, cadastro_livros.titulo, cadastro_usuarios.id_usuario, cadastro_usuarios.nome, cadastro_usuarios.matcpf FROM emprestimos 
    INNER JOIN cadastro_livros ON emprestimos.id_livro = cadastro_livros.id_livro
    INNER JOIN cadastro_usuarios ON emprestimos.id_usuario = cadastro_usuarios.id_usuario WHERE cadastro_usuarios.id_usuario='$id' AND emprestimos.emstatus='E'";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0) {
      //Saida de Dados
      while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<form action='$_SERVER[PHP_SELF]' name='fvemprestimos' method='POST'>";
        echo "<table><tr><th>Inscrição</th><th>Título</th><th>Data de Retirada</th><th>Data Devolucao</th><th>Renovações</th></tr>";
        echo  "<tr><td>" . $row["tombo"] . "</td><td>" . $row["titulo"] . "</td><td>" . $row["data"] . "</td><td>" . $row["data_devolucao"] . "</td><td>" . $row["renovacoes"] . "</td><td>" . "<button type='submit'  name='renovar' value='$row[id_emprestimo]'>Renovar</button>" . "</td></tr>" . "</table>";
        echo "</form>";
      }
    } else {
      echo "Nenhum emprestimo foi encontrado";
    }
    mysqli_close($conexao);//Fecha conexao com o banco de dados
    if (!empty($_POST['renovar'])) {
      $id_emprestimo = $_POST['renovar'];
      include 'conexao_bd.php';//Abre conexao com o banco de dados
      $sql = "SELECT data_devolucao ,renovacoes FROM emprestimos WHERE id_emprestimo='$id_emprestimo'";
      $resultado = mysqli_query($conexao, $sql);
      $resultado = mysqli_fetch_assoc($resultado);
      $renovacoes = $resultado['renovacoes'];
      $data_devolucao = $resultado['data_devolucao'];
      if ($renovacoes <= 2) {
        $data_devolucao = date_create($data_devolucao);
        date_add($data_devolucao, date_interval_create_from_date_string("7 days"));
        $data_devolucao = date_format($data_devolucao, "d-m-Y");
        $renovacoes = $renovacoes + 1;
        $sql = "UPDATE emprestimos SET data_devolucao='$data_devolucao', renovacoes='$renovacoes' WHERE id_emprestimo='$id_emprestimo'";
        if (mysqli_query($conexao, $sql)) {
          echo "Livro renovado com sucesso<br>";
          echo "Data Devolução " . $data_devolucao;
        } else {
          echo "Erro ao tentar renovar livro";
        }
      } else {
        echo "Limite de renovacões atingido";
      }
      mysqli_close($conexao);//Fecha conexao com o banco de dados
    }
    ?>
  </div>

  <body>

</html>