<?php

class Application_Model_PublicacaoMapper
{

  protected $_dbTable;

  public function setDbTable($dbTable){
       // verificando se foi passado string e instanciando o mesmo
       if(is_string($dbTable)){
           $dbTable = new $dbTable();
       }

       // verificando se $dbTable é uma instância de Zend_Db_DbTable
       if (!$dbTable instanceof Zend_Db_Table_Abstract){
           throw new Exception("A Classe não é uma instância de Zend_Db_Table");
       }
       $this->_dbTable = $dbTable;
       return $this;
   }

   public function getDbTable(){
       // caso não exista uma instância da classe a mesma é criada.
       if (null === $this->_dbTable){
           $this->setDbTable('Application_Model_DbTable_Publicacoes');
       }

       return $this->_dbTable;
   }

    public function find($id){
       $resultado = $this->getDbTable()->find($id);
       if ($resultado->count() == 0){
           return;
       }
       $publicacao = $resultado->current();

       return $publicacao;
   }

   public function fetchAll($where = null){

       $resultado = $this->getDbTable()->fetchAll($where);
        if ($resultado->count() == 0){
           return;
       }

       $edicoes = array();
       foreach($resultado as $item){
           $edicao = new Application_Model_Publicacao();
           $edicao->setId($item->id_publicacao);
           $edicoes[] = $edicao;
       }

       
       return $edicoes;
      
   }

}

