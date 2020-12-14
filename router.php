<?php

include_once 'autoload.php';

/** Parâmetros de entrada **/
$table = strtolower(isset($_REQUEST['TABLE']) ? htmlspecialchars($_REQUEST['TABLE']) : '');
$action = strtolower(isset($_REQUEST['ACTION']) ? htmlspecialchars($_REQUEST['ACTION']) : '');
$folder = strtolower(isset($_REQUEST['FOLDER']) ? htmlspecialchars($_REQUEST['FOLDER']) : '');

try
{

    /** Verifico se a tabela foi preenchida */
    if (!empty($table))
    {

        /** Verfico se a ação foi preenchida */
        if (!empty($action))
        {

            /** Verifico se o arquivo de ação existe */
            if (is_file('vendor/' . $folder . '/' . $table . '/' . $action . '.php'))
            {

                include_once 'vendor/' . $folder . '/' . $table . '/' . $action . '.php';

            }
            else
            {

                /** Mensagem de erro */
                throw new Exception('Erro :: Não há arquivo para ação informada.');

            }

        }
        else
        {

            /** Mensagem de erro */
            throw new Exception('Erro :: ação não informada.');

        }

    }
    else
    {

        /** Mensagem de erro */
        throw new Exception('Erro :: tabela não informada.');

    }

}
catch(Exception $exception)
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