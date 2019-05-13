$('#sensitivity').on('click', function(){
    $('#step-three').fadeOut("slow");
    $('#relatorio').fadeIn("slow");
});

$('#voltar-resultado').on('click', function(){
    $('#step-three').fadeIn("slow");
    $('#relatorio').fadeOut("slow");
})

$('#voltar-func').on('click', function(){
    $('#step-two').fadeIn("slow");
    $('#step-three').fadeOut("slow");
});

$('#next-step-3').on('click',function(){
    $.ajax({
        url: 'function_part2.php',
        type: 'post',
        dataType: 'json',
        data:  $('form').serialize(),
        success: function(json){
            if(json.erros != undefined){
                document.getElementById("modal-dynamic-content").innerHTML = "Ops... <br>"+json.erros;
                $('#modalError').modal();
            }else {

                $('#step-two').fadeOut("slow");
                $('#step-three').fadeIn("slow");

                var dados = json.dados;
                var finais = dados.valores_finais;
                var tabela = dados.tabela;
                var sensibilidade = dados.sensibilidade;

                $('#relatorio-sensibilidade').html(sensibilidade);
                $('#relatorio-sensibilidade-2').html(sensibilidade);
                $('#resolucao-final').html(tabela[tabela.length - 1]);
                var strBuilder = [];
                for (key in finais) {
                    if (finais.hasOwnProperty(key)) {
                        if (key == 'Z') {
                            if (dados.tipo_funcao == 'min') {
                                finais[key] = finais[key] * -1;
                            }

                            $('#var-z').html('Z = ' + finais[key]);
                        } else {
                            $('#others-var').append('<h6>' + key + ' = ' + finais[key] + '</h6>')
                        }
                    }
                }
            }
        },
        error: function(json){
            document.getElementById("modal-dynamic-content").innerHTML = "Ops... <br> Esta função não possui solução ou possui solução infinitas.";
            $('#modalError').modal();
        }
    });
});

$('#next-step-2').on('click',function(){
    $('#passo-a-passo').val('OK');

    $.ajax({
        url: 'function_part2.php',
        type: 'post',
        dataType: 'json',
        data:  $('form').serialize(),
        success: function(resposta){
            if(resposta.erros != undefined) {
                document.getElementById("modal-dynamic-content").innerHTML = "Ops... <br>" + resposta.erros;
                $('#modalError').modal();
            } else {
                /*Olá, Matheus! Tenta fazer esta maravilha funcionar. Estou mandando codificado o array de iterações e
            também a tabela de sensibilidade já p  ronta, só precisa ajustar essa função, que não está funcinando...*/
                $('#relatorio-sensibilidade-2').html(resposta.sensibilidade);
                window.localStorage.setItem("sensibilidade",JSON.stringify(resposta.sensibilidade));
                window.localStorage.setItem("tabela",JSON.stringify(resposta.interacoes));
                window.location.replace('step4.php#myTable');
            }

        },
        error: function(resposta){
            if(resposta.erros != undefined) {
                document.getElementById("modal-dynamic-content").innerHTML = "Ops... <br>" + resposta.erros;
                $('#modalError').modal();
            } else {
                teste = resposta.interacoes['responseText'];
                teste2 = teste.replace("}]}]", "}]}] ;");
                teste3 = teste2.split(";");
                teste3 = teste3[0];
                window.localStorage.setItem("tabela", teste3);
                window.localStorage.setItem("erro", JSON.stringify(resposta.interacoes));
                window.localStorage.setItem("sensibilidade", JSON.stringify(resposta.sensibilidade));
                window.location.replace('step4.php#myTable');
            }
        }
    });
});