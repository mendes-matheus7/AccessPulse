function showInformation(mainID, usuarioCPF){
    if(mainID == 1){
        document.getElementById("dados").style.display = "block";
        document.getElementById("plano").style.display = "none";
        document.getElementById("financeiro").style.display = "none";
        document.getElementById("acesso").style.display = "none";
        exibirDadosUsuario(usuarioCPF)
    } else if(mainID == 2){
        document.getElementById("dados").style.display = "none";
        document.getElementById("plano").style.display = "block";
        document.getElementById("financeiro").style.display = "none";
        document.getElementById("acesso").style.display = "none";
        exibirPlano(usuarioCPF);
    } else if(mainID == 3){
        document.getElementById("dados").style.display = "none";
        document.getElementById("plano").style.display = "none";
        document.getElementById("financeiro").style.display = "block";
        document.getElementById("acesso").style.display = "none";
    } else if(mainID == 4){
        document.getElementById("dados").style.display = "none";
        document.getElementById("plano").style.display = "none";
        document.getElementById("financeiro").style.display = "none";
        document.getElementById("acesso").style.display = "block";
        exibirAcesso(usuarioCPF);
    }
}

function exibirDadosUsuario(usuarioCPF){
    var divInfoUsuario = document.getElementById('info');

    divInfoUsuario.innerHTML = '';

    // Envia uma solicitação AJAX para a URL do arquivo PHP
    $.ajax({
        type: 'POST',
        url: 'exibirDadosUsuario.php', // A URL do arquivo PHP
        data: { usuarioCPF: usuarioCPF},
        success: function(data) {
            divInfoUsuario.innerHTML += data;
        },
        error: function() {
            divInfoUsuario.innerHTML += '<br>Erro ao buscar dados do usuário.';
        }
    });
}

function exibirPlano(usuarioCPF){
    var divInfoPlano = document.getElementById('infoPlano');
    
    divInfoPlano.innerHTML = '';
    // Envia uma solicitação AJAX para a URL do arquivo PHP
    $.ajax({
        type: 'POST',
        url: 'exibirPlano.php', // A URL do arquivo PHP
        data: { usuarioCPF: usuarioCPF},
        success: function(data) {
            divInfoPlano.innerHTML += data;
        },
        error: function() {
            divInfoPlano.innerHTML += '<br>Erro ao buscar dados do usuário.';
        }
    });
}

function exibirAcesso(usuarioCPF){
    var divInfoAcesso = document.getElementById('infoAcesso');
    
    divInfoAcesso.innerHTML = '';
    // Envia uma solicitação AJAX para a URL do arquivo PHP
    $.ajax({
        type: 'POST',
        url: 'exibirAcesso.php', // A URL do arquivo PHP
        data: {},
        success: function(data) {
            divInfoAcesso.innerHTML += data;
        },
        error: function() {
            divInfoAcesso.innerHTML += '<br>Erro ao buscar dados do usuário.';
        }
    });
}

function validarSenha() {
    var senha = document.getElementById("senha").value;
    var confirmarSenha = document.getElementById("confirmarSenha").value;

    if (senha !== confirmarSenha) {
        alert("As senhas não coincidem. Por favor, digite novamente.");
        return false; // Impede o envio do formulário
    }

    return true; // Permite o envio do formulário se as senhas coincidirem
}