<?php
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'I') {
        header('Location: logout.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página do Projeto Doe+ - Objetivamos com esta solução auxiliar quaisquer instituições que realizam atividades em favor do próximo. Venha nos ajudar.">
    <meta name="keywords" content="doar, doador, instituição">
    <meta name="author" content="Paulo Rosa">

    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Menu - Instituição</title>
</head>
<body>
    <header>
        <a href="./public/logout.php" class="voltar"><img src="./public/assets/arrow.png"></a>
        <h2>Doe+</h2>
        <a class="perfil"><img src="./assets/perfil/<?php echo $_SESSION['imagem']; ?>" onerror="this.onerror=null; this.src='./assets/perfilDefault.png'"></a>
    </header>
    <main>
        <ul class="menu">
            <!-- <a target="_self" href="../app/views/itens.php"></a> -->
            <li><div class="icone"><img src="./public/assets/default.svg"></div><div class="texto">Doações Recebidas</div></li>
        </ul>
    </main>
</body>
</html>