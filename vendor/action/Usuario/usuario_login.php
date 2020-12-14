<?php

/** Importação de classes */
use \vendor\model\Usuario;
use \vendor\controller\Usuario\UsuarioValidate;

/** Instânciamento de classes */
$usuario = new Usuario();
$usuarioValidate = new UsuarioValidate();

try
{

    /** Parâmetros de entrada */
    $usuarioValidate->setEmail(@$_POST['email']);
    $usuarioValidate->setPassword(@$_POST['password']);

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (count($usuarioValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $usuarioValidate->getErrors(),

        ];

    }
    else
    {

        /** Realizo a autenticação */
        $resultUsuario = $usuario->access($usuarioValidate->getEmail(), $usuarioValidate->getPassword());

        if (@(int)$resultUsuario->USUARIO_ID){

            /** Montagem da sessão */
            $_SESSION['USUARIO_ID'] = $resultUsuario->USUARIO_ID;
            $_SESSION['USUARIO_NOME'] = $resultUsuario->NAME;
            $_SESSION['USUARIO_EMAIL'] = $resultUsuario->EMAIL;

            /** Adição de elementos na array */
            array_push($message, 'Usuario localizado');

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'usuario/chat/'

            ];

        }
        else
        {

            /** Adição de elementos na array */
            array_push($message, 'Não foi possivel localizar o cliente.');

            /** Result **/
            $result = [

                'cod' => 1,
                'title' => 'Falha',
                'message' => $message,

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
