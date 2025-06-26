document.addEventListener('DOMContentLoaded', async () => {
    console.log("chamando")
    const path = window.location.pathname;
    console.log(path)

    if (path.includes('cadastroItens.php')) {
        document.querySelector(".cadastro").onsubmit = async (e) => {
            e.preventDefault();
            try {
                const formData = new FormData(); // Coleta tudo automaticamente
                formData.append('descricao', document.getElementById('descricao').value);
                formData.append('tipo', document.getElementById('tipo').value);
                formData.append('unidade', document.getElementById('unidade').value);
        
                const response = await fetch('../../public/index.php?action=cadastrarItem', {
                    method: 'POST',
                    body: formData
                })
        
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
                    <img src="../../public/assets/itens.png">
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
});

async function atualizarItem(id) {
    try {
        const formData = new FormData(); // Coleta tudo automaticamente
        formData.append('descricao', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="descricao_"]').value);
        formData.append('tipo', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="tipo_"]').value);
        formData.append('unidade', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="unidade_"]').value);
        formData.append('id', document.querySelector(`#${id}`).closest(".item").querySelector('[id^="id_"]').value);

        const response = await fetch('../../public/index.php?action=atualizarItem', {
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

