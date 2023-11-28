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
    $dados_pesquisa = "";
    $erro = $erro_pesquisa = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['tipo_pesquisa']) || empty($_POST['barra_pesquisa'])) {
            $erro = "*Preencha todos os campos Obrigatórios";
        } else {
            $tipo_pesquisa = $_POST["tipo_pesquisa"];
            $barra_pesquisa = $_POST["barra_pesquisa"];
            if ($tipo_pesquisa == "NOME") {
                include 'conexao_bd.php';//Abre conexao com o banco de dados
                $sql = "SELECT  id_usuario, tipo_usuario, nome, matcpf, email, telefone, celular, login 
                FROM cadastro_usuarios WHERE nome='$barra_pesquisa'";
                $resultado = mysqli_query($conexao, $sql);
                if (mysqli_num_rows($resultado) > 0) {
                    $dados_pesquisa = $resultado;
                } else {
                    $erro_pesquisa = "Não foi encontrado nenhum usuario com este nome";
                }
                mysqli_close($conexao);//Fecha conexao com o banco de dados
            }
            if ($tipo_pesquisa == "MATCPF") {
                include 'conexao_bd.php';//Abre conexao com o banco de dados
                $sql = "SELECT  id_usuario, tipo_usuario, nome, matcpf, email, telefone, celular, login  
                FROM cadastro_usuarios WHERE matcpf='$barra_pesquisa'";
                $resultado = mysqli_query($conexao, $sql);
                if (mysqli_num_rows($resultado) > 0) {
                    $dados_pesquisa = $resultado;
                } else {
                    $erro_pesquisa = "Não foi encontradro nenhum usuario com esta Matricula ou CPF";
                }
                mysqli_close($conexao);//Fecha conexao com o banco de dados
            }
            if ($tipo_pesquisa == "LOGIN") {
                include 'conexao_bd.php';//Abre conexao com o banco de dados
                $sql = "SELECT  id_usuario, tipo_usuario, nome, matcpf, email, telefone, celular, login 
                FROM cadastro_usuarios WHERE login='$barra_pesquisa'";
                $resultado = mysqli_query($conexao, $sql);
                if (mysqli_num_rows($resultado) > 0) {
                    $dados_pesquisa = $resultado;
                } else {
                    $erro_pesquisa = "Não foi encontrado nenhum usuario com este Login";
                }
                mysqli_close($conexao);//Fecha conexao com o banco de dados
            }
        }
    }
       ?>
    <div class="bloco">
        <img src="./imagens/logo.png" style="width:12%" ;br>
        <h2>Olá, <?php echo $dados['nome']; ?> <a href='logout.php'>Sair</a></h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <h1>Pesquisar Usuarios</h1>
            <p>*Campos Obrigatorios</p>
            <?php echo $erro . $erro_pesquisa; ?><br>
            <select id="tipo_pesquisa" name="tipo_pesquisa">
                <option value="NOME">Nome</option>
                <option value="MATCPF">Matricula ou CPF</option>
                <option value="LOGIN">Login</option>
            </select><br>
            <input type="search" placeholder="Pesquisar" id="barra_pesquisa" name="barra_pesquisa">*<br>
            <br><input type="submit" value="pesquisar">
        </form>
        <?php
        //Saida de Dados
        if (!empty($dados_pesquisa)) {
            while ($row = mysqli_fetch_assoc($dados_pesquisa)) {
                echo "<br><table><tr><th>ID</th><th>Tipo de Usuario</th><th>Nome</th><th>Matricula ou CPF</th><th>Email</th><th>Telefone</th><th>Celular</th><th>Login</th></tr>";
                echo  "<tr><td>" . $row["id_usuario"] . "</td><td>" . $row["tipo_usuario"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["matcpf"] . "</td><td> " . $row["email"] . "</td><td> " . $row["telefone"] . "</td><td> " . $row["celular"] . "</td><td> " . $row["login"] . "</td></tr>" . "</table>";
            }
        }
        ?>

        <body>

</html>