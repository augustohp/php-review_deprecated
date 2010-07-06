<?php

class Application_Model_DbTable_Cargos extends Zend_Db_Table_Abstract
{

    protected $_name = 'cargos';
    protected $_primary = 'id_nivel_cargo';
    protected $_sequence = true;
    protected $_referenceMap = array(
        'Usuario' => array(
            'Columns' => array('id_enquete'),
            'refTableClass'=> 'Application_Model_DbTable_Usuario',
            'refColumns' => array('id_enquete')
        )
    );

}

