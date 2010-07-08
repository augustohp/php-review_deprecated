<?php

class Application_Model_Escolaridade
{

    protected $_id;
    protected $_escolaridade;
    protected $_disponivel;

    public function __contruct(array $opcoes = null){
        if (is_array($opcoes)){
            $this->setOptions($opcoes);
        }
    }

    public function  __set($name,  $value) {
        $metodo = 'set'.ucfirst($name);

        // Verificando se o campo solicitado existe.
        if (('mapper' == $name) || !method_exists($this,$metodo)){
            throw  new Exception("O método solicitado para o campo $name não existe.");
        }

        // Passando o valor para o método correspondente.
        $this->$metodo($value);
    }

    public function __get($name){
        $metodo = 'get'.ucfirst($name);

        // Verificando se o campo solicitado existe.
        if (('mapper' == $name) || !method_exists($this,$metodo)){
            throw  new Exception("O método solicitado para o campo $name não existe.");
        }

        // Passando o valor para o método correspondente.
        return $this->$metodo();
    }

    public function setOptions(array $opcoes){
        // buscando todos os métodos da classe
        $metodos = get_class_methods($this);

        foreach($opcoes as $item => $opcao){
             $metodo = 'set'.ucfirst($item);
             if (in_array($metodo,$metodos)){
                 $this->$metodo($opcao);
             }
        }
        return $this;
    }

    public function setId($id){
        $this->_id = (int)$id;

        $mapper = new Application_Model_EscolaridadeMapper();
        $esc = $mapper->find($id);

        $this->_escolaridade = $esc->ds_escolaridade;
        $this->_disponivel = (bool)$esc->in_disponivel;

        return $this;
    }

    public function getId(){
        return $this->_id;
    }

    public function setEscolaridade($escol){
        $this->_escolaridade = (string)$escol;
        return $this;
    }

    public function getEscolaridade(){
        return $this->_escolaridade;
    }

    public function setDisponivel($disp){
        if (is_bool($disp) || in_array($disp,array(0,1))){
            $this->_disponivel = $disp;
        }else{
            throw new Exception("O campo disponível só aceita valores booleanos: true ou false");
        }
        return $this;
    }

    public function getDisponivel(){
        return (bool)$this->_disponivel;
    }

    public function getEscolaridades(){

        $mapper = new Application_Model_EscolaridadeMapper();
        $opcoes = $mapper->fetchAll(array('in_disponivel = 1'));
        $itens = array();
        foreach($opcoes as $item){
            $itens[$item->getId()] = $item->getEscolaridade();
        }
        return $itens;
    }
}

