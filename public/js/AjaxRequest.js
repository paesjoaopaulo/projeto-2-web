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
            400: function () {
                alert("BAD REQUEST: os parâmetros informados não são válidos");
            },
            201: function () {
                alert("CREATED: recurso cadastrado com sucesso");
            },
            500: function () {
                alert("INTERNAL SERVER ERROR: erro interno no servidor");
            },
        },
        complete: function () {
            //Se der erro ou sucesso
            $(loaderSelector).hide()
        }
    })
}