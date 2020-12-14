<?php

/** Importação de classes */
use \vendor\model\Cliente;
use \vendor\controller\Cliente\ClienteValidate;

/** Instânciamento de classes */
$cliente = new Cliente();
$clienteValidate = new ClienteValidate();

try
{

    /** Parâmetros de entrada */
    $clienteValidate->setClienteId(@$_POST['cliente_id']);
    $clienteValidate->setName(@$_POST['name']);
    $clienteValidate->setEmail(@$_POST['email']);
    $clienteValidate->setPassword(@$_POST['password']);

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (count($clienteValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $clienteValidate->getErrors(),

        ];

    }
    else
    {

        /** Salvo a data do último acesso */
        if ($cliente->save($clienteValidate->getClienteId(), $clienteValidate->getName(), $clienteValidate->getEmail(), $clienteValidate->getPassword()))
        {

            /** Realizo a autenticação */
            $resultCliente = $cliente->access($clienteValidate->getEmail(), $clienteValidate->getPassword());

            if (@(int)$resultCliente->CLIENTE_ID){

                /** Montagem da sessão */
                $_SESSION['CLIENTE_ID'] = $resultCliente->CLIENTE_ID;
                $_SESSION['CLIENTE_NOME'] = $resultCliente->NAME;
                $_SESSION['CLIENTE_EMAIL'] = $resultCliente->EMAIL;

                /** Adição de elementos na array */
                array_push($message, 'Usuario localizado');

                /** Result **/
                $result = [

                    'cod' => 0,
                    'title' => 'Sucesso',
                    'message' => $message,
                    'redirect' => 'cliente/chat/'

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
        else
        {

            /** Adição de elementos na array */
            array_push($message, 'Não foi possivel salvar o cliente. Por favor tente novamente.');

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
