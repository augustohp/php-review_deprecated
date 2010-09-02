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
        $id = $this->getRequest()->getParam('id');

        // buscando usuário e inserindo os valores dentro dele.
        // TODO Por enquanto está gravando em arquivo mas depois gravará em banco de dados.
        $myApp = new Zend_Session_Namespace('PHPReview');
        error_log('insert into usuario_publicacao values (0,'.$myApp->id.','.$id.',0)',3,'/home/phprevie/temporario/downloads.log');

        $this->_helper->layout->disableLayout();
        // action body
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





