var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

/*$(function() {

    // Atribui evento e função para limpeza dos campos
    //$('#busca').on('input', limpaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $( "#caixaTextoBusca" ).autocomplete({
        minLength: 3,
        source: function( request, response ) {
            $.ajax({
                url: "consultaBanco.php",
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
            $("#caixaTextoBusca").val( ui.item.titulo );
            carregarDados();
            return false;
        },
        select: function( event, ui ) {
            $("#caixaTextoBusca").val( ui.item.titulo );
            return false;
        }
    })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a><b>Matrícula: </b>" + item.matricula + "<br><b>Nome: </b>" + item.nome + " - <b> Data Nascimento: </b>" + item.dt_nascimento + "<b>CPF: </b>\" + item.cpf + \"<br></a><br>" )
            .appendTo( ul );
    };

    // Função para carregar os dados da consulta nos respectivos campos
    function carregarDados(){
        var busca = $('#caixaTextoBusca').val();

        if(busca != "" && busca.length >= 3){
            $.ajax({
                url: "consultaBanco.php",
                dataType: "json",
                data: {
                    acao: 'consulta',
                    parametro: $('#caixaTextoBusca').val()
                },
                success: function( data ) {
                    $('#codigo_barra').val(data[0].codigo_barra);
                    $('#titulo_livro').val(data[0].titulo);
                    $('#categoria').val(data[0].categoria);
                    $('#valor_compra').val(data[0].valor_compra);
                    $('#valor_venda').val(data[0].valor_venda);
                    $('#data_cadastro').val(data[0].data_cadastro);
                    $('#status').val(data[0].status);
                }
            });
        }
    }

    // Função para limpar os campos caso a busca esteja vazia
    function limpaCampos(){
        var busca = $('#busca').val();

        if(busca == ""){
            $('#codigo_barra').val('');
            $('#titulo_livro').val('')
            $('#categoria').val('');
            $('#valor_compra').val('');
            $('#valor_venda').val('');
            $('#data_cadastro').val('');
            $('#status').val('')
        }
    }
    function altPlaceHolderBusca(){
        var rbt = document.getElementsByName('tipoPesq');

        rbt.val
    }
});
*/

function getRadioValor(){
    var rads = document.getElementsByName('tipoPesq');
    var valor = "";


    for(var i = 0; i < rads.length; i++){
        if(rads[i].checked){
            if(rads[i].value=='matricula') {
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