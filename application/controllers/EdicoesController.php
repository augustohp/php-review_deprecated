<?php

class EdicoesController extends Zend_Controller_Action
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
       $publicacao = new Application_Model_PublicacaoMapper();
       $revistas = $publicacao->fetchAll();
        
        $this->view->revistas = $revistas;
         
    }

    public function downloadAction()
    {
        $this->_helper->layout->disableLayout();
        // action body
        $id = $this->getRequest()->getParam('id');

        $edicao = new Application_Model_Publicacao();
        $edicao->setId($id);
  
       header("Content-Disposition: inline; filename=".$edicao->getEdicao().".pdf"); 
       header("Content-type: application/x-pdf"); 
       readfile($edicao->getArquivo());

    }

    public function detalheAction()
    {
        // busca os detalhes da revista.
        $id = $this->getRequest()->getParam('id');

        $edicao = new Application_Model_Publicacao();
        $edicao->setId($id);
  
        $this->view->revista = $edicao;
    }


}





