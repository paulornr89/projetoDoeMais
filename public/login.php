<?php
    session_start();
    session_unset();     // limpa todas as variáveis de sessão
    session_destroy();   // destrói a sessão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página do Projeto DOAR - Objetivamos com esta solução auxiliar quaisquer instituições que realizam atividades em favor do próximo. Venha nos ajudar.">
    <meta name="keywords" content="doar, doador, instituição">
    <meta name="author" content="Paulo Rosa">

    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <title>Doe+</title>
</head>
<body class="fundoLogin">
    <main>
        <form action="./processaLogin.php" method="POST" class="login">
            <div class="titulo">
                <h2>Doe+</h2>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" name="email" placeholder="Login"/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha"/>
                <span><a>Esqueceu sua senha?</a></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btnLogin">Login</button>
                <span><a target="_self" href="../app/views/cadastroUsuario.php">Criar novo acesso?</a></span>
            </div>
        </form>
    </main>
</body>
</html>