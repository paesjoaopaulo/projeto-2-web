$(document).ready(function(){
    $("#btnCadastrarNoticia").click(function(e){
        e.preventDefault();
        $.ajax({
            url: "/noticias",
            method: "post",
            data: {'teste':1},
            beforeSend: function(){
                $("#loading").show()
            },
            success: function(data){

            }
        }).done(function(){
            $("#loading").hide();
        })
    })
}) 
