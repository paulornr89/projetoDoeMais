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
