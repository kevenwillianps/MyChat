/** Escolho a porta do WebSocket */
let wsConnection = new WebSocket('ws://localhost:8080');

/** Função ao iniciar a conexão */
wsConnection.onopen = function(e) {

    /** Console */
    console.log('Conexão estabelecida com sucesso');

    /** Envio das informações */
    sendInfo();

};

/** Função ao iniciar a conexão */
wsConnection.onclose = function(e) {

    /** Console */
    console.log('Conexão encerrada com sucesso');

    sendRemove();

};

/** Função ao receber mensagem */
wsConnection.onmessage = function(e) {

    /** Parâmetros de entrada */
    let data = JSON.parse(e.data);

    /** Verifico a operação para executar */
    if (data.function === 'showClients')
    {

        /** Adiciono um cliente */
        showClients(JSON.stringify(data));

    }
    else if (data.function === 'removeClients')
    {

        alert('#client_' + data.room);
        removeClients('#client_' + data.room);

    }

};

function desconect() {

    wsConnection.close();

}

/** Envio informações para o servidor */
function sendInfo() {

    /** Dados de envio */
    let data = {

        /** Informo a função */
        function : 'showClients',

        /** Gero o ID de uma sala */
        room : $('#cliente_id').val(),

        /** Nome da sala */
        name : $('#cliente_nome').val(),

    };

    /** Envio a mensagem */
    wsConnection.send(JSON.stringify(data));

}

/** Envio informações para o servidor */
function sendRemove() {

    /** Dados de envio */
    let data = {

        /** Informo a função */
        function : 'removeClients',

        /** Gero o ID de uma sala */
        room : $('#cliente_id').val(),

        /** Nome da sala */
        name : $('#cliente_nome').val(),

    };

    /** Envio a mensagem */
    wsConnection.send(JSON.stringify(data));

}

/** Coloco os dados na tela */
function showMessages(data) {

    /** Montagem da estrutura HTML */
    let html  = '<div class="media animate slideIn">';
        html += '   <div class="media-body">';
        html += '       <h6 class="mt-0 mb-0"><strong>'+ data.name +'</strong></h6>';
        html +=         data.message;
        html += '   </div>';
        html += '</div>';

    /** Adiciono o elemento */
    $('#messageList').append(html);

}

/** Coloco os dados na tela */
function showClients(data) {

   /** Parâmetros de entrada */
   let _data = JSON.parse(data);

   /** Não adiciono a minha propria salass */
   if (_data.room !== $('#cliente_id').val()){

       /** Montagem da estrutura HTML */
       let html  = '<option value="'+ _data.room +'" id="client_'+ _data.room +'">';
           html +=     _data.name;
           html += '</option>';

       /** Adiciono o elemento */
       $('#room').append(html);

   }

}

function removeClients(data) {

    $(data).hide();
    
}