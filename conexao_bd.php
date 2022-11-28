<?php
$servername = "localhost"; //Endereço do Servidor
$username = "id17854642_root"; //Nome do usuario 
$password = "NjjNU<hEIA4Sb7}7"; //Senha do usuario
$dbname = "id17854642_biblioteca"; //Nome do banco de dados
//Cria Conexao
$conexao = mysqli_connect($servername, $username, $password, $dbname);
//Verifica Conexao
if (!$conexao) {
  die("Falha ao Realizar Conexao Com o Banco de Dados: " . mysqli_connect_error());
}
