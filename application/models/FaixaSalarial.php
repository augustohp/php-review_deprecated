<?php

class Application_Model_FaixaSalarial
{

    protected $_id;
    protected $_minimo;
    protected $_maximo;
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

        $mapper = new Application_Model_FaixaSalarialMapper();
        $faixa = $mapper->find($id);

        $arr = array(
            'minimo' => $faixa->vl_minimo,
            'maximo' => $faixa->vl_maximo,
            'disponivel' => $faixa->in_disponivel
        );

        $this->setOptions($arr);

        return $this;
    }

    public function getId(){
        return $this->_id;
    }

    public function setMaximo($valor){
        if(is_real((float)$valor)){
            $this->_maximo = (float)$valor;
        }else{
            throw new Exception("Favor informar um valor numérico para o campo Máximo.");
        }
        return $this;
    }

    public function getMaximo(){
       return $this->_maximo;
    }

    public function setMinimo($valor){
        $real = (empty($valor)?0:$valor);
        if (is_float((float)$real)){
            $this->_minimo = (float)$real;
        }else{
            throw new Exception('Favor informar um valor numérico para o campo Mínimo.'.$real);
        }
        return $this;
    }

    public function getMinimo(){
        return $this->_minimo;
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
        return $this->_disponivel;
    }

    public function getFaixaValor(){
        if ($this->_maximo == 0.00){ // Neste caso só existe o valor máximo
            return "Maior que R$ ".number_format($this->_minimo,2,',','.');
        }elseif($this->_minimo == 0.00){
            return "Até R$ ".number_format($this->_maximo,2,',','.');
        }else{
            return "De R$ ".number_format($this->_minimo,2,',','.')." até R$ ".number_format($this->_maximo,2,',','.');
        }
    }

    public function getFaixas(){
        $mapper = new Application_Model_FaixaSalarialMapper();
        $opcoes = $mapper->fetchAll(array('in_disponivel = 1'));
        $itens = array();
        foreach($opcoes as $item){
            $itens[$item->getId()] = $item->getFaixaValor();
        }
        return $itens;
    }



}

