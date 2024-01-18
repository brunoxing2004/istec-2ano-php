$(document).ready(function () {
    $('.view-details').click(function (event) {
        event.preventDefault();

        var title = $(this).data('title');
        var description = $(this).data('description');
        var status = $(this).data('status');
        var response = $(this).data('response');

        // Atualize o conteúdo da caixa de detalhes
        $('#responseText').html("<strong>Status:</strong> " + status + 
                        "<br>" +"<strong>Título:</strong> " + title + 
                        "<br>" +"<strong>Descrição:</strong> " + description + 
                        "<br>" + (response ? "<strong>Resposta:</strong> " + response : ""));

        // Exiba a caixa de detalhes
        $('.details-section').show();
    });
});
