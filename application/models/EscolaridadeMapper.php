<?php

class Application_Model_EscolaridadeMapper
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
           $this->setDbTable('Application_Model_DbTable_Escolaridade');
       }

       return $this->_dbTable;
   }

   public function save(Application_Model_Escolaridade $esc){
       $arr = array(
           "ds_escolaridade" => $esc->getEscolaridade(),
           "in_disponivel"   => $esc->getDisponivel()
       );
       
       if (null === ($id = $esc->getId())){
           $this->getDbTable()->insert($arr);
       }else{
           $this->getDbTable()->update($arr,array("id_escolaridade = ?",$id));
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

       if($resultado->count() == 0){
           return;
       }

       $itens = array();
       foreach($resultado as $res){
           $escolaridade = new Application_Model_Escolaridade();
           $escolaridade->setId($res->id_escolaridade);
           $itens[] = $escolaridade;
       }
       return $itens;
   }

}

