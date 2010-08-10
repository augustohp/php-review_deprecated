<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    protected $_primary = 'id_usuario';
    protected $_sequence = true;
    protected $_dependentTables = array('Application_Model_DbTable_Escolaridade',
                                         'Application_Model_DbTable_Cargos',
                                         'Application_Model_DbTable_FaixaSalarial');
    protected $_referenceMap = array(
        'Notícias' => array(
            'Columns' => array('id_usuario'),
            'refTableClass'=> 'Application_Model_DbTable_Usuario',
            'refColumns' => array('id_usuario')
        )
    );

}

