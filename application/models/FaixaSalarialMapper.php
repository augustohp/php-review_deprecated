<?php

class Application_Model_FaixaSalarialMapper
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
           $this->setDbTable('Application_Model_DbTable_FaixaSalarial');
       }
       return $this->_dbTable;
   }

   public function save(Application_Model_FaixaSalarial $faixao){
       $arr = array(
           'vl_minimo' => $faixa->getMinimo(),
           'vl_maximo' => $faixa->getMaximo(),
           'in_disponivel' => $faixa->getDisponivel()
       );

       if(null === ($id = $faixa->getId())){
           $this->getDbTable()->insert($arr);
       }else{
           $this->getDbTable()->update($arr,array('id_faixa_salarial = ?',$id));
       }

   }

   public function find($id){
       $resultado = $this->getDbTable()->find($id);
       if ($resultado->count() == 0){
           return;
       }
       return $resultado->current();
   }

   public function fetchAll(array $where = null){
       $resultado = $this->getDbTable()->fetchAll($where);
       if ($resultado->count() == 0){
           return;
       }

       $faixas = array();
       foreach($resultado as $item){
           $faixa = new Application_Model_FaixaSalarial();
           $faixa->setId($item->id_faixa_salarial);
           $faixas[] = $faixa;
       }

       return $faixas;
   }
}

