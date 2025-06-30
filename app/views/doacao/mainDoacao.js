document.addEventListener('DOMContentLoaded', async () => {
    const path = window.location.pathname;

    if (path.includes('doacaoItens.php')) {
        const listaContainer = document.querySelector(".listaItens");
        
    
        // Rolagem com botões
        document.getElementById("up").addEventListener("click", () => {
            listaContainer.scrollBy({
                top: -120, // Subir uma altura aproximada de um item
                behavior: 'smooth'
            });
        });
    
        document.getElementById("down").addEventListener("click", () => {
            listaContainer.scrollBy({
                top: 120, // Descer
                behavior: 'smooth'
            });
        });
    
        document.querySelector("#saveItens").onclick = () => {
            const arrayItens = [];
    
            document.querySelectorAll(".infoItens").forEach((e) => {
                
                if(e.querySelector("input").value != "") {
                    arrayItens.push({
                        id : e.querySelector("input[id^='id']").value,
                        quantidade: e.querySelector("input[id^='quantidade']").value
                    });
                    // console.log("id: " + e.querySelector("input[id^='id']").value)
                    // console.log("quantidade: " + e.querySelector("input[id^='quantidade']").value)
                }
            });
    
            if (typeof(Storage) !== "undefined") {
                if((Storage.length == 0) && (arrayItens.length > 0)) {
                    sessionStorage.setItem("itens",JSON.stringify(arrayItens));  
                    window.location.href = "./doacaoInstituicao.php";              
                } else {
                    alert("Para avançar é necessário que algum item seja incluído para doar.");
                }
            } else {
                alert("não foi possível salvar os itens na sessão");
            }
        };
        
        fetch('../../../public/index.php?action=listarItens', {
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
                    <img src="../../../public/assets/itens.png">
                    <div class="infoItens">
                        <h3>${lista.data[i].descricao} (${lista.data[i].unidade})</h3>
                        <div class="form-group">
                            <span>Qtd.:</span><input type="text" class="form-control" id="quantidade_${i}" name="quantidade_${i}" value="0"/>
                        </div>
                        <input type="hidden" id="id_${i}" name="id_${i}" value="${lista.data[i].id}"/>
                    </div>
                `;
                divListaItens.appendChild(novoElemento)
            }

            carregaItensParaDoação();//verifica se já existem itens preenchidos previamente e coloca o valor da quantidade
        })
        .catch(error => console.log(error));

    }

    if (path.includes('doacaoInstituicao.php')) {
        console.log(JSON.parse(sessionStorage.getItem("itens")))
    }
});

function carregaItensParaDoação() {
    console.log(sessionStorage.length)
    if(sessionStorage.length > 0) {
        const itensSelecionados = JSON.parse(sessionStorage.getItem("itens"));
        document.querySelectorAll(".infoItens").forEach((e) => {
            const itemJaSelecionado = itensSelecionados.filter((item) => item.id == e.querySelector("input[id^='id']").value);
            if(itemJaSelecionado.length > 0 ) {
                e.querySelector("input[id^='quantidade']").value = itemJaSelecionado[0].quantidade;
            }
            console.log("item já foi selecionado:")
            console.log(itemJaSelecionado);

        });
    } 
}