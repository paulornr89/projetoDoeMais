document.addEventListener('DOMContentLoaded', async () => {
    const path = window.location.pathname;

    if (path.includes('cadastroItens.php')) {
        document.querySelector(".cadastro").onsubmit = async (e) => {
            e.preventDefault();
            try {
                const formData = new FormData(); // Coleta tudo automaticamente
                formData.append('descricao', document.getElementById('descricao').value);
                formData.append('tipo', document.getElementById('tipo').value);
                formData.append('unidade', document.getElementById('unidade').value);
                if (document.querySelector("#imagemItem").files.length > 0) {
                    formData.append('imagemItem', document.querySelector("#imagemItem").files[0]);
                }

                const response = await fetch('../../public/index.php?action=cadastrarItem', {
                    method: 'POST',
                    body: formData
                })
                .catch(e => console.log(e))
               
                const resultado = await response.json();
        
                window.location.href = "./cadastroItens.php";
            
            } catch (e) {
                console.log(e)
                /**
                 * VALIDAR SE JÁ EXISTE CADASTRO
                 */
                alert("Erro ao cadastrar item!")
            }
        }
    } 
    
    if (path.includes('listarItens.php')) {
        fetch('../../public/index.php?action=listarItens', {
            method: 'GET'
        })
        .then(async response =>  response.json())
        .then(lista => {
            console.log(lista)
            const divListaItens = document.querySelector(".listaItens");

            for(i=0; i < lista.data.length; i++) {
                const novoElemento = document.createElement("div");
                novoElemento.classList.add("item")
                novoElemento.innerHTML += `
                    <img src="../../public/assets/itens/${lista.data[i].imagem}" class="imagemItem" onerror="this.onerror=null; this.src='../../public/assets/itens.png'">
                    <div class="infoItens">
                        <div class="form-group">
                            <label>Item:</label>
                            <input type="text" class="form-control" id="descricao_${i}" name="descricao_${i}" value="${lista.data[i].descricao}"/>
                        </div>
                        <div class="form-group">
                            <label>Unidade:</label>
                            <input type="text" class="form-control" id="unidade_${i}" name="unidade_${i}" value="${lista.data[i].unidade}"/>
                        </div>
                        <div class="form-group">
                            <label>Tipo:</label>
                            <input type="text" class="form-control" id="tipo_${i}" name="tipo_${i}" value="${lista.data[i].tipo}"/>
                        </div>
                        <div class="form-group">
                            <label for="imagemItem">Inserir Imagem:</label>
                            <input type="file" name="imagemItem_${i}" id="imagemItem_${i}" accept="image/*">
                        </div>
                        <input type="hidden" id="id_${i}" name="id_${i}" value="${lista.data[i].id}"/>
                    </div>
                    <div class="mostrarBotoes">
                        <button id="atualizar_${i}" class="btn btnItem" onclick="atualizarItem(id)"><img class="icon" src="../../public/assets/check.svg" alt="Ícone" style="width: 20px; height: 20px;"></button>
                        <button id="deletar_${i}" class="btn btnItem" onclick="deletarItem(id)"><img class="icon" src="../../public/assets/excluir.svg" alt="Ícone" style="width: 20px; height: 20px;"></button>
                    </div>
                `;
                divListaItens.appendChild(novoElemento)
            }
        })
        .catch(error => console.log(error));
    }

    if(path.includes('listarInstituicoes.php')) {
        fetch('../../public/index.php?action=listarInstituicoes', {
            method: 'GET'
        })
        .then(async response =>  response.json())
        .then(lista => {
            console.log(lista)
            const divListaItens = document.querySelector(".listaInstituicoes");
    
            for(i=0; i < lista.data.length; i++) {
                const novoElemento = document.createElement("div");
                novoElemento.classList.add("instituicao")
                novoElemento.innerHTML += `
                    <img src="../../public/assets/default.svg">
                    <div class="infoInstituicao">
                        <div class="coluna">
                            <p><strong>CNPJ: </strong> ${lista.data[i].cnpj}</p>
                            <p><strong>Razão: </strong> ${lista.data[i].razao}</p>
                            <p class="--hide"><strong>Nome Fantasia: </strong> ${lista.data[i].nome_fantasia}</p>
                            <p><strong>Telefone: </strong> ${lista.data[i].telefone}</p>
                            <p><strong>CEP: </strong> ${lista.data[i].cep}</p>
                        </div>
                        <div class="coluna">
                            <p><strong>Endereço: </strong> ${lista.data[i].endereco}</p>
                            <p><strong>Cidade: </strong> ${lista.data[i].cidade}</p>
                            <p><strong>UF: </strong> ${lista.data[i].uf}</p>
                        </div>
                        <input type="hidden" id="id_${i}" name="id_${i}" value="${lista.data[i].id_usuario}"/>
                    </div>
                    <div class="mostrarBotoes --hide">
                        <button id="atualizar_${i}" class="btn btnItem" onclick="atualizarItem(id)"><img class="icon" src="../../public/assets/check.svg" alt="Ícone" style="width: 20px; height: 20px;"></button>
                        <button id="deletar_${i}" class="btn btnItem" onclick="deletarItem(id)"><img class="icon" src="../../public/assets/excluir.svg" alt="Ícone" style="width: 20px; height: 20px;"></button>
                    </div>
                `;
                console.log(divListaItens);
                console.log(novoElemento)
                divListaItens.appendChild(novoElemento)
            }
        })
        .catch(error => console.log(error));
    }

    if(path.includes('listarDoadores.php')) {
        fetch('../../public/index.php?action=listarDoadores', {
            method: 'GET'
        })
        .then(async response =>  response.json())
        .then(lista => {
            console.log(lista)
            const divListaItens = document.querySelector(".listaDoadores");
    
            for(i=0; i < lista.data.length; i++) {
                const novoElemento = document.createElement("div");
                novoElemento.classList.add("doador")
                novoElemento.innerHTML += `
                    <img src="../../public/assets/default.svg">
                    <div class="infoDoador">
                        <div class="coluna">
                            <p><strong>CPF: </strong> ${lista.data[i].cpf_cnpj}</p>
                            <p><strong>Nome: </strong> ${lista.data[i].nome}</p>
                            <p><strong>Telefone: </strong> ${lista.data[i].telefone}</p>
                            <p><strong>CEP: </strong> ${lista.data[i].cep}</p>
                        </div>
                        <div class="coluna">
                            <p><strong>Endereço: </strong> ${lista.data[i].endereco}</p>
                            <p><strong>Cidade: </strong> ${lista.data[i].cidade}</p>
                            <p><strong>UF: </strong> ${lista.data[i].uf}</p>
                            <p><strong>Tipo: </strong> ${lista.data[i].tipo}</p>
                        </div>
                        <input type="hidden" id="id_${i}" name="id_${i}" value="${lista.data[i].id_usuario}"/>
                    </div>
                    <div class="mostrarBotoes --hide">
                        <button id="atualizar_${i}" class="btn btnItem" onclick="atualizarItem(id)"><img class="icon" src="../../public/assets/check.svg" alt="Ícone" style="width: 20px; height: 20px;"></button>
                        <button id="deletar_${i}" class="btn btnItem" onclick="deletarItem(id)"><img class="icon" src="../../public/assets/excluir.svg" alt="Ícone" style="width: 20px; height: 20px;"></button>
                    </div>
                `;
                divListaItens.appendChild(novoElemento)
            }
        })
        .catch(error => console.log(error));
    }

    if(path.includes('editarPerfil.php')) {

        fetch('../../public/index.php?action=consultarPorEmail', {
            method: 'GET'
        })
        .then(async response =>  response.json())
        .then(lista => lista.response)
        .then(data => {
            console.log(data)
            if(document.querySelector("#tipoUsuario").value == "D"){
                document.querySelector("#nome").value = data.nome;
                document.querySelector("#tipo").value = data.tipo;
                document.querySelector("#cpf_cnpj").value = data.cpf_cnpj;
            } else {
                document.querySelector("#razao").value = data.razao;
                document.querySelector("#cnpj").value = data.cnpj;

            }

            document.querySelector("#telefone").value = data.telefone.replace(/(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3");;
            document.querySelector("#cep").value = data.cep.replace(/(\d{5})(\d+)/, "$1-$2");
            document.querySelector("#logradouro").value = data.endereco;
            document.querySelector("#uf").value = data.uf;
            document.querySelector("#cidade").value = data.cidade;
            document.querySelector("#id_usuario").value = data.id_usuario;
            document.querySelector("#nome_fantasia").value = data.nome_fantasia;
        })
        .catch(error => console.log(error));

        document.querySelector("#salvar").onclick = async (e) => {
            e.preventDefault();
            const formData = new FormData();

            formData.append('id_usuario', document.querySelector("#id_usuario").value);
            formData.append('telefone', document.querySelector("#telefone").value.replace(/\D/g, ""));
            formData.append('cep', document.querySelector("#cep").value.replace(/\D/g, ""));
            formData.append('endereco', document.querySelector("#logradouro").value);
            formData.append('cidade', document.querySelector("#cidade").value);
            formData.append('uf', document.querySelector("#uf").value);
            formData.append('email', document.querySelector("#email").value);
            formData.append('senha', "");
            if (document.querySelector("#perfil").files.length > 0) {
                formData.append('perfil', document.querySelector("#perfil").files[0]); // usa 'perfil'
            }
            let response = null;

            if(document.querySelector("#tipoUsuario").value == "D"){
                formData.append('nome', document.querySelector("#nome").value);
                formData.append('tipo', document.querySelector("#tipo").value);
                formData.append('cpf_cnpj', document.querySelector("#cpf_cnpj").value);
                
                response = await fetch('../../public/index.php?action=atualizarDoador', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response)
                .catch(error => console.log(error));

            } else {
                formData.append('razao', document.querySelector("#razao").value);
                formData.append('cnpj', document.querySelector("#cnpj").value);
                formData.append('nome_fantasia', document.querySelector("#nome_fantasia").value);
                
                response = await fetch('../../public/index.php?action=atualizarInstituicao', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response)
                .catch(error => console.log(error));
                
            }
            
            document.querySelectorAll(".perfilImagem").forEach((e) => {
                if (e) {
                    console.log(e.src)
                    const srcBase = e.src.split("?")[0]; // remove qualquer ?t= antigo
                    e.src = `${srcBase}?t=${new Date().getTime()}`; // força novo carregamento
                }
            })

            console.log(await response.json())
            location.reload();//window.location.href = "./editarPerfil.php";            
        }

        document.querySelector("#telefone").onkeyup = async (e) => {//mascara telefone
            let valor = document.querySelector("#telefone").value;
            valor = valor.replace(/\D/g, ""); // Remove caracteres não numéricos
            
            // Limita a 11 dígitos
            if (valor.length > 11) {
                valor = valor.substring(0, 11);
            }

            // Aplica a máscara dinamicamente
            if (valor.length >= 7) {
                valor = valor.replace(/(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3");
            } else if (valor.length >= 2) {
                valor = valor.replace(/(\d{2})(\d{0,5})/, "($1) $2");
            } else if (valor.length < 2) {
                valor = valor.replace(/(\d{1,2})/, "($1");
            }
            
            document.querySelector("#telefone").value = valor;
        }

        document.querySelector("#cep").onkeyup = (e) => {//mascara cep
            let valor = document.querySelector("#cep").value;
            // Remove todos os caracteres que não são dígitos
            valor = valor.replace(/\D/g, "");

            // Limita a 8 dígitos
            if (valor.length > 8) {
                valor = valor.substring(0, 8);
            }

            // Aplica a máscara dinamicamente
            if (valor.length > 5) {
                valor = valor.replace(/(\d{5})(\d+)/, "$1-$2");
            }
            document.querySelector("#cep").value = valor;
        }

        document.querySelector("#cep").onblur = async (e) => {
            const cep = e.target.value.replace("-","");
            console.log(cep)
            if(cep.match(/(?=^.{8,8}$)(?=.*^[0-9]+$).*$/)){
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(async data => {
                    const dados = await data.json();
                    console.log(dados)
                    document.querySelector("#logradouro").value = dados.logradouro;
                    document.querySelector("#uf").value = dados.uf;
                    document.querySelector("#cidade").value = dados.localidade;
                })
                
            } else {
                console.log("CEP inválido");
            }
        }

        document.querySelector(".imagePerfil").onclick = (e) => {

        }
    }
});

async function atualizarItem(id) {
    try {
        const formData = new FormData(); // Coleta tudo automaticamente
        formData.append('descricao', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="descricao_"]').value);
        formData.append('tipo', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="tipo_"]').value);
        formData.append('unidade', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="unidade_"]').value);
        formData.append('id', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="id_"]').value);
        if (document.querySelector(`#${id}`).closest(".item").querySelector('[id^="imagemItem_"]').files.length > 0) {
             document.querySelector(`#${id}`).closest(".item").querySelector('[id^="imagemItem_"]').files[0]
            formData.append('imagemItem', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="imagemItem_"]').files[0]);
            document.querySelectorAll(".imagemItem").forEach((e) => {
                if (e) {
                    console.log(e.src)
                    const srcBase = e.src.split("?")[0]; // remove qualquer ?t= antigo
                    e.src = `${srcBase}?t=${new Date().getTime()}`; // força novo carregamento
                }
            })
        }

        const response = await fetch('../../public/index.php?action=atualizarItem', {
            method: 'POST',
            body: formData
        })

        const resultado = await response.json();


        location.reload();

        //window.location.href = "./listarItens.php";
    
    } catch (e) {
        console.log(e)
        /**
         * VALIDAR SE JÁ EXISTE CADASTRO
         */
        alert("Erro ao cadastrar item!");
    }
}

async function deletarItem(id) {
    console.log(id)
    try {
        const formData = new FormData(); // Coleta tudo automaticamente
        formData.append('id', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="id_"]').value);

        const response = await fetch('../../public/index.php?action=deletarItem', {
            method: 'POST',
            body: formData
        })

        const resultado = await response.json();

        window.location.href = "./listarItens.php";
    
    } catch (e) {
        console.log(e)
        /**
         * VALIDAR SE JÁ EXISTE CADASTRO
         */
        alert("Erro ao cadastrar item!")
    }
}

