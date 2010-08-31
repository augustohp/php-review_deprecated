<?php

class HotsiteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->_redirect('/');
    }

    public function achouAction()
    {
        // action body
        $this->_helper->layout->setLayout('hotsite');
    }


}



