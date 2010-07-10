<?php

class Application_Model_DbTable_FaixaSalarial extends Zend_Db_Table_Abstract
{

    protected $_name = 'faixa_salarial';
    protected $_primary = 'id_faixa_salarial';
    protected $_sequence = true;
    protected $_referenceMap = array(
        'Usuario' => array(
            'Columns' => array('id_faixa_salarial'),
            'refTableClass'=> 'Application_Model_DbTable_Usuario',
            'refColumns' => array('id_faixa_salarial')
        )
    );


}

