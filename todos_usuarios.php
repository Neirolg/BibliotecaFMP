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
    $dados_usuarios = "";
    $erro = "";
    include 'conexao_bd.php'; //Abre conexao com o banco de dados
    $sql = "SELECT * FROM cadastro_usuarios";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0) {
        $dados_usuarios = $resultado;
    } else {
        $erro = "Não há nenhum usuario cadastrado";
    }
    mysqli_close($conexao); //Fecha conexao com o banco de dados
    ?>
    <div class="bloco">
        <img src="./imagens/library.png" style="width:12%" ;br>
        <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
        <?php echo $erro; ?><br>
        <?php
        //Saida de Dados
        if (!empty($dados_usuarios)) {
            while ($row = mysqli_fetch_assoc($dados_usuarios)) {
                echo "<br><table><tr><th>ID</th><th>Tipo de Usuario</th><th>Nome</th><th>Matrícula ou CPF</th><th>Email</th><th>Telefone</th><th>Celular</th><th>Login</th></tr>";
                echo  "<tr><td>" . $row["id_usuario"] . "</td><td>" . $row["tipo_usuario"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["matcpf"] . "</td><td> " . $row["email"] . "</td><td> " . $row["telefone"] . "</td><td> " . $row["celular"] . "</td><td> " . $row["login"] . "</td></tr>" . "</table>";
            }
        }
        ?>

        <body>

</html>