<?php
    $servidor = "localhost";
    $porta = 5432;
    $bd = "projetoDoar";
    $usuario = "postgres";
    $senha = "im0rtaltr32";
    
    $conexao = pg_connect("host=$servidor port=$porta dbname=$bd user=$usuario
    password=$senha");
    
    if(!$conexao) {
        die("Não foi possível se conectar ao banco de dados.");
    }
?>