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
    $matcpf = $novo_login = "";
    $erro = $sucesso =  "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
       if (empty($_POST['matcpf']) || empty($_POST['novo_login'])) {
            $erro = "*Preencha todos os campos Obrigatórios";
        } else {
            $matcpf = $_POST["matcpf"];
            $novo_login = $_POST["novo_login"];
            include 'conexao_bd.php';//Abre conexao com o banco de dados
            $sql = "SELECT matcpf FROM cadastro_usuarios WHERE matcpf='$matcpf' ";
            $resultado = mysqli_query($conexao, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                $sql = "UPDATE cadastro_usuarios SET login='$novo_login' WHERE matcpf='$matcpf'";
                if (mysqli_query($conexao, $sql)) {
                    $sucesso = "Login alterado com sucesso";
                } else {
                    $erro = "Erro ao tentar alterar Login" . $sql . "<br>" . mysqli_error($conexao);
                }
            } else {
                $erro = "Matrícula ou CPF nao foi encontrado";
            }
        }
        mysqli_close($conexao); //Fecha conexao com o banco de dados
    }
    ?>
    <div class="bloco">
        <img src="./imagens/logo.png" style="width:12%" ;br>
        <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
        <form method="POST" autocomplete="on" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h1>Alterar Login dos Usuarios</h1>
            <p>*Campos Obrigatorios</p>
            </select><?php echo $erro . $sucesso  ?><br>
            <input type="text" placeholder="Matrícula ou CPF" id="matcpf" name="matcpf">*<br>
            <input type="text" placeholder="Novo Login" id="novo_login" name="novo_login">*<br>
            <br><input type="submit" value="Alterar Login">
        </form>

    </div>

    <body>

</html>