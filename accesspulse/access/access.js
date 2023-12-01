function AcessarEspaco(idEspaco, cpfUsuario, level){
    $.ajax({
        type: 'POST',
        url: 'exibirEspacos.php', 
        data: { idEspaco: idEspaco, cpfUsuario: cpfUsuario, level: level, action: 'acessar' },
        success: function(response) {
            alert("Acesso liberado", response);
            window.location.href = 'access.php';
        },
        error: function(error) {
            alert("Erro ao acessar espaço. Favor procurar a recepção.", error);
        }
    });
}