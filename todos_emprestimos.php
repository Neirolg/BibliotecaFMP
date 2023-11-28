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
    $dados_emprestimos = "";
    $erro = "";
    include 'conexao_bd.php';//Abre conexao com o banco de dados
    $sql = "SELECT emprestimos.id_emprestimo, emprestimos.data, emprestimos.data_devolucao, emprestimos.renovacoes, emprestimos.emstatus,cadastro_livros.isbn, cadastro_livros.tombo, cadastro_livros.titulo, cadastro_usuarios.nome, cadastro_usuarios.matcpf FROM emprestimos 
    INNER JOIN cadastro_livros ON emprestimos.id_livro = cadastro_livros.id_livro
    INNER JOIN cadastro_usuarios ON emprestimos.id_usuario = cadastro_usuarios.id_usuario";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0) {
        $dados_emprestimos = $resultado;
    } else {
        $erro = "Nenhum emprestimo foi encontrado";
    }
    mysqli_close($conexao);//Fecha conexao com o banco de dados

    ?>
    <div class="bloco">
        <img src="./imagens/logo.png" style="width:12%" ;br>
        <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
        <?php echo $erro; ?><br>
        <?php
        //Saida de Dados
        if (!empty($dados_emprestimos)) { //REVER CAMPOS A SEREM MONSTRADOS
            while ($row = mysqli_fetch_assoc($dados_emprestimos)) {
                echo "<br><table><tr><th>ID</th><th>Tombo</th><th>ISBN</th><th>Título</th><th>Nome</th><th>Matricula ou CPF</th><th>Data de retirada</th><th>Data de devolucao</th><th>Renovações</th><th>Status</th></tr>";
                echo  "<tr><td>" . $row["id_emprestimo"] . "</td><td>" . $row["tombo"] . "</td><td>" . $row["isbn"] . "</td><td>" . $row["titulo"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["matcpf"] . "</td><td>" . $row["data"] . "</td><td>" . $row["data_devolucao"] . "</td><td>" . $row["renovacoes"] . "</td><td>" . $row["emstatus"] . "</td></tr>" . "</table>";
            }
        }
        ?>

        <body>

</html>