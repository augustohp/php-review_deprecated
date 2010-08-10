<?php

class Application_Model_DbTable_Noticias extends Zend_Db_Table_Abstract
{

    protected $_name = 'materias';
    protected $_primary = array('id_materia');
    protected $_sequence = true;
    protected $_dependentTable = array('Application_Model_DbTable_Usuario');

}

