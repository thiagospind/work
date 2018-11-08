

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

/*
$("#caixaTextoBusca").autocomplete({
    minlength: 3,
    source: function( request, response ) {
        $.ajax({
            url: "buscaAssociados.php",
            dataType: "json",
            data: {
                acao: 'autocomplete',
                parametro: $('#caixaTextoBusca').val()
            },
            success: function(data) {
                response(data);
            }
        });
    },
    focus: function( event, ui ) {
        $("#caixaTextoBusca").val( ui.item.title );
        carregarDados();
        return false;
    },
    select: function( event, ui ) {
        $("#caixaTextoBusca").val();
        return false;
    }

});
*/

$("#caixaTextoBusca").autocomplete({
    minLength: 3,
    source: 'buscaAssociados.php',
    select: function( event, ui){
        var matr = ui.item.id;
        if (matr != '') {
            event.preventDefault();
            $("#matricula").prop("checked", true);
            $("#caixaTextoBusca").val(matr);
            //$("#caixaTextoBusca").attr('value',matr);
            //$("#botao").click(function () {});
            $("#botao").trigger('click');

        }
    }
});

/*
function getRadioValor() {
    var rads = document.getElementsByName('tipoPesq');
    var valor = "";


    for (var i = 0; i < rads.length; i++) {
        if (rads[i].checked) {
            if (rads[i].value == 'matricula') {
                valor = 'Informe a Matrícula...';
                document.getElementById('caixaTextoBusca').type = 'number';
                document.getElementById('caixaTextoBusca').maxlength = '6';
            }
            else {
                valor = 'Informe o Nome...';
                document.getElementById('caixaTextoBusca').type = 'text';
            }

            document.getElementById('caixaTextoBusca').placeholder = valor;

        }
    }
}
*/