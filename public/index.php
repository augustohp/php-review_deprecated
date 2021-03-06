<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// --> Instanciando a classe de Sessão.
require_once 'Zend/Session/Namespace.php';
$myApp = new Zend_Session_Namespace('PHPReview');

// --> Caso não possua uma regra cadastrada, o mesmo é cadastrado como visitante.
if (!isset($myApp->currentRole)){
    $myApp->currentRole = 'visitante';
}

// --> Aplicando o controle de acesso
require_once "Revista/Acl.php";
$acl = new Revista_Acl();
$acl->gravaPapeis()->gravaRecursos()->Permissoes();

// --> Aplicando as regras para a validação do acesso.
require_once 'Zend/Controller/Front.php';
require_once 'Revista/Plugin/Acl.php';

$aclPlugin = new Revista_Plugin_Acl($acl,$myApp->currentRole);
$aclPlugin->setErrorPage('login', 'auth', 'default');

// --> Instalando o plugin de acesso.
$front = Zend_Controller_Front::getInstance();
$front->registerPlugin($aclPlugin);

// Iniciando o programa.
$application->bootstrap()
            ->run();
