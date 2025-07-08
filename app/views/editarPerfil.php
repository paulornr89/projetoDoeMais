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

    <title>Alterar Perfil</title>
</head>
<body>
    <header>
        <a target="_self" href="../../public/menuDoador.php" class="voltar"><img src="../../public/assets/arrowIcon.png"></a>
        <h2>Doe+</h2>
        <a class="perfil"><img src="../../public/assets/perfil/<?php echo $_SESSION['imagem']; ?>" onerror="this.onerror=null; this.src='../../public/assets/perfilDefault.png'"></a>
    </header>
    <main>
        <form class="container">
            <div class="imagePerfil">
                <img src="../../public/assets/perfil/<?php echo $_SESSION['imagem']; ?>" onerror="this.onerror=null; this.src='../../public/assets/perfilDefault.png'">
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
                        <label>Nome:</label>  
                        <input type="text" class="form-control" id="nome" name="nome" readonly/>
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
            <input type="hidden" id="tipo" name="tipo"/>
            <input type="hidden" id="cpf_cnpj" name="cpf_cnpj"/>
            <div class="row">
                <button class="btn btnSalvarDoacao" id="salvar">Salvar</button>
            </div>
        </form>            
    </main>
    <script type="text/javascript" src="./mainItens.js"></script>
</body>
</html>