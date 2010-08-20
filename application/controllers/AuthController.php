<?php

class AuthController extends Zend_Controller_Action
{

    protected $_application;

    public function init()
    {
        /* Initialize action controller here */
        //$this->_helper->acl->allow(null);
        $this->_application = new Zend_Session_Namespace('PHPReview');
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
        
                        $auth = Zend_Auth::getInstance();
        
                        $autenticado = $adapter->authenticate();
        
                        if ($autenticado->isValid()){
                            $usuario = $adapter->getResultRowObject();
                            $this->_application->currentRole = 'usuario';
                            $this->_application->id = $usuario->id_usuario;
                            $this->_application->nome = $usuario->nm_usuario;
                            $auth->getStorage()->write($this->_application);
                            $this->_helper->FlashMessenger('Login realizado com sucesso!');

                            $this->_redirect('/');
                           // return;
                        }else{
                            $this->view->erroMessage = "Usuário ou Senha inválido. Tente novamente.";
                        }
                    }
                }
        
                $this->view->loginForm = $formLogin;
    }

    public function logoutAction()
    {
        // action body
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_application->currentRole = 'visitante';
        $this->_redirect('/');

    }


}



