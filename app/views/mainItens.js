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
                        <input type="hidden" id="id_${i}" name="id_${i}" value="${lista.data[i].id}"/>
                    </div>
                    <div class="mostrarBotoes">
                        <button class="btn btnItem"><img class="icon" src="../../public/assets/check.svg" alt="Ícone" style="width: 20px; height: 20px;"></button>
                        <button class="btn btnItem"><img class="icon" src="../../public/assets/excluir.svg" alt="Ícone" style="width: 20px; height: 20px;"></button>
                    </div>
                `;
                divListaItens.appendChild(novoElemento)
            }
        })
    }
});