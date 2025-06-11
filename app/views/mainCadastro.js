document.querySelector(".cadastro").onsubmit = async (e) => {
    e.preventDefault();
    console.log("teste")
    try {
        const formData = new FormData(); // Coleta tudo automaticamente
        formData.append('nome', document.getElementById('nome').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('cpf_cnpj', document.getElementById('cpf_cnpj').value);
        formData.append('telefone', document.getElementById('telefone').value);
        formData.append('cep', document.getElementById('cep').value);
        formData.append('endereco', document.getElementById('endereco').value + " - " + document.getElementById('numero').value + " - " + document.getElementById('complemento').value);
        formData.append('cidade', document.getElementById('cidade').value);
        formData.append('uf', document.getElementById('uf').value);
        formData.append('tipo', document.querySelector('input[name="tipo"]:checked').value);
        formData.append('senha', document.getElementById('senha').value);

        const response = await fetch('../../public/index.php?action=cadastrar', {
            method: 'POST',
            body: formData
        })

        // const resultado = await response.json();
        // alert(resultado.message);
        const text = await response.text();
    console.log(text);
    } catch (e) {
        console.log(e)
    }
}