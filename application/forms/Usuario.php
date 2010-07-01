<?php

class Application_Form_Usuario extends Zend_Form
{

    public function init()
    {
        // Criando o formulário de cadastro de novo usuário.
        $this->setMethod('post');

        // Nome do usuário
        $this->addElement("text","nome",array(
            'label' => "Nome:",
            'required'=> true,
            'filters' => array('StringTrim'),
            'validators' => array('validator'=>'StringLength','options'=> array(0,100) )
        ));

        // Adicionando o E-mail que será a chave para se logar no site
        $this->addElement("text","email",array(
            'label' => 'E-mail:',
            'required' => true,
            'filters' => 'StringTrim',
            'validators' => array('EmailAddress')
        ));

        // adicionando Endereço
        $this->addElement("text","endereco",array(
            'label' => "Endereço:",
            'required' => false,
            'filters' => array('StringTrim','StringToLower')
        ));

        // adicionando Complemento
        $this->addElement("text","compl",array(
            'label'  => "Complemento:",
            'required' => false,
            'filters' => 'StringTrim'
        ));

        // Adicionando o campo de CEP
        $this->addElement("text","cep",array(
            'label'  => "CEP:",
            'required' => true,
            'filters' => 'StringTrim',
            'validators' => array(
                'alnum', array('regexp',false,'[0-9]{5}-[0-9]{3}')
            )
        ));

        // Adicionando o campo senha e confirmação de senha
        $this->addElement("password","senha",array(
            'label' => 'Senha:',
            'required' => true,
            'validators' => array('StringLength','options' => array(6))
        ));

        $this->addElement("password","conf_senha",array(
            'label' => 'Senha:',
            'required' => true,
            'validators' => array('StringLength','options' => array(6))
        ));

        

    }


}

