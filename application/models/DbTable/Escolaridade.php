<?php

class Application_Model_DbTable_Escolaridade extends Zend_Db_Table_Abstract
{

    protected $_name = 'escolaridade';
    protected $_primary = 'id_escolaridade';
    protected $_sequence = true;
    protected $_dependentTables = array('Usuarios');
}

