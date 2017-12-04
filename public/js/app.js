$(document).ready(function () {

    var timeout;
    $('#pesquisaInput').on("keyup, focusout", function () {
        var elem = $(this);
        var string = elem.val();

        console.error(string)

        if (string.length >= 3) {
            $("#itensPesquisa").show();
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                $.ajax({
                    url: "/noticias/sn/?q=" + string,
                    method: "get",
                    success: function (data) {
                        $('#itensPesquisa').find("li").remove();
                        $.each(data, function (key, obj) {
                            console.log(obj);
                            $("#itensPesquisa>ul").append("<li><a href='/noticias/" + obj.id + "'>" + obj.titulo + "</a></li>");
                        })
                    }
                });
            }, 300);
        } else if (string.length <= 1) {
            //$("#itensPesquisa>ul").find("li").remove().hide();
        }
    });

    $("#pesquisaInput").on("focusout", function (e) {
        $("#itensPesquisa>ul").find("li").remove().hide();
    })


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
            beforeSend: function () {
                alert("entrou no loading");
                $("#loading").show()
            },
            success: function (data) {
                console.log(data)
                return true;
            }
        }).done(function () {
            alert("saiu do loading");
            $("#loading").hide();
        })
    })
})

setInterval(function () {
    buscarNoticias()
}, 1000);

function buscarNoticias() {
    $.ajax({
        url: '/noticias',
        method: 'get',
        beforeSend: function () {
            $('#ultimasNoticias').find('li').remove();
        },
        success: function (data) {
            console.log(data)
            return true;
            if (data.length > 0) {
                $.each(data, function (key, value) {
                    $("#ultimasNoticias").append('<li>' + value.titulo + '</li>');
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