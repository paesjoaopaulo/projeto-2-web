$(document).ready(function () {
    $("#btnCadastrarNoticia").click(function (e) {
        e.preventDefault();

        var form = document.getElementsByTagName('form')[0];
        console.log(form);
        var formData = new FormData(form);
        formData.append('anexo', 'edkçcm');

        console.log(formData);
        //TODO: it
        $.ajax({
            url: "/noticias",
            method: "post",
            enctype: "multipart/form-data",
            data: {
                dados: formData,
                outros: form
            },
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#loading").show()
            },
            success: function (data) {

            }
        }).done(function () {
            $("#loading").hide();
        })
    })
})

setInterval(() => {
    buscarNoticias();
}, 2000);

function buscarNoticias(){
    $.ajax({
        url: '/noticias',
        method: 'get',
        beforeSend: function () {
            $('#ultimasNoticias').find('li').remove();
        },
        success: function (data) {
            if (data.length > 0) {
                $.each(data, function(key, value){
                    $("#ultimasNoticias").append('<li>'+value.titulo+'</li>');  
                })
            } else {
                $("#ultimasNoticias").append("<li>Nenhuma noticia encontrada</li>");
            }
        }
    }).done(function () {
        $(".loaderField").hide();
    });

}
function buscarEndereco(cep) {
    var cepLimpo = cep.replace(/[^0-9]/g, '').toString();
    if (cepLimpo.length === 8) {
        $.ajax({
            url: 'https://viacep.com.br/ws/' + cepLimpo + '/json/',
            method: 'get',
            beforeSend: function () {
                $(".loaderField").show();
                $("#erroCep").remove();
            },
            success: function (data) {
                if (data.erro) {
                    $("#cep").val("");
                    $('<div id="erroCep" class="help-block"><strong>CEP inválido</strong></div>').insertAfter("#cep");
                } else {
                    $('#logradouro').val(data.logradouro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                }
            }
        }).done(function () {
            $(".loaderField").hide();
        });
    }
}