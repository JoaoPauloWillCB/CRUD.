function buscaCEP(cepInput) 
{
    let cep = cepInput.replace(/-/g, '');

    const requestOptions = {
        method: "GET",
        redirect: "follow"
    };

    fetch(`https://viacep.com.br/ws/${cep}/json/`, requestOptions)
    .then((response) => {

        if (!response.ok) throw new Error('Network response was not ok.');

        return response.json();
    })
        
    .then((result) => {
        
        if(result) {

            document.getElementById('endereco-cep').value = result.logradouro;

            document.getElementById('bairro').value = result.bairro;

            document.getElementById('cidade').value = result.localidade;

            document.getElementById('estado').value = result.estado;
        }
    })

    .catch((error) => console.error('Error: ', error));
}