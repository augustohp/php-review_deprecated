<?php

class Application_Model_CargosMapper
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
           $this->setDbTable('Application_Model_DbTable_Cargos');
       }

       return $this->_dbTable;
   }

   public function save(Application_Model_Cargos $cargo){
       $arr = array(
           'ds_cargo' => $cargo->getCargo(),
           'in_disponivel' => $cargo->getDisponivel()
       );

       if(null === ($id = $cargo->getId())){
           $this->getDbTable()->insert($arr);
       }else{
           $this->getDbTable()->update($arr,array('id_nivel_cargo',$id));
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

       $cargos = array();
       foreach($resultado as $item){
           $cargo = new Application_Model_Cargos();
           $cargo->setId($item->id_nivel_cargo);
           $cargos[] = $cargo;
       }

       return $cargos;
   }


}

