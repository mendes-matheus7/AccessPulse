function mudaPlanoMembro(cpfMembro, idPlano){
    $.ajax({
        type: 'POST',
        url: 'exibirPlanos.php', 
        data: { cpfMembro: cpfMembro, idPlano: idPlano, action: 'alterarPlano' },
        success: function(response) {
            alert("Plano Alterado com sucesso", response);
            window.location.href = '../access/access.php';
        },
        error: function(error) {
            alert("Erro ao alterar o plano. verifique se existem pendências financeiras.", error);
        }
    });
}