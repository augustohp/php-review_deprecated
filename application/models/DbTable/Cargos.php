<?php

class Application_Model_DbTable_Cargos extends Zend_Db_Table_Abstract
{

    protected $_name = 'cargos';
    protected $_primary = 'id_nivel_cargo';
    protected $_sequence = true;
    protected $_dependentTables = array('Usuarios');

}

