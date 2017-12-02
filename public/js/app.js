var array = [
    {titulo: "sebastiao"},
    {titulo: "palo"}
]


$(document).ready(function () {

    (function() {
        var timeout;
        $('#pesquisaInput').keyup( function() {
            var elem = $(this);
            var string = elem.val();

            if (string.length >= 3) {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                   $.ajax({ // ajax stuff
                        url: "/noticias/sn/"+string,
                        method: "get",
                        success : function(data){ console.log(data) }
                    });     
                }, 80); // <-- choose some sensible value here                                      
            } else if (string.length <= 1) { /*show original content*/ }
        });
    }());

    $("#pesquisaInput").on("focus", function(e){
    $.each(array, function(key, value){
        $("#itensPesquisa>ul").append("<li><a href='#'>"+value.titulo+"</a></li>");
        
    })        
        $("#itensPesquisa").show();
    })
    
    $("#pesquisaInput").on("focusout", function(e){
        $("#itensPesquisa").hide();
        $("#itensPesquisa").find('li').remove();
    })    
    
    $("#pesquisaInput").on("focusout", function(e){
        $("#itensPesquisa").hide();
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