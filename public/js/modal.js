function modalClientData(nome, celular, cpf, cep, estado, cidade, bairro, endereco, numero, descricao)
{
    let nomei = $('#modalClientData').find('#nome');
    nomei.attr('value', nome);

    let cpfi = $('#modalClientData').find('#cpf');
    cpfi.attr('value', cpf);

    let estadoi = $('#modalClientData').find('#estado');
    estadoi.attr('value', estado);

    let bairroi = $('#modalClientData').find('#bairro');
    bairroi.attr('value', bairro);

    let numeroi = $('#modalClientData').find('#numero');
    numeroi.attr('value', numero);

    let celulari = $('#modalClientData').find('#celular');
    celulari.attr('value', celular);

    let cepi = $('#modalClientData').find('#cep');
    cepi.attr('value', cep);

    let cidadei = $('#modalClientData').find('#cidade');
    cidadei.attr('value', cidade);

    let enderecoi = $('#modalClientData').find('#endereco');
    enderecoi.attr('value', endereco);

    let descricaoi = $('#modalClientData').find('#descricao');
    descricaoi.attr('value', descricao);
    
    $('#modalClientData').modal('show');
}