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
            'validators' => array(array('stringLength','options'=> array(0,100)))
        ));

        // Adicionando o E-mail que será a chave para se logar no site
        $this->addElement("text","email",array(
            'label' => 'E-mail:',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('EmailAddress'),
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
            'filters' => array('StringTrim')
        ));

        // Adicionando o campo de CEP
        $this->addElement("text","cep",array(
            'label'  => "CEP:",
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('alnum')
            )
        );

        // Adicionando o campo senha e confirmação de senha
        $this->addElement("password","senha",array(
            'label' => 'Senha:',
            'required' => true,
            'validators' => array(
                array('StringLength','options' => array(6)))
        ));

        $this->addElement("password","conf_senha",array(
            'label' => 'Confirmar a Senha:',
            'required' => true,
            'validators' => array(array('StringLength','options' => array(6)))
        ));


        // Adicionando captcha

        $this->addElement('captcha','captcha',array(
            'label' => 'Transcreva o texto abaixo.',
            'required' => true,
            'captcha' => array(
                'captcha'=> 'Image',
                'expiration' => 600,
                'font' => "/usr/share/fonts/truetype/thai/Garuda.ttf",
                'fontSize' => '30pt',
                'height' => 100,
                'width'  => 300,
                'imageDir' => '/var/www/revista/public/images/captcha/'
            )
        ));

        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

        $this->addElement('submit','submit',array(
            'ignore' => true,
            'label'  => 'Enviar'
        ));

    }


}

