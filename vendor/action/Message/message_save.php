<?php

/** Importação de classes */
use vendor\model\Message;
use vendor\controller\Message\MessageValidate;

/** Instânciamento de classes */
$message = new Message();
$messageValidate = new MessageValidate();

try
{

    /** Parâmetros de entrada */
    $messageValidate->setMessageId(@$_POST['message_id']);
    $messageValidate->setUsuarioId(@$_POST['usuario_id']);
    $messageValidate->setClienteId(@$_POST['cliente_id']);
    $messageValidate->setText(@$_POST['message']);

    /** Controle de mensagens */
    $_message = Array();

    /** Verifico a existência de erros */
    if (count($messageValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $messageValidate->getErrors(),

        ];

    }
    else
    {

        /** Salvo a data do último acesso */
        if ($message->save($messageValidate->getMessageId(), $messageValidate->getUsuarioId(), $messageValidate->getClienteId(), $messageValidate->getText()))
        {

            /** Adição de elementos na array */
            array_push($_message, 'Mensagem salva com sucesso');

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Sucesso',
                'message' => $_message,
                'redirect' => 'usuarios/'

            ];

        }
        else
        {

            /** Adição de elementos na array */
            array_push($_message, 'Não foi possivel salvar a mensagem. Por favor tente novamente');

            /** Result **/
            $result = [

                'cod' => 1,
                'title' => 'Falha',
                'message' => $_message,

            ];

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
catch (Exception $exception)
{

    /** Controle de mensagens */
    $message = array();

    /** Adição de elementos na array */
    array_push($message, '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile());
    array_push($message, '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage());

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 1,
        'message' => $message,
        'title' => 'Erro Interno',
        'type' => 'exception',

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
