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

    <title>Cadastrar Itens</title>
</head>
<body>
    <header>
        <a class="voltar" href="../../public/menuAdmin.php"><img src="../../public/assets/arrowIcon.png"></a>
        <h2>Doe+</h2>
        <a class="perfil"><img src="../../public/assets/perfil/<?php echo $_SESSION['imagem']; ?>" onerror="this.onerror=null; this.src='../../public/assets/perfilDefault.png'"></a>
    </header>
    <main>
        <form class="cadastro" action="cadastrarItem" method="post">
            <div class="titulo">
                <h2 class="titulo-texto">Cadastrar Item</h2>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label>Descricao:</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" required/>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <label>Tipo:</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="">Selecione uma opção...</option>
                            <option value="AP">Alimento Perecível</option>
                            <option value="AN">Alimento Não Perecível</option>
                            <option value="VE">Vestuário</option>
                            <option value="PL">Produto de Limpeza</option>
                            <option value="PH">Produto de Higiene</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Unidade:</label>
                        <input type="text" class="form-control" id="unidade" name="unidade" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="btnCancelar btn" type="reset">Cancelar</button>
                <button class="btnSalvar btn" type="submit">Incluir</button>
            </div>
        </form>
    </main>
    <script type="text/javascript" src="./mainItens.js"></script>
</body>
</html>