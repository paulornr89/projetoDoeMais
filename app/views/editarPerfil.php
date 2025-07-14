<?php
    session_start();

    if (!isset($_SESSION['usuario_id'])) {
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

    <title>Alterar Perfil</title>
</head>
<body>
    <header>
        <a target="_self" href="../../public/<?php 
            if($_SESSION['usuario_tipo'] == 'D') {
                echo "menuDoador";
            } else {
                echo "menuInstituicao";
            }
        ?>.php" class="voltar"><img src="../../public/assets/arrowIcon.png"></a>
        <h2>Doe+</h2>
        <a class="perfil"><img class="perfilImagem" src="../../public/assets/perfil/<?php echo $_SESSION['imagem']; ?>" onerror="this.onerror=null; this.src='../../public/assets/perfilDefault.png'"></a>
    </header>
    <main>
        <button class="menuHamburguer">
            <img src="../../public/assets/menuHam.png">
        </button>
        <form class="container">
            <div class="imagePerfil">
                <img class="perfilImagem" src="../../public/assets/perfil/<?php echo $_SESSION['imagem']; ?>" onerror="this.onerror=null; this.src='../../public/assets/perfilDefault.png'">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="imagemPerfil">Alterar Imagem:</label>
                        <input type="file" name="perfil" id="perfil" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?php
                            if($_SESSION['usuario_tipo'] == 'D') {
                                echo '<label>Nome:</label>';
                                echo '<input type="text" class="form-control" id="nome" name="nome" readonly/>';
                            } else {
                                echo '<label>Razão:</label>';
                                echo '<input type="text" class="form-control" id="razao" name="razao" readonly/>';;
                            }                            
                        ?>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>E-mail:</label>  
                        <input type="text" class="form-control" id="email" name="email" value="<?php
                            echo $_SESSION['usuario_id'] ;
                        ?>"/>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Telefone:</label>  
                        <input type="text" class="form-control" id="telefone" name="telefone"/>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>CEP:</label>  
                        <input type="text" class="form-control" id="cep" name="cep"/>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Logradouro:</label>  
                        <input type="text" class="form-control" id="logradouro" name="logradouro"/>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>UF:</label>  
                        <input type="text" class="form-control" id="uf" name="uf" readonly/>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Cidade:</label>  
                        <input type="text" class="form-control" id="cidade" name="cidade" readonly/>
                    </div>
                </div>                    
            </div>
            <input type="hidden" id="id_usuario" name="id_usuario"/>
            <?php
                if($_SESSION['usuario_tipo'] == 'D') {
                    echo '<input type="hidden" id="tipo" name="tipo"/>';
                    echo '<input type="hidden" id="cpf_cnpj" name="cpf_cnpj"/>';
                } else {
                    echo '<input type="hidden" id="cnpj" name="cnpj"/>';
                    echo '<input type="hidden" id="nome_fantasia" name="nome_fantasia"/>';
                }  
            ?>
            <input type="hidden" id="tipoUsuario" name="tipoUsuario" value="<?php echo $_SESSION['usuario_tipo']; ?>"/>
            
            <div class="row">
                <button class="btn btnSalvarDoacao" id="salvar">Salvar</button>
            </div>
        </form>            
    </main>
    <nav id="menuLateral" class="menuLateral ">
        <ul>
            <li><a href="./doacao/doacaoItens.php">Doação</a></li>
            <?php
                if($_SESSION['usuario_id'] == 'paulornr89@gmail.com') {
                    echo '<li><a href="./cadastroItens.php">Cadastrar Itens</a></li>';
                    echo '<li><a href="./listarItens.php">Alterar Itens</a></li>';
                    echo '<li><a href="./listarDoadores.php">Visualizar Doadores</a></li>';
                    echo '<li><a href="./listarInstituicoes.php">Visualizar Instituições</a></li>';
                }   
                ?>
            <li><a href="../../../public/logout.php">Sair</a></li>
        </ul>
    </nav>
    <script type="text/javascript" src="./mainItens.js"></script>
    <script>
        console.log('<?php echo $_SESSION['imagem'];?>')
        console.log('<?php echo $_SESSION['usuario_tipo'];?>')
    </script>
</body>
</html>