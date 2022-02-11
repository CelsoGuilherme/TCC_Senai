function somenteNumeros(){
    var sDigitos ="0123456789,.-()";
    var cTecla = event.key;
    if(sDigitos.indexOf(cTecla)==-1){
        return false;
    }else{
        return true;
    }
}

function somenteLetra(){
    var sDigitos = "qwertyuiopasdfghjklçzxcvbnmQWERTYUIOPASDFGHJKLÇZXCVBNMáéíóúÁÉÍÓÚâêôÂÊÔãõÃÕ ";
    var cTecla = event.key;
    if(sDigitos.indexOf(cTecla)==-1){
        return false;
    }else{
        return true;
    }
}

// preenchimento de endereço automático
function limpa_formulário_cep(){
    //Limpa valores do formulário de cep.
    id('rua').value=("");
    id('bairro').value=("");
    id('cidade').value=("");
}

function meu_callback(conteudo){
    if(!("erro" in conteudo)){
        //Atualiza os campos com os valores.
        id('rua').value=(conteudo.logradouro);
        id('bairro').value=(conteudo.bairro);
        id('cidade').value=(conteudo.localidade);
        id("informaCEP").innerHTML = '';
    } 
    else{
        //CEP não Encontrado.
        limpa_formulário_cep();
        id('rua').placeholder = "CEP Não Encontrado";
        id('bairro').placeholder = "CEP Não Encontrado";
        id('cidade').placeholder = "CEP Não Encontrado";
    }
}

function pesquisacep(valor){
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if(cep != ""){
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)){
            //Preenche os campos com 'Aguarde um instante' enquanto consulta webservice.
            id('rua').value="Aguarde um instante";
            id('bairro').value="Aguarde um instante";
            id('cidade').value="Aguarde um instante";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);
        }
        else{
            //cep é inválido.
            limpa_formulário_cep();
        }
    }else{
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};

function id(sId){
    return document.getElementById(sId);
}