document.addEventListener('DOMContentLoaded', async () => {
    const path = window.location.pathname;
    
    if (path.includes('cadastroItens.html')) {
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
        
                window.location.href = "./cadastroItens.html";
            
            } catch (e) {
                console.log(e)
                /**
                 * VALIDAR SE JÁ EXISTE CADASTRO
                 */
                alert("Erro ao cadastrar item!")
            }
        }
    } 
    
    if (path.includes('listarItens.html')) {
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
    }
});

async function atualizarItem(id) {
    console.log(id)
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

        window.location.href = "./listarItens.html";
    
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

        window.location.href = "./listarItens.html";
    
    } catch (e) {
        console.log(e)
        /**
         * VALIDAR SE JÁ EXISTE CADASTRO
         */
        alert("Erro ao cadastrar item!")
    }
}

