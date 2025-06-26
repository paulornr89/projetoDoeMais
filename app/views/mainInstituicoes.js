document.addEventListener('DOMContentLoaded', async () => {
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
                    <p>
                        <strong>CNPJ: </strong> ${lista.data[i].cnpj}
                    </p>
                    <p>
                        <strong>Razão: </strong> ${lista.data[i].razao}
                    </p>
                    <p class="--hide">
                        <strong>Nome Fantasia: </strong> ${lista.data[i].nome_fantasia}
                    </p>
                    <p>
                        <strong>Telefone: </strong> ${lista.data[i].telefone}
                    </p>
                    <p>
                        <strong>CEP: </strong> ${lista.data[i].cep}
                    </p>
                    <p>
                        <strong>Endereço: </strong> ${lista.data[i].endereco}
                    </p>
                    <p>
                        <strong>Cidade: </strong> ${lista.data[i].cidade}
                    </p>
                    <p>
                        <strong>UF: </strong> ${lista.data[i].uf}
                    </p>
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
});