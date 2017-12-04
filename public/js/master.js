var searchResultsSelector = "#searchResults"

$(document).ready(function () {
    var timeOut;
    $('#q').on('keyup', function () {
        clearTimeout(timeOut)
        var string = $(this).val()
        timeOut = setTimeout(function () {
            if (string.length >= 3) {
                if (!$(searchResultsSelector).is(":visible")) {
                    $(searchResultsSelector).show();
                }
                AjaxRequest('/noticias/sn/', 'get', {q: string}, searchNoticiasCallback, '#search-loader')
            } else {
                $(searchResultsSelector + ' > ul').find('li').remove();
                $(searchResultsSelector + ' > ul').append('<li>Informe ao menos 3 caracteres</li>');
            }
        }, 300)
    })

    $("#q").on("focusout", function () {
        setTimeout(function () {
            $(searchResultsSelector).hide();
        }, 300)
    })

    $("#q").on("focus", function () {
        if ($(this).val().length >= 3) {
            $(searchResultsSelector).show();
        }
    })

    $("#btnCadastrarNoticia").click(function () {
        var data = $(this).parents('form').serializeArray();
        AjaxRequest(
            '/noticias',
            'post',
            data,
            function (data) {
                if (data.error) {
                    alert("Erro na requisção");
                    console.log(data)
                } else {
                    $("#frm_cadastrarNoticia").get(0).reset();
                    var date = new Date(data.resource.published_at);
                    $("#ultimasNoticias > li:last").remove();
                    $('<li>' + data.resource.titulo + ' - <strong>' + date.getDate() + '/' + date.getMonth() + '/' + date.getYear() + '</strong></li>').insertBefore("#ultimasNoticias > li:first");
                    console.log(data)
                }
            },
            "#loader"
        )
    });

})

var searchNoticiasCallback = function (data) {
    console.clear();
    if (data.length > 0) {
        $(searchResultsSelector).find('li').remove();
        $.each(data, function (key, obj) {
            var tituloNoticia = obj.titulo;
            var search = $("#q").val();
            tituloNoticia = tituloNoticia.replace(new RegExp('('+search+')', "gi"), '<b>$1</b>')
            console.log(tituloNoticia)
            $(searchResultsSelector + ' > ul').append('<li><a href="/noticias/' + obj.id + '">' + tituloNoticia + '</a></li>');
        })
    } else {
        $(searchResultsSelector + ' > ul').find('li').remove();
        $(searchResultsSelector + ' > ul').append('<li>Nenhum resultado encontrado</li>');
    }
}

function buscarEndereco(cep) {
    var cepLimpo = cep.replace(/[^0-9]/g, '').toString();
    if (cepLimpo.length === 8) {
        AjaxRequest(
            'https://viacep.com.br/ws/' + cepLimpo + '/json/',
            'get',
            null,
            function (data) {
                $("#erroCep").remove();
                if (data.erro) {
                    $("#cep").val("");
                    $('<div id="erroCep" class="help-block"><strong>CEP inválido</strong></div>').insertAfter("#cep");
                } else {
                    $('#logradouro').val(data.logradouro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                }
            },
            '#loader'
        );
    }
}