<?php

/** Importação autoload */
include_once 'autoload.php';

/** Importação de classes */
use \vendor\model\Main;
use \vendor\model\Cliente;
use \vendor\model\Usuario;
use \vendor\model\Message;

/** Instânciamento de classes */
$main = new Main();
$cliente = new Cliente();
$usuario = new Usuario();
$message = new Message();

$urlAplicacao = 'http://localhost/MyChat/'

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <base href="<?php echo $urlAplicacao?>"/>
    <meta charset="UTF-8">
    <title>

        MyChat | Chat de atendimento ao cliente

    </title>

    <!-- Importação de arquivos de estilo -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/animate-dropdown.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- Importação de arquivos javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/autobahn.js"></script>
    <script src="js/main.js"></script>

</head>
<body>

    <?php

    $table = strtolower(isset($_REQUEST['table']) ? htmlspecialchars($_REQUEST['table']) : '');
    $action = strtolower(isset($_REQUEST['action']) ? htmlspecialchars($_REQUEST['action']) : '');

    /** Verifico se a tabela foi preenchida */
    if (!empty($table))
    {

        /** Verfico se a ação foi preenchida */
        if (!empty($action))
        {

            /** Verifico se o arquivo de ação existe */
            if (is_file('vendor/view/' . $table . '/' . $action . '.php'))
            {

                /** Inclusão de arquivo */
                include 'vendor/view/' . $table . '/' . $action . '.php';

            }
            else
            {

                /** Inclusão de arquivo */
                include('vendor/view/geral/404.php');

            }

        }
        else
        {

            /** Inclusão de arquivo */
            include('vendor/view/geral/404.php');

        }

    }
    else
    {

        /** Inclusão de arquivo */
        include('vendor/view/geral/404.php');

    }

    ?>

    <?php

        /** Verifico qual script executar */
        if (strcmp($table, 'cliente') === 0)
        {

            /** Script para cliente */
            echo '<script src="js/WebSocket.js"></script>';
            echo '<script src="js/ChatClient.js"></script>';

        }
        else
        {

            /** Script para servidor */
            echo '<script src="js/WebSocket.js"></script>';
            echo '<script src="js/ChatServer.js"></script>';

        }

    ?>

</body>
</html>