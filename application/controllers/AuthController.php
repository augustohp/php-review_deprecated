<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->acl->allow(null);
    }

    public function loginAction()
    {
        // action body
        

        $formLogin = new Application_Form_Auth();

        if ($this->getRequest()->isPost()){
            if ($formLogin->isValid($this->getRequest()->getPost())){

                $usuario = new Application_Model_UsuarioMapper();
                $db = $usuario->getDbTable()->getAdapter();

                $adapter = new Zend_Auth_Adapter_DbTable($db,'usuario','ds_email','ds_senha',"concat('BASH!',md5(?))");

                $adapter->setIdentity($formLogin->getValue('login'));
                $adapter->setCredential($formLogin->getValue('password'));

                $autenticado = $adapter->authenticate();

                if ($autenticado->isValid()){
                    $this->_helper->FlashMessenger('Login realizado com sucesso!');
                    $this->_redirect('/');
                   // return;
                }
            }
        }

        $this->view->loginForm = $formLogin;

    }


}

