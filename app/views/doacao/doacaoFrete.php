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

    <link rel="stylesheet" href="../../../public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <title>Opções de Entrega ou Retirada</title>
</head>
<body>
    <header>
        <a target="_self" href="./doacaoInstituicao.php" class="voltar"><img src="../../../public/assets/arrowIcon.png"></a>
        <h2>Doe+</h2>
        <a class="perfil"><img src="../../../public/assets/perfil.png"></a>
    </header>
    <main>
        <form class="formFrete">
            <div class="titulo">
                <h2 class="titulo-texto">Você realizará a entrega?</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <select class="form-control" id="tipoFrete" name="tipoFrete" required>
                        <option value="">Selecione uma opção...</option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>                
                </div>
            </div>
            <div class="infoFrete --hide">
                <div class="titulo">
                    <h3 class="titulo-texto">Informações para coleta:</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>Data:</label>
                            <input type="date" class="form-control obrigatorio" id="dataColeta" name="dataColeta"/>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Horário:</label>
                            <input type="text" class="form-control obrigatorio" id="horario" name="horario"/>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>CEP:</label>
                            <input type="text" class="form-control obrigatorio" id="cep" name="cep"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Endereço:</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Complemento:</label>
                            <input type="text" class="form-control" id="complemento" name="complemento"/>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Cidade:</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" readonly/>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>UF:</label>
                            <input type="text" class="form-control" id="uf" name="uf" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row salvarDoacao">
                <button class="btnSalvarDoacao btn" type="submit">Salvar</button>
            </div>
        </form>
        <div class="doacaoConcluida efeitoMostrar --hide">
            <h3>Doação Registrada com Sucesso!</h3>
            <h4>Você será redirencionado para o menu em instantes.</h4>
        </div>
    </main>
    <script type="text/javascript" src="./mainDoacao.js"></script>
</body>
</html>