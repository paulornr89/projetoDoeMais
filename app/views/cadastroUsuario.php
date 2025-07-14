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
    <meta name="description" content="Página do Doe+ - Objetivamos com esta solução auxiliar quaisquer instituições que realizam atividades em favor do próximo. Venha nos ajudar.">
    <meta name="keywords" content="doar, doador, instituição">
    <meta name="author" content="Paulo Rosa">

    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <title>Cadastrar</title>
</head>
<body class="fundoLogin">
    <main>
        <form class="cadastro" action="cadastrar" method="post">
            <div class="tituloCadastro titulo">
                <a target="_self" href="../../public/menuAdmin.php" class="voltarCadastro"><img src="../../public/assets/arrowIcon.png" alt="Voltar"></a>
                <h2 class="titulo-textoCadastro titulo-texto">Formulário de Cadastro</h2>
                <div class="espaco-vazio"></div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" id="email" name="email" required/>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" maxlength="15" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep" maxlength="9" required/>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" readonly/>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Número:</label>
                        <input type="text" class="form-control" id="numero" name="numero" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Complemento:</label>
                        <input type="text" class="form-control" id="complemento" name="complemento"/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required/>
                    </div>
                </div>
                <div class="col-1">
                    <div class="form-group">
                        <label>UF:</label>
                        <input type="text" class="form-control" id="uf" name="uf" required/>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                       <label>Parceria será como:</label>
                       <select class="form-control" id="parceria" name="parceria" required>
                            <option value="">Selecione uma opção...</option>
                            <option>Doador</option>
                            <option>Instituição Beneficente</option>
                       </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>Tipo:</label>
                        <div class="list-radio">
                            <div class="radio-option">
                                <input type="radio" id="pj" name="tipo" value="PJ" required> 
                                <label for="pj">PJ</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="pf" name="tipo" value="PF" required> 
                                <label for="pf">PF</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label class="identificador">CPF/CNPJ:</label>
                        <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" maxlength="18" required/>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="btnCancelar btn" type="reset">Cancelar</button>
                <button class="btnSalvar btn" type="submit">Salvar</button>
            </div>
        </form>
    </main>
    <script type="text/javascript" src="./mainCadastro.js"></script>
</body>
</html>