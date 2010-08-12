<?php

class IndexController extends Zend_Controller_Action
{

    protected $noticiaMapper;

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
        $where = array('in_home = ?'=>'1',"(dt_limite > ? or dt_limite = '0000-00-00') "=>date('Y-m-d H:i:s'));
        $this->view->capaNoticias = $this->noticiaMapper->fetchAll($where);
    }

    public function sobreRevistaAction()
    {
        // action body
//        $noticiaMapper = new Application_Model_NoticiasMapper();
//        $this->view->noticias = $noticiaMapper->getUltimasNoticias();
    }

    public function apoioAction()
    {
        // action body
//        $noticiaMapper = new Application_Model_NoticiasMapper();
//        $this->view->noticias = $noticiaMapper->getUltimasNoticias();
    }

    public function nossaEquipeAction()
    {
        // action body
 //       $noticiaMapper = new Application_Model_NoticiasMapper();
 //       $this->view->noticias = $noticiaMapper->getUltimasNoticias();
    }


}







