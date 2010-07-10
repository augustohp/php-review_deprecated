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
                $resultado = $form->getValues();
                if ($resultado["senha"] == $resultado["conf_senha"]){
                    $usuario = new Application_Model_Usuario($resultado);
                    $usuarioM = new Application_Model_UsuarioMapper();
                    $usuarioM->save($usuario);

                    // Enviando e-mail de confirmação para o usuário
                    $mail = new Zend_Mail();

                    $mail->setFrom('no-reply@revistaphp.com',"Revista PHP")
                         ->addTo($usuario->getEmail(),$usuario->getNome())
                         ->setBodyText("Seu cadastro foi realizado com sucesso!!!")
                         ->setSubject("Confirmação de cadastro na Revista PHP")
                         ->send();
                    return $this->_helper->redirector('finish');
                }
            }
        }

        $this->view->form = $form;
    }

    public function finishAction()
    {
        
    }


}





