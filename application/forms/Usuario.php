<?php

class Application_Form_Usuario extends Zend_Form
{

    public function init()
    {
        // Criando o formulário de cadastro de novo usuário.
        $this->setMethod('post')->setAttrib('id','formUsuario');

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
        
        $this->addElement("radio","sexo",array(
            'label' => "Sexo:",
            'required' => true,
            "multiOptions" => array(
                "m" => "Masculino",
                "f" => "Feminino"
            )
        ));
        
        // adicionando Endereço
        $this->addElement("text","endereco",array(
            'label' => "Endereço:",
            'required' => true,
            'filters' => array('StringTrim','StringToLower')
        ));
        // Adicionando número
        $this->addElement("text","numero",array(
            'label'  => "Número:",
            'required' => true,
            'filters' => array('StringTrim')
        ));

        // adicionando Complemento
        $this->addElement("text","complEndereco",array(
            'label'  => "Complemento:",
            'required' => true,
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

        $this->addElement("text","bairro",array(
            'label'  => "Bairro:",
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $this->addElement("text","cidade",array(
            'label'  => "Cidade:",
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $estados = array('Acre','Alagoas','Amapá','Amazonas','Bahia','Ceará','Distrito Federal','Espírito Santo','Goias','Maranhão','Mato Grosso',
            'Mato Grosso do Sul','Minas Gerais','Pará','Paraíba','Paraná','Pernambuco','Piauí','Rio de Janeiro',
            'Rio Grande do Norte','Rio Grande do Sul','Rondônia','Roraima','Santa Catarina','São Paulo','Sergipe',
            'Tocantins','- Outro País');

        $estados[''] = ' - Selecione';
        asort($estados);

        $this->addElement("select","estado",array(
            'label'  => "Estado:",
            'required' => true,
            'multiOptions' => $estados
        ));

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

        // Adicionando Escolaridade
        // Buscando o modelo de escolaridade
        $esc = new Application_Model_Escolaridade();
        $itens = array(""=>"- Selecione");
        $itens += $esc->getEscolaridades();
        
        
        $this->addElement("select",'escolaridade',array(
            'label'=> "Escolaridade:",
            'required' => true,
            "multiOptions"=> $itens
        ));

        // Adicionando Faixa salarial.
        // Buscando o valor da faixa salarial direto do banco de dados
        $faixa = new Application_Model_FaixaSalarial();
        $itens = array(""=>"- Selecione");
        $itens += $faixa->getFaixas();
        $this->addElement("select",'faixaSalarial',array(
            'label'=> "Faixa Salarial:",
            'required' => true,
            "multiOptions"=> $itens
        ));

        // Adicionando Nível de cargo
        // criando a instancia dos cargos
        $cargo = new Application_Model_Cargos();
        $itens = array(""=>"- Selecione");
        $itens += $cargo->getCargos();
        
        $this->addElement("select",'cargo',array(
            'label'=> "Nível do Cargo:",
            'required' => true,
            "multiOptions"=> $itens
        ));
        
        // Adicionando Nível de cargo
        // TODO: Colocar a escolaridade para buscar do cadastro de Nível de cargo.
        $this->addElement("text",'comoConheceu',array(
            'label'=> "Como conheceu o nosso site:",
            'required' => true,
            'size' => 40,
            'filters' => array('StringTrim')
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

        $this->addElement('hidden','grupo',array(
            'value'=>'1'
        ));

        $this->addElement('submit','submit',array(
            'ignore' => true,
            'label'  => 'Enviar'
        ));
    }
}