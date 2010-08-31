<?php

class Application_Model_Publicacao
{

  protected $_id;
  protected $_titulo;
  protected $_resumo;
  protected $_edicao;
  protected $_tipo;
  protected $_ano;
  protected $_periodo;
  protected $_arquivo;
  protected $_publicacao;

  
  public function __contruct(array $opcoes = null){
     	if (is_array($opcoes)){
            $this->setOpcoes($opcoes);
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

   public function getId(){
       return $this->_id;
   }

   public function setId($id){
        $this->_id = (int)$id;

        $mapper = new Application_Model_PublicacaoMapper();
        $edicao = $mapper->find($this->_id);

        $param = array(
            'titulo'=> $edicao->ds_titulo,
            'resumo'=> $edicao->tx_resumo,
            'edicao'=> $edicao->nr_edicao,
            'tipo'=> $edicao->id_tp_publicacao,
            'anoPublicacao'=> $edicao->ano_publicacao,
            'periodo' => $edicao->ds_periodo,
            'arquivo' => $edicao->ds_arquivo,
            'dataPublicacao' => $edicao->dt_publicacao
        );

        $this->setOptions($param);

        return $this;
   }

   public function getTitulo(){
      return $this->_titulo;
   }
   public function setTitulo($titulo){
      $this->_titulo = $titulo;
      return $this;
   }

   public function getResumo(){
      return $this->_resumo;
   }
   public function setResumo($resumo){
      $this->_resumo = $resumo;
      return $this;
   }

   public function getEdicao(){
      $tipo = $this->getTipo();

      return $tipo['valor'].str_pad($this->_edicao,3,'0',STR_PAD_LEFT);
   }

   public function setEdicao($edicao){
      $this->_edicao = (int)$edicao;
      return $this;
   }

   public function setTipo($tipo){
      // TODO - lista dos tipos de publicações. Depois passar para banco de dados.
      $tipos = array('1'=>array('nome'=>'Revista Bimestral','valor'=>'ED'));
 
      $this->_tipo = $tipos[$tipo];
      return $this;
   }
   public function getTipo(){
       return $this->_tipo;
   }

   public function setAnoPublicacao($ano){
      $this->_ano = $ano;
      return $this;
   }
   public function getAnoPublicacao(){
      return $this->_ano;
   }

   public function setPeriodo($periodo){
      $this->_periodo = $periodo;
      return $this;
   }
   public function getPeriodo(){
      return $this->_periodo;
   }

   public function setArquivo($arquivo){
      $this->_arquivo = APPLICATION_PATH.$arquivo;
      return $this;
   }
   public function getArquivo(){
     return $this->_arquivo;
   }
  
   public function getDataPublicacao($formato = 'd/m/Y'){
      return date($formato, $this->_publicacao);
   }
   public function setDataPublicacao($data){
        if (strtotime($data) !== null){
            $this->_publicacao = strtotime($data);
            return $this;
        }else{
            throw new Exception('A data informada está em um formato inválido');
        }
   }  

}

