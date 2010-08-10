<?php

class Application_Form_Contato extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setMethod('post');

        $this->addElement('text','nome',array(
            'label' => 'Nome:',
            'required'=> true,
            'filters' => array('StringTrim')
        ));

        $this->addElement('text','telefone',array(
            'label' => 'Telefone'
        ));
    }


}

