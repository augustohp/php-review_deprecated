<?php

class UsuarioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body

    }

    public function novoAction()
    {
        $request = $this->getRequest();
        $form = new Application_Form_Usuario();
        
        if ($this->getRequest()->isPost()){
            if ($form->isValid($request->getPost())){
                $usuario = new Application_Model_Usuario($form->getValues());
                $usuarioM = new Application_Model_UsuarioMapper();
                $usuarioM->save($usuario);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }


}



