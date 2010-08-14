<?php

class Application_Form_Auth extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');

        $this->addElement(
            'text', 'login', array(
            'label' => 'E-mail:',
            'required' => true,
            'filters'    => array('StringTrim'),
            ));

        $this->addElement('password', 'password', array(
            'label' => 'Senha:',
            'required' => true,
            ));

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
            ));
    }

}

