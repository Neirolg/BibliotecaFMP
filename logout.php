<?php
session_start();
//Limpar sessao
session_unset();
//Destroi sessao
session_destroy(); 
//Redireciona usuario para pagina login.php apos logout
header('Location: login.php');
