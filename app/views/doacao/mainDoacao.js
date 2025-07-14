document.addEventListener('DOMContentLoaded', async () => {
    const path = window.location.pathname;

    

    if (path.includes('doacaoItens.php')) {
        /**iniciar */
        menuHamburguer();

        /**SCROLL */
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

        /**PESQUISA */
        document.querySelector("#pesquisaItens").onkeyup = (e) => {
            const itemPesquisado = removerAcentos(e.target.value.toLowerCase());
            document.querySelectorAll(".infoItens h3").forEach((el) => {
                const nomeItem = removerAcentos(el.textContent.toLowerCase());

                if(nomeItem.indexOf(itemPesquisado) == -1) {
                    el.closest(".item").classList.add("--hide");
                } else if (el.closest(".item").classList.contains("--hide")){
                    el.closest(".item").classList.remove("--hide");
                }
            })
        }

        document.querySelector("#saveItens").onclick = () => {
            const arrayItens = [];
    
            document.querySelectorAll(".infoItens").forEach((e) => {
                
                if((e.querySelector("input").value != "0") && (e.querySelector("input").value != "")) {
                    arrayItens.push({
                        id : e.querySelector("input[id^='id']").value,
                        quantidade: e.querySelector("input[id^='quantidade']").value
                    });
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
                    <img src="../../../public/assets/itens/${lista.data[i].imagem}" onerror="this.onerror=null; this.src='../../../public/assets/itens.png'">
                    <div class="infoItens">
                        <h3>${lista.data[i].descricao} (${lista.data[i].unidade})</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" id="quantidade_${i}" name="quantidade_${i}" value="0"/>
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
        menuHamburguer();
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
            console.log(sessionStorage)
            for(i=0; i < lista.data.length; i++) {
                console.log(lista.data[i])
                const novoElemento = document.createElement("div");
                novoElemento.classList.add("instituicaoDoar")
                novoElemento.innerHTML += `
                    <img src="../../../public/assets/perfil/${lista.data[i].imagem}" onerror="this.onerror=null; this.src='../../../public/assets/instituicao.svg'">
                    <div class="infoInstituicaoDoar">
                        <h4>${lista.data[i].razao}</h4>
                        <input type="hidden" id="id_${i}" name="id_${i}" value="${lista.data[i].id}"/>
                    </div>
                    <input type="checkbox" id="check_${i}" name="check_${i}" onchange="controleCheckbox(id)"/>
                `;
                if((sessionStorage.getItem('instituicao') != null) && (lista.data[i].id == sessionStorage.getItem('instituicao'))) {
                    novoElemento.querySelector("input[type='checkbox']").checked = true;
                }
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
                if(sessionStorage.length >= 1) {
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
        menuHamburguer();

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
            sessionStorage.setItem("id_usuario", usuario.id_usuario)

        })
        .catch(error => console.log(error));

        document.querySelector("#tipoFrete").onchange = (e) => {
            if(e.target.value != "Sim") {
                document.querySelector(".infoFrete").classList.remove("--hide");
                if(e.target.value == "Não") {
                    console.log("entrou")
                    document.querySelectorAll(".obrigatorio").forEach((el) => {
                        el.required = true;
                    })
                }
            } else {
                document.querySelector(".infoFrete").classList.add("--hide");
            }
        }

        document.querySelector(".formFrete").onsubmit = async (e) => {
            e.preventDefault();
            console.log("enviou")
            console.log(sessionStorage)
            const formDataDoacao = new FormData(); // Coleta tudo automaticamente        
            formDataDoacao.append('id_doador', sessionStorage.getItem("id_usuario"));        
            formDataDoacao.append('id_instituicao', sessionStorage.getItem("instituicao"));
            formDataDoacao.append('status', 'P');


            const falhas = await fetch('../../../public/index.php?action=registrarDoacao',{
                method: 'POST',
                body: formDataDoacao
            })
            .then(response => response.json())
            .then(async data => {
                console.log(data.id);
                const itens = JSON.parse(sessionStorage.getItem('itens'));
                console.log(itens)
                let countFalha = 0;
                for(item of itens) {
                    if(item.quantidade > 0) {
                        const formDataItens = new FormData();
                        formDataItens.append('id_doacao', data.id);
                        formDataItens.append('id_item', item.id);
                        formDataItens.append('quantidade', item.quantidade);

                        const retorno = fetch('../../../public/index.php?action=registrarDoacaoItem',{
                            method: 'POST',
                            body: formDataItens    
                        })
                        .then(response => response.json())
                        .catch(error => console.log(error))

                        if(retorno.status == "success") {
                            countFalha += 1;
                        }
                    }
                } 
                return countFalha               
            })
            .catch(error => console.log(error));
            
            console.log("falhas: " + falhas);

            if(falhas == 0) {
                document.querySelector(".formFrete").style.display = "none";
                document.querySelector(".doacaoConcluida").classList.remove('--hide');
                setTimeout(() => {
                    sessionStorage.clear();
                    window.location.href = "../../../public/menuDoador.php";   
                }, 5000);
            } else {
                alert("falha ao registra itens");
            }
        }
    }

    if (path.includes('doacaoRecebida.php')) {
        const response = await fetch('../../../public/index.php?action=listarDoacoes')
        .then(response => response.json())
        .then(response => response.dados)
        .then(dados => {
            console.log(dados)
            for(doacao of dados) {
                console.log(doacao)
                const doacaoElemento = document.createElement("div");
                doacaoElemento.classList.add("doacao");
                doacaoElemento.innerHTML = `
                    <p><span>Nome: ${doacao.nome}</span> <span>Data Registrada: <span class="dataRecebida">${doacao.datarecebida}</span></span> <span>Status: ${doacao.status}</span></p>
                `;

                document.querySelector(".listaDoacao").appendChild(doacaoElemento);
            }
        });

        document.querySelector("#pesquisaDoacao").onkeyup = (e) => {
            const doacaoPesquisada = removerAcentos(e.target.value);
            console.log(doacaoPesquisada);
            document.querySelectorAll(".doacao .dataRecebida").forEach((el) => {
                const dataPesquisada = el.textContent;
                console.log(dataPesquisada)
                if(dataPesquisada.indexOf(doacaoPesquisada) == -1) {
                    el.closest(".doacao").classList.add("--hide");
                } else if (el.closest(".doacao").classList.contains("--hide")){
                    el.closest(".doacao").classList.remove("--hide");
                }
            })
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

function menuHamburguer() {
     /**MENU HAMBURGUER */
    const botaoMenu = document.querySelector('.menuHamburguer');
    const menuLateral = document.getElementById('menuLateral');

    botaoMenu.addEventListener('click', () => {
        menuLateral.classList.toggle('--active');
    });

    // Opcional: fecha ao clicar fora
    document.addEventListener('click', (e) => {
        if (!menuLateral.contains(e.target) && !botaoMenu.contains(e.target)) {
            menuLateral.classList.remove('--active');
        }
    });
}