<?php
$servername = "localhost"; //Endereço do Servidor
$username = "root"; //Nome do usuario 
$password = ""; //Senha do usuario
$dbname = "biblioteca"; //Nome do banco de dados
//Cria Conexao
$conexao = mysqli_connect($servername, $username, $password, $dbname);
//Verifica Conexao
if (!$conexao) {
  die("Falha ao Realizar Conexao Com o Banco de Dados: " . mysqli_connect_error());
}
