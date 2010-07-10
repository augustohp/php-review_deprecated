<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    protected $_primary = 'id_usuario';
    protected $_sequence = true;
    protected $__dependentTables = array('Application_Model_DbTable_Escolaridade',
                                         'Application_Model_DbTable_Cargos',
                                         'Application_Model_DbTable_FaixaSalarial');


}

