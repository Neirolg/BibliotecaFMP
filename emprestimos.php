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
    <div class="bloco">
        <img src="./imagens/library.png" style="width:12%" ; br>
        <h2>Olá, <?php echo $dados['login']; ?> <a href='logout.php'>Sair</a></h2>
        <ul>
            <li><a href="./emprestar.php">Emprestar</a></li>
            <li><a href="./renovar_devolver.php">Renovar ou Devolver</a></li>
            <li><a href="./atemprestimos.php">Ver emprestimos Ativos</a></li>
            <li><a href="./todos_emprestimos.php">Ver todos os emprestimos Ativos e Inativos</a></li>
    </div>

    <body>

</html>