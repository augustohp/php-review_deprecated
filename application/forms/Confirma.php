<?php

class Application_Form_Confirma extends Zend_Form
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
        $this->addElement('password', 'senha', array(
            'label' => 'Nova Senha:',
            'required' => true,
            ));
        $senha = $this->getElement('senha');
        $senha->setDecorators(array('ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('label'=>'Label'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));

        $this->addElement('password', 'conf_senha', array(
            'label' => 'Confirmar Senha:',
            'required' => true,
            ));
        $conf = $this->getElement('conf_senha');
        $conf->setDecorators(array('ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('label'=>'Label'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));
    
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Atualizar',
            ));
        $submit = $this->getElement('submit');
        $submit->setDecorators(array('ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('label'=>'HtmlTag'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))));
    }


}

