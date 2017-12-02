$(document).ready(function () {
    $("#btnCadastrarNoticia").click(function (e) {
        e.preventDefault();

        var form = $('#frm_cadastrarNoticia').serialize();
        var formData = new FormData(form);
        formData.append('anexo', 'anexo');
        console.log(formData);
        //TODO: it
        $.ajax({
            url: "/noticias",
            method: "post",
            data: {dados: null},
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
    console.log(cepLimpo);
}