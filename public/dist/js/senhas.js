function confereSenha() {

    const senha = document.getElementById('senha');

    const confsenha = document.getElementById('confsenha');

    function fun_validar_senha(senha) {

        if (senha.length < 8) {

            return false;

        }

        if (!/[a-z]/.test(senha)) {

            return false;

        }

        if (!/[A-Z]/.test(senha)) {

            return false;

        }

        if (!/[0-9]/.test(senha)) {

            return false;

        }

        if (!/[!@#$%^&*()\-_=+{};:,<.>]/.test(senha)) {

            return false;

        }

        return true;

    }

    if (confsenha.value === senha.value) {

        if (fun_validar_senha(senha.value)) {

        } else {

            modalSenhas();

            senha.focus();

            return false;

        }

    } else {

        confsenha.setCustomValidity('As senhas não conferem');

        return false;

    }

    confsenha.setCustomValidity('');

    return true;

}

function mudarCor() {

    var senha = document.getElementById('senha').value;

    var requisitos = [

        /[A-Z]/.test(senha),

        /[a-z]/.test(senha),

        /\d/.test(senha),

        senha.length >= 8,

        /[\W_]/.test(senha)

    ];

    var divs = [

        document.getElementById('letraMai'),

        document.getElementById('letraMin'),

        document.getElementById('numero'),

        document.getElementById('digitos'),

        document.getElementById('caractere')

    ];

    divs.forEach(function (div, index) {

        if (requisitos[index]) {

            div.classList.remove('text-danger');

            div.classList.add('text-success');

        } else {

            div.classList.remove('text-success');

            div.classList.add('text-danger');

        }

    });

}

function alterarVisibilidade(inputId) {
    
    const passwordInput = document.getElementById(inputId);
    
    const icon = passwordInput.parentElement.querySelector('.alterarVisibilidade');

    if (passwordInput.type === 'password') {

        passwordInput.type = 'text';

        icon.classList.remove('fa-eye');

        icon.classList.add('fa-eye-slash');

    } else {

        passwordInput.type = 'password';

        icon.classList.remove('fa-eye-slash');

        icon.classList.add('fa-eye');

    }
    
}