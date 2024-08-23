function confereSenha() 
{    
    let inputSenha = document.getElementById('senha');
    let inputConfsenha = document.getElementById('confsenha');
    let senha = inputSenha.value;
    let confsenha = inputConfsenha.value;

    inputSenha.setCustomValidity('');
    inputConfsenha.setCustomValidity('');

    if (confsenha != senha) {

        inputConfsenha.setCustomValidity('As senhas não conferem');

        inputConfsenha.reportValidity();
    }

    if (senha.length < 8) {

        inputSenha.setCustomValidity('A senha deve conter no mínimo 8 caracteres.');
    }

    if (!/[a-z]/.test(senha)) {

        inputSenha.setCustomValidity('A senha deve conter ao menos uma letra minúscula.');
    }

    if (!/[A-Z]/.test(senha)) {

        inputSenha.setCustomValidity('A senha deve conter ao menos uma letra maiúscula.');
    }

    if (!/[0-9]/.test(senha)) {

        inputSenha.setCustomValidity('A senha deve conter ao menos um número.');
    }

    if (!/[!@#$%^&*()\-_=+{};:,<.>]/.test(senha)) {

        inputSenha.setCustomValidity('A senha deve conter ao menos um caracter especial.');
    }

    senha.reportValidity();
}

function validarSenha(senha)
{
    return [
        /[A-Z]/.test(senha),

        /[a-z]/.test(senha),

        /\d/.test(senha),

        senha.length >= 8,

        /[\W_]/.test(senha)
    ];
}

function mudarCor() 
{
    let senha = document.getElementById('senha').value;

    let requisitos = validarSenha(senha);

    let divs = [

        document.getElementById('letraMai'),

        document.getElementById('letraMin'),

        document.getElementById('numero'),

        document.getElementById('digitos'),

        document.getElementById('caractere')
    ];

    requisitos.forEach(function (valido, index) {
        divs[index].classList.toggle('text-success', valido);
        divs[index].classList.toggle('text-danger', !valido);
    });
}

function alterarVisibilidade(inputId, iconElement) 
{
    const passwordInput = document.getElementById(inputId);

    const isPasswordVisible = passwordInput.type === 'password';
    passwordInput.type = isPasswordVisible ? 'text' : 'password';

    iconElement.classList.toggle('fa-eye', !isPasswordVisible);
    iconElement.classList.toggle('fa-eye-slash', isPasswordVisible);
}