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
    $dados_livros = "";
    $erro = "";
    include 'conexao_bd.php';//Abre conexao com o banco de dados
    $sql = "SELECT * FROM cadastro_livros";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0) {
        $dados_livros = $resultado;
    } else {
        $erro = "Nao ha nenhum livro cadastrado";
    }
    mysqli_close($conexao);//Fecha conexao com o banco de dados
    ?>
    <div class="bloco">
        <img src="./imagens/library.png" style="width:12%" ;br>
        <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
        <?php echo $erro; ?><br>
        <?php
        //Saida de Dados
        if (!empty($dados_livros)) {
            while ($row = mysqli_fetch_assoc($dados_livros)) {
                echo "<br><table><tr><th>ID</th><th>Genero</th><th>ISBN</th><th>Tombo</th><th>Título</th><th>Autores</th><th>Edicao</th><th>Ano</th><th>Editora</th><th>Exemplar</th><th>Observações</th></tr>";
                echo  "<tr><td>" . $row["id_livro"] . "</td><td>" . $row["genero"] . "</td><td>" . $row["isbn"] . "</td><td>" . $row["tombo"] . "</td><td>" . $row["titulo"] . "</td><td> " . $row["autores"] . "</td><td> " . $row["edicao"] . "</td><td> " . $row["ano"] . "</td><td> " . $row["editora"] . "</td><td> " . $row["exemplar"] . "</td><td> " . $row["observacoes"] . "</td></tr>" . "</table>";
            }
        }
        ?>

        <body>

</html>