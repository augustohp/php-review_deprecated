<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    protected $_primary = 'id_usuario';
    protected $_sequence = true;
    protected $_dependentTables = array('Cargos');

}

