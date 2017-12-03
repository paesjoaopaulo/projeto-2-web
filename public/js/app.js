$(document).ready(function () {

    (function() {
        var timeout;
        $('#pesquisaInput').keyup( function() {
            var elem = $(this);
            var string = elem.val();

            if (string.length >= 3) {
                $("#itensPesquisa").show();
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                   $.ajax({ // ajax stuff
                        url: "/noticias/sn/?q="+string,
                        method: "get",
                        success : function(data){
                            $('#itensPesquisa').find("li").remove();
                            $.each(data, function(key, obj){
                                console.log(obj);
                                $("#itensPesquisa>ul").append("<li><a href='#'>" + obj.titulo + "</a></li>");                                
                            })
                        }
                    });     
                }, 300); // <-- choose some sensible value here                                      
            } else if (string.length <= 1) { /*show original content*/ }
        });
    }());

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
}, 10000);

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