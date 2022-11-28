<?php 
if ($dados['tipo_usuario'] <> 'B') {
//Redireciona usuario caso nao seja do tipo bibliotecario    
    header('Location: restrito.php');
}
