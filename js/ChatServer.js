let content = document.getElementById('messageList');
let conn;
let conn_status = false;

function connect() {

    if (conn_status) {

        conn.close();
        conn_status = false;
        content.innerHTML = '';

    }

    let room = document.getElementById('room').value;
    $('#_cliente_id').val(room);

    conn = new ab.Session('ws://localhost:8082',

        function() {

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

            console.warn('WebSocket connection closed');

        },
        {

            'skipSubprotocolCheck': true

        }

    );

}

/** Envio uma requisição para o backend */
function sendMessage(form) {

    /** Dados para envio */
    let room = $('#room').val();
    let data = {

        name : $('#name').val(),
        message : $('#message').val(),

    };

    /** Verifico se os dados foram preenchidos */
    if (data.name && data.message){

        $.ajax({

            /** Parâmetros de entrada */
            url : urlAplicacao + 'router.php',
            type : 'post',
            dataType : 'json',
            data : $(form).serialize(),

            /** Caso tenha sucesso */
            success: function ()
            {

                /** Envio dos dados */
                conn.publish(room, data);

            },

            /** Caso tenha falha */
            error: function (xhr, ajaxOptions, thrownError) {

                /** Delay de resposta */
                window.setTimeout(() => {

                    /** Array de elementos */
                    let messages = Array();
                    messages.push(xhr.status + ' - ' + ajaxOptions + ' - ' + thrownError);

                    /** Abro um popup com os dados **/
                    openPopup('Atenção', messages);

                }, 1000);

            },

        });

    }

}
