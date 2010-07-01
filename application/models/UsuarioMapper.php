<?php
/**
 * Esta classe faz todo o mapeamento da tabela Usuario dentro do banco de dados e executa as operações mais básicas
 * para a sua solicitação.
 * @author André Pinheiro.
 * @version 1.0
 */
class Application_Model_UsuarioMapper
{
    /**
     * Variável que define qual o DbTable será utilizado.
     *
     * @var Application_Model_DbTable_Usuario
     */
   protected $_dbTable;

   /**
    * Define o DbTable que será utilizado nas conexões de banco de dados.
    *
    * @param  $dbTable
    * @return $this
    */
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
           $this->setDbTable('Application_Model_DbTable_Usuario');
       }

       return $this->_dbTable;
   }
   

}

