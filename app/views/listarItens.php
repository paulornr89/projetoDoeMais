<?php
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'D') {
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

    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <title>Lista de Itens</title>
</head>
<body>
    <header>
        <a target="_self" href=<?php
            if($_SESSION['usuario_id'] != "paulornr89a@gmail.com") {
                echo "./itens.php";
            } else {
                echo "../../public/menuAdmin.php";
            }
        ?> class="voltar"><img src="../../public/assets/arrowIcon.png"></a>
        <h2>Doe+</h2>
        <a class="perfil"><img src="../../public/assets/perfil.png"></a>
    </header>
    <main>
        <div class="mostrarItens">
            <div class="titulo">
                <h2 class="titulo-texto">Lista de Itens</h2>
            </div>
            <div class="listaItens">
            </div>
        </div>
    </main>
    <script type="text/javascript" src="./mainItens.js"></script>
</body>
</html>