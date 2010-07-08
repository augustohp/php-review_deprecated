<?php

class Application_Model_DbTable_Escolaridade extends Zend_Db_Table_Abstract
{

    protected $_name = 'escolaridades';
    protected $_primary = 'id_escolaridade';
    protected $_sequence = true;
    protected $_dependentTables = array('Usuarios');
}

