<?php
/**
 * Created by PhpStorm.
 * User: KEVEN
 * Date: 03/09/2020
 * Time: 17:43
 */

/** Importação das classes */
use \vendor\Model\Main;

/** Instânciamento das classes */
$main = new Main();

try
{

    /** Controle de mensagens */
    $message = array();

    /** Verifico se o usuário esta logado */
    if ($main->checkSession())
    {

        $main->destroySession();

        /** Adição de elementos na array */
        array_push($message, 'Sessão encerrada');

        /** Result **/
        $result = [

            'cod' => 'AUTH_EXIT',
            'title' => 'Atenção',
            'message' => $message,
            'redirect' => '/'

        ];

    }
    else
    {

        /** Adição de elementos na array */
        array_push($message, 'Usuário não autenticado');

        /** Result **/
        $result = [

            'cod' => 'AUTH_404',
            'title' => 'Atenção',
            'message' => $message,

        ];

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