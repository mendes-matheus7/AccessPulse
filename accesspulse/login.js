function formatarCPF(campo) {
    // Remove caracteres não numéricos
    var cpfAtual = campo.value.replace(/\D/g, '');

    // Garante que não tenha mais de 11 caracteres
    if (cpfAtual.length > 11) {
        cpfAtual = cpfAtual.substring(0, 11);
    }

    // Adiciona pontos e traço conforme o formato do CPF
    if (cpfAtual.length <= 3) {
        campo.value = cpfAtual;
    } else if (cpfAtual.length <= 6) {
        campo.value = cpfAtual.substring(0, 3) + '.' + cpfAtual.substring(3);
    } else if (cpfAtual.length <= 9) {
        campo.value = cpfAtual.substring(0, 3) + '.' + cpfAtual.substring(3, 6) + '.' + cpfAtual.substring(6);
    } else {
        campo.value = cpfAtual.substring(0, 3) + '.' + cpfAtual.substring(3, 6) + '.' + cpfAtual.substring(6, 9) + '-' + cpfAtual.substring(9);
    }

    // Armazena apenas os números em um campo oculto
    document.getElementById('cpf').value = cpfAtual;
}