<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    protected $_primary = 'id_usuario';
    protected $_sequence = true;
    protected $_referenceMap = array(
        'Cargos' => array(
            'Columns' => array('id_nivel_cargo'),
            'refTableClass'=> 'Application_Model_DbTable_Cargos',
            'refColumns' => array('id_nivel_cargo')
        ),
        'Escolaridade' => array(
            'Columns' => array('id_escolaridade'),
            'refTableClass'=> 'Application_Model_DbTable_Escolaridade',
            'refColumns' => array('id_escolaridade')
        )
    );


}

