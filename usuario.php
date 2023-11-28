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
        <h2>Olá, <?php echo $dados['nome']; ?></h2>
        <ul>
        <li><a href="./pesquisar_livros.php">Pesquisar Livros</a></li>

            <li><a href="./ver_emprestimos.php">Situações de Empréstimo</a></li>
            <li><a href="./cadastro.php">Minha Conta</a></li>
            <li><a href="./logout.php">Logout</a></li>
    </div>
    <body>

</html>