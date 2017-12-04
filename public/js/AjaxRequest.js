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
    
    if(urlParam === undefined)
        throw new error("Informe a URL para a requisição")
    if(methodParam === undefined)
        methodParam = "get"
    if(dataParam === undefined)
        dataParam = null
    if(onSuccessCallback === undefined)
        onSuccessCallback = function(data){
            console.log(data)
        }
    if(loaderSelector === undefined)
        loaderSelector = "#loading"
    if(dataTypeParam === undefined)
        dataTypeParam = "json"
    if(contentTypeParam === undefined)
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
        error: function(data, code){
            alert("Erro na Requisição Ajax")
        },
        complete: function () {
            //Se der erro ou sucesso
            $(loaderSelector).hide()
        }
    })
}