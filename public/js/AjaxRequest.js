/**
 *
 * @param {*} urlParam
 * @param {*} methodParam
 * @param {*} dataParam
 * @param {*} onSuccessCallback
 * @param {*} loaderSelector
 * @param {*} dataTypeParam
 * @param {*} contentTypeParam
 */
function AjaxRequest(urlParam, methodParam, dataParam, onSuccessCallback, loaderSelector, dataTypeParam, contentTypeParam) {

    if (urlParam === undefined)
        throw new error("Informe a URL para a requisição")
    if (methodParam === undefined)
        methodParam = "get"
    if (dataParam === undefined)
        dataParam = null
    if (onSuccessCallback === undefined)
        onSuccessCallback = function (data) {
            console.log(data)
        }
    if (loaderSelector === undefined)
        loaderSelector = "#loading"
    if (dataTypeParam === undefined)
        dataTypeParam = "json"
    if (contentTypeParam === undefined)
        contentTypeParam = "application/x-www-form-urlencoded; charset=UTF-8"

    $.ajax({
        url: urlParam,
        method: methodParam,
        dataType: dataTypeParam,
        contentType: contentTypeParam,
        data: dataParam,
        beforeSend: function () {
            //Exibir loader
            $(loaderSelector).show()
        },
        success: onSuccessCallback,
        statusCode: {
            400: function (data) {
                console.error("BAD REQUEST: os parâmetros informados não são válidos");
                exibeErros(data.responseJSON.errorMessage)
            },
            201: function () {
                console.info("CREATED: recurso cadastrado com sucesso");
            },
            500: function () {
                console.error("INTERNAL SERVER ERROR: erro interno no servidor");
            },
        },
        complete: function () {
            //Se der erro ou sucesso
            $(loaderSelector).hide()
        }
    })
}

function exibeErros(errors) {
    var campos = Object.keys(errors);
    $(".erro-encontrado").remove();
    $('.has-error').removeClass('has-error');
    $.each(campos, function (key, value) {
        $("#" + value).parents('.form-group').addClass('has-error');

        var erros = Object.values(errors)[key];
        erros = erros.toString().split(',');
        console.log(erros);
        var htmlerros = "";
        $.each(erros, function(key, value){
            htmlerros+=value+"<br>";
        })
        $('<span class="help-block erro-encontrado"><strong>' + htmlerros + '</strong></span>').insertAfter("#" + value)
    })
}