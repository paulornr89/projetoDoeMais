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
        

        //CARREGA ITENS
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
        const listaContainer = document.querySelector(".listaInstituicao");

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

        //CARREGA INSTITUICOES
        fetch('../../../public/index.php?action=listarInstituicoes', {
            method: 'GET'
        })
        .then(async response =>  response.json())
        .then(lista => {
            console.log(lista)
            const divListaItens = document.querySelector(".listaInstituicao");
        
            for(i=0; i < lista.data.length; i++) {
                const novoElemento = document.createElement("div");
                novoElemento.classList.add("instituicaoDoar")
                novoElemento.innerHTML += `
                    <img src="../../../public/assets/instituicao.svg">
                    <div class="infoInstituicaoDoar">
                        <h4>${lista.data[i].razao}</h4>
                        <input type="hidden" id="id_${i}" name="id_${i}" value="${lista.data[i].id_usuario}"/>
                    </div>
                    <input type="checkbox" id="check_${i}" name="check_${i}" onchange="controleCheckbox(id)"/>
                `;
                divListaItens.appendChild(novoElemento);
            }
        })
        .catch(error => console.log(error));

        document.querySelector("#pesquisaInstituicao").onkeyup = (e) => {
            const instituicaoPesquisada = removerAcentos(e.target.value.toLowerCase());
            document.querySelectorAll(".infoInstituicaoDoar h4").forEach((el) => {
                const nomeInstituicao = removerAcentos(el.textContent.toLowerCase());

                if(nomeInstituicao.indexOf(instituicaoPesquisada) == -1) {
                    el.closest(".instituicaoDoar").classList.add("--hide");
                } else if (el.closest(".instituicaoDoar").classList.contains("--hide")){
                    el.closest(".instituicaoDoar").classList.remove("--hide");
                }
            })
        }

        document.querySelector("#saveItens").onclick = () => {
            const instituicaoSelecionada = document.querySelector(`.instituicaoDoar input[type='checkbox']:checked`);
            if((instituicaoSelecionada != null) && (typeof(Storage) !== "undefined")) {
                if(sessionStorage.length == 1) {
                    sessionStorage.setItem("instituicao", instituicaoSelecionada.closest(".instituicaoDoar").querySelector("input[id^='id']").value);  
                    console.log(sessionStorage)
                    window.location.href = "./doacaoFrete.php";              
                } else {
                    console.log(sessionStorage.length)
                    console.log("não entrou")
                }
            } else {
                alert("Nenhuma instituição foi selecionada para esta doação.");
            }
        }
    }

    if (path.includes('doacaoFrete.php')) {
        //CARREGA DADOS DO USUÁRIO LOGADO
        fetch('../../../public/index.php?action=consultarPorEmail', {
            method: 'GET'
        })
        .then(async response =>  response.json())
        .then(data => data.response)
        .then(usuario => {
            console.log(usuario);       
            document.querySelector("#cep").value = usuario.cep;
            document.querySelector("#logradouro").value = usuario.endereco;
            document.querySelector("#cidade").value = usuario.cidade;
            document.querySelector("#uf").value = usuario.uf;

        })
        .catch(error => console.log(error));

        document.querySelector("#tipoFrete").onchange = (e) => {
            if(e.target.value != "Sim") {
                document.querySelector(".infoFrete").classList.remove("--hide");
            } else {
                document.querySelector(".infoFrete").classList.add("--hide");
            }
        }

        document.querySelector(".formFrete").onsubmit = (e) => {
            e.preventDefault();
            console.log("enviou")
        }
    }
});

function removerAcentos(texto) {
    return texto.normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .replace(/ç/g, 'c')
      .replace(/Ç/g, 'C');
  }

function carregaItensParaDoação() {
    if(sessionStorage.length > 0) {
        const itensSelecionados = JSON.parse(sessionStorage.getItem("itens"));
        document.querySelectorAll(".infoItens").forEach((e) => {
            const itemJaSelecionado = itensSelecionados.filter((item) => item.id == e.querySelector("input[id^='id']").value);
            if(itemJaSelecionado.length > 0 ) {
                e.querySelector("input[id^='quantidade']").value = itemJaSelecionado[0].quantidade;
            }
        });
    } 
}

function controleCheckbox(id) {
    document.querySelectorAll(`.instituicaoDoar input[type='checkbox']:checked:not(#${id})`).forEach((e) => {
        e.checked = false;
    })
}