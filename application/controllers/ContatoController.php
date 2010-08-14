<?php

class ContatoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $usuario = new Application_Model_UsuarioMapper();
        $this->view->totalUsuarios = $usuario->getQuantidade();
    }

    public function indexAction()
    {
        // action body
    }

    public function submitAction()
    {
        // action body
    }


}



