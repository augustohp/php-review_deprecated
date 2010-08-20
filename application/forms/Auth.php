<?php

class Application_Form_Auth extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag',array('tag'=>'table')),
            'Form'
        ));
        $this->addElement(
            'text', 'login', array(
            'label' => 'E-mail:',
            'required' => true,
            'filters'    => array('StringTrim'),
            ));

        $login = $this->getElement('login');
       $login->setDecorators(array('ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('label'=>'Label'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr')))); 

        $this->addElement('password', 'password', array(
            'label' => 'Senha:',
            'required' => true,
            ));

        $senha = $this->getElement('password');
         $senha->setDecorators(array('ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('label'=>'Label'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));
        
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
            ));
        $submit = $this->getElement('submit');
        $submit->setDecorators(array('ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('label'=>'HtmlTag'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));
    }

}

