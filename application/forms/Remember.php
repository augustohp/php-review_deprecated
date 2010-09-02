<?php

class Application_Form_Remember extends Zend_Form
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

        $this->addElement('text','email',array(
            'label'=> 'Informe o seu e-mail',
            'filters'    => array('StringTrim')
        ));

        $email = $this->getElement('email');

        $email->setDecorators(array('ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('label'=>'Label'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Enviar',
            ));
        $submit = $this->getElement('submit');
        $submit->setDecorators(array('ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('label'=>'HtmlTag'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));
    }


}

