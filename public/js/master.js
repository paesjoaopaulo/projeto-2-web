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

})

var searchNoticiasCallback = function (data) {
    console.clear();
    if (data.length > 0) {
        $(searchResultsSelector).find('li').remove();
        $.each(data, function (key, obj) {
            $(searchResultsSelector + ' > ul').append('<li><a href="/noticias/' + obj.id + '">' + obj.titulo + '</a></li>');
        })
    } else {
        $(searchResultsSelector + ' > ul').find('li').remove();
        $(searchResultsSelector + ' > ul').append('<li>Nenhum resultado encontrado</li>');
    }
}