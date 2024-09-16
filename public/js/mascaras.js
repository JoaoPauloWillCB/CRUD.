document.addEventListener("DOMContentLoaded", function () {

    var telefone = document.getElementById("telefone");

    var celular = document.getElementById("celular");

    var cpfCnpj = document.getElementById("cpfCnpj");

    var cpf = document.getElementById("cpf");

    var cnpj = document.getElementById("cnpj");

    var data = document.getElementById("data");

    var cep = document.getElementById("cep");

    var nome = document.getElementById("nome");

    var rh = document.getElementById("rh");

    var cidade = document.getElementById("cidade");

    var bairro = document.getElementById("bairro");

    var endereco = document.getElementById("endereco");

    var emergenciaNome = document.getElementById("emergenciaNome[]");

    var emergenciaNumero = document.getElementById("emergenciaNumero[]");

    var emergenciaParentesco = document.getElementById("emergenciaParentesco[]");


    if (telefone) {

        telefone.addEventListener("input", function () {

            mascaraTelefone(this);

        });

    }

    if (bairro) {

        bairro.addEventListener("input", function () {

            mascaraBairro(this);

        });

    }

    if (celular) {

        celular.addEventListener("input", function () {

            mascaraCelular(this);

        });

    }

    if (cpfCnpj) {

        cpfCnpj.addEventListener("input", function () {

            mascaraCpfCnpj(this);

        });

    }

    if (cpf) {

        cpf.addEventListener("input", function () {

            mascaraCpf(this);

        });

    }

    if (cnpj) {

        cnpj.addEventListener("input", function () {

            mascaraCnpj(this);

        });

    }

    if (data) {

        data.addEventListener("input", function () {

            mascaraData(this);

        });

    }

    if (cep) {

        cep.addEventListener("input", function () {

            mascaraCep(this);

        });

    }

    if (nome) {

        nome.addEventListener("input", function () {

            mascaraNome(this);

        });

    }

    if (rh) {

        rh.addEventListener("input", function () {

            mascaraRH(this);

        });

    }

    if (endereco) {

        endereco.addEventListener("input", function () {

            mascaraEndereco(this);

        });

    }

    if (cidade) {

        cidade.addEventListener("input", function () {

            mascaraCidade(this);

        });

    }

    if (emergenciaNome) {

        emergenciaNome.addEventListener("input", function () {

            mascaraEmergenciaNome(this);

        });

    }

    if (emergenciaNumero) {

        emergenciaNumero.addEventListener("input", function () {

            mascaraEmergenciaNumero(this);

        });

    }

    if (emergenciaParentesco) {

        emergenciaParentesco.addEventListener("input", function () {

            mascaraEmergenciaParentesco(this);

        });

    }
    
    function mascaraTelefone(telefone) {

        telefone.value = telefone.value.replace(/\D/g, "");
        telefone.value = telefone.value.replace(/^(\d{2})(\d)/g, "($1) $2");
        telefone.value = telefone.value.replace(/(\d)(\d{4})$/, "$1-$2");

    }

    function mascaraCelular(celular) {

        celular.value = celular.value.replace(/\D/g, "");
        celular.value = celular.value.replace(/^(\d{2})(\d)/g, "($1) $2");
        celular.value = celular.value.replace(/(\d)(\d{4})$/, "$1-$2");

    }

    function mascaraCpfCnpj(cpfCnpj) {

        var valor = cpfCnpj.value;

        valor = valor.replace(/\D/g, "");

        if (valor.length <= 11) {

            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");

            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");

            valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        } else {

            valor = valor.replace(/^(\d{2})(\d)/, "$1.$2");

            valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");

            valor = valor.replace(/\.(\d{3})(\d)/, ".$1/$2");

            valor = valor.replace(/(\d{4})(\d)/, "$1-$2");

        }

        cpfCnpj.value = valor;

    }

    function mascaraCpf(cpf) {

        var valor = cpf.value;

        valor = valor.replace(/\D/g, "");

        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");

        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");

        valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        cpf.value = valor;

    }

    function mascaraCnpj(cnpj) {

        var valor = cnpj.value;

        valor = valor.replace(/\D/g, "");

        valor = valor.replace(/^(\d{2})(\d)/, "$1.$2");

        valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");

        valor = valor.replace(/\.(\d{3})(\d)/, ".$1/$2");

        valor = valor.replace(/(\d{4})(\d)/, "$1-$2");

        cnpj.value = valor;

    }

    function mascaraData(data) {

        var valor = data.value;

        valor = valor.replace(/\D/g, "");

        valor = valor.replace(/^(\d{2})(\d)/, "$1/$2");

        valor = valor.replace(/^(\d{2})\/(\d{2})(\d{4})$/, "$1/$2/$3");

        data.value = valor;

    }

    function mascaraNome(nome) {

        var valor = nome.value;

        valor = valor.replace(/[^a-zA-ZÀ-ÿ ]/g, '');

        nome.value = valor;

    }

    function mascaraBairro(bairro) {

        var valor = bairro.value;

        valor = valor.replace(/[^a-zA-ZÀ-ÿ ]/g, '');

        bairro.value = valor;

    }

    function mascaraEndereco(endereco) {

        var valor = endereco.value;

        valor = valor.replace(/[^a-zA-ZÀ-ÿ ]/g, '');

        endereco.value = valor;

    }

    function mascaraCidade(cidade) {

        var valor = cidade.value;

        valor = valor.replace(/[^a-zA-ZÀ-ÿ ]/g, '');

        cidade.value = valor;

    }

    function mascaraRH(rh) {

        var valor = rh.value;

        valor = valor.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');

        rh.value = valor;

    }

    function mascaraCep(cep) {

        var valor = cep.value;

        valor = valor.replace(/\D/g,'')

        valor = valor.replace(/(\d{5})(\d)/,'$1-$2')

        cep.value = valor;

    }

    function mascaraEmergenciaNome(emergenciaNome) {

        emergenciaNome.value = emergenciaNome.value.replace(/[^a-zA-ZÀ-ÿ ]/g, '');

    }

    function mascaraEmergenciaNumero(emergenciaNumero) {

        emergenciaNumero.value = emergenciaNumero.value.replace(/\D/g, "");

        emergenciaNumero.value = emergenciaNumero.value.replace(/^(\d{2})(\d)/g, "($1) $2");

        emergenciaNumero.value = emergenciaNumero.value.replace(/(\d)(\d{4})$/, "$1-$2");

    }

    function mascaraEmergenciaParentesco(emergenciaParentesco) {

        var valor = emergenciaParentesco.value;

        valor = valor.replace(/[^a-zA-ZÀ-ÿ ]/g, '');

        emergenciaParentesco.value = valor;

    }

});