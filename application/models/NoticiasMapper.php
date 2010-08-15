<?php

class Application_Model_NoticiasMapper
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
           $this->setDbTable('Application_Model_DbTable_Noticias');
       }

       return $this->_dbTable;
   }

   public function save(Application_Model_Noticias $noticia){
       $arr = array(
           'id_publicacao' => $noticia->revista->getId(),
           'ds_titulo' => $noticia->getTitulo(),
           'tx_materia' => $noticia->getMateria(),
           'dt_publicacao'=> $noticia->getPublicacao(),
           'dt_alteracao' => date('Y-m-d H:i:s'),
           'dt_limite' => $noticia->getDataLimite(),
           'in_home' => $noticia->getHome(),
           'id_usuario' => $noticia->usuario->getid(),
           'url_imagem' => $noticia->getImagem()
       );

       if(null === ($id = $noticia->getId())){
           $this->getDbTable()->insert($arr);
       }else{
           $this->getDbTable()->update($arr,array('id_noticia = ?' => $id));
       }

   }

   public function find($id){
       $resultado = $this->getDbTable()->find($id);
       if ($resultado->count() == 0){
           return;
       }
       $noticia = $resultado->current();

       return $noticia;


   }

   public function fetchAll(array $where = null){
       $resultado = $this->getDbTable()->fetchAll($where);
       if ($resultado->count() == 0){
           return;
       }

       $noticias = array();
       foreach($resultado as $item){
           $noticia = new Application_Model_Noticias();
           $noticia->setId($item->id_materia);
           $noticias[] = $noticia;
       }

       return $noticias;
   }

    public function getUltimasNoticias($limite = 3){

        // instanciando a conexão com o banco de dados
        $tabela = $this->getDbTable();

        // Fazendo a consulta dos dados
        $select = $tabela->select();
        $select->limit($limite,0)->where("(dt_limite > ? or dt_limite = '0000-00-00')",date('Y-m-d h:i:s'))->order('dt_publicacao DESC');
        $linhas = $tabela->fetchAll($select);

        $noticias = array();
        foreach($linhas as $linha){
            $item = new Application_Model_Noticias();
            $item->setId($linha->id_materia);
            $noticias[] = $item;
        }
        return $noticias;
   }

}

