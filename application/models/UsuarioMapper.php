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

   /**
    * Busca o DbTable necessário para a aplicação.
    *
    * @return Application_Model_DbTable_Usuario
    */
   public function getDbTable(){
       // caso não exista uma instância da classe a mesma é criada.
       if (null === $this->_dbTable){
           $this->setDbTable('Application_Model_DbTable_Usuario');
       }

       return $this->_dbTable;
   }

   public function save(Application_Model_Usuario $usuario){
       $data = array(
           'nm_usuario'=> $usuario->getNome(),
           'ds_email'  => $usuario->getEmail(),
           'sexo'      => $usuario->getSexo(),
           'ds_endereco' => $usuario->getEndereco(),
           'ds_complemento'=> $usuario->getComplEndereco(),
           'ds_numero' => $usuario->getNumero(),
           'nr_cep'    => $usuario->getCep(),
           'ds_bairro' => $usuario->getBairro(),
           'ds_cidade' => $usuario->getCidade(),
           'id_estado' => $usuario->getEstado(),
           'ds_senha'  => $usuario->getSenha(),
           'id_escolaridade' => $usuario->escolaridade->getId(),
           'id_faixa_salarial' => $usuario->faixaSalarial->getId(),
           'id_nivel_cargo' => $usuario->cargo->getId(),
           'ds_como_conheceu' => $usuario->getComoConheceu(),
           'dt_criacao' => date('Y-m-d H:i:s')
       );

       // Verificando se existe usuario. Caso exista atualiza, senao grava
       if (null === ($id = $usuario->getId())){
           $this->getDbTable()->insert($data);
       }else{
           $this->getDbTable()->update($data, array('id = ?',$id));
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
       $usuarios = array();
       foreach($resultado as $item){
           $usuario = new Application_Model_Usuario();

           $usuarios[] = $usuario;
       }

       return $usuarios;
   }
}

