<?php

class NoticiaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->noticiaMapper = new Application_Model_NoticiasMapper();
        $this->view->noticias = $this->noticiaMapper->getUltimasNoticias();

        $usuario = new Application_Model_UsuarioMapper();
        $this->view->totalUsuarios = $usuario->getQuantidade();
    }

    public function indexAction()
    {
        // action body
        $this->_redirect('/');
    }

    public function readAction()
    {
        // action body
        // Buscando o parâmetro passado pelo usuário.
        $id = $this->getRequest()->getParam('id');

        // Instanciando a revista
        $noticiaMapper = new Application_Model_NoticiasMapper();
        $noticia = new Application_Model_Noticias();
        $noticia->setId($id);
        $this->view->noticia = $noticia;



    }


}



