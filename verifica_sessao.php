<?php
require_once 'conexao_bd.php'; //Abre conexao com o banco de dados
if (!isset($_SESSION['logado'])) {
  header('Location: login.php');
} else {
  $id = $_SESSION['id_usuario'];
  $sql = "SELECT * FROM cadastro_usuarios WHERE id_usuario = '$id' ";
  $resultado = mysqli_query($conexao, $sql);
  $dados = mysqli_fetch_array($resultado);
  mysqli_close($conexao);
}
