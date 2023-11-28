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
    <div class="bloco">
        <img src="./imagens/logo.png" style="width:12%" ;br>
        <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
        <ul>
            <li><a href="./cadastrar_livros.php">Cadastrar Livro</a></li>
            <li><a href="./altcadastro_livros.php">Alterar Cadastro de Livros</a></li>
            <li><a href="./pesquisar_livros.php">Pesquisar Livros</a></li>
            <li><a href="./todos_livros.php">Todos os Livros</a></li>
    </div>

    <body>

</html>