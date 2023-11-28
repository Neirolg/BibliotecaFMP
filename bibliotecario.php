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
        <h2>Bibliotecário, <?php echo $dados['nome']; ?></h2>
        <ul>
            <li><a href="./emprestimos.php">Emprestimos</a></li>
            <li><a href="./cadastro_livros.php">Cadastro Livros</a></li>
            <li><a href="./cadastro_usuarios.php">Cadastro Usuarios</a></li>
            <li><a href="./usuario.php">Usuario</a></li>
            <li><a href="./logout.php">Sair</a></li>
    </div>

    <body>

</html>