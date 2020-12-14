let content = document.getElementById('messageList');
let conn;
let conn_status = false;

window.onload = connect();

function connect() {

    /** Verifico o status da conexão */
    if (conn_status) {

        conn.close();
        conn_status = false;
        content.innerHTML = '';

    }

    let room = $('#cliente_id').val();

    /** Inicio uma nova conexão 'pusher' */
    conn = new ab.Session('ws://localhost:8082',

        function() {

            /** Altero o status da conexão */
            conn_status = true;

            conn.subscribe(room, function(topic, data) {

                if (typeof data === 'string') {

                    data = JSON.parse(data);

                    for (let i = 0; i < data.length; i++) {

                        showMessages(data[i]);

                    }

                } else {

                    showMessages(data);

                }

            });

        },
        function() {

            /** Console */
            console.warn('WebSocket: Conexão encerrada');

        },
        {

            'skipSubprotocolCheck': true

        }

    );

}

/** Função para enviar mensagem */
function sendMessage() {

    /** Dados para envio */
    let room = $('#cliente_id').val();
    let data = {

        client_id : $('#cliente_id').val(),
        name : $('#name').val(),
        message : $('#message').val(),

    };

    /** Verifico se os dados foram preenchidos */
    if (data.name && data.message){

        /** Envio dos dados */
        conn.publish(room, data);

    }

}