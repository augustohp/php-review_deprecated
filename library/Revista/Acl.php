<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once 'Zend/Acl/Role.php';
 require_once 'Zend/Acl/Resource.php';

 class Revista_Acl extends Zend_Acl  {


    /**
     * Grava papéis de usuários.
     *
     *   Este método é utilizado para dar os papéis necessários para os usuários.
     *
     * @return Objeto
     */
    public function gravaPapeis(){
        $this->addRole(new Zend_Acl_Role('visitante'))
             ->addRole(new Zend_Acl_Role('usuario'),'visitante')
             ->addRole(new Zend_Acl_Role('admin'),'usuario');
        return $this;
    }

    public function gravaRecursos(){
        $this->add(new Zend_Acl_Resource('contato'))
             ->add(new Zend_Acl_Resource('edicoes'))
             ->add(new Zend_Acl_Resource('error'))
             ->add(new Zend_Acl_Resource('index'))
             ->add(new Zend_Acl_Resource('noticia'))
             ->add(new Zend_Acl_Resource('auth'))
             ->add(new Zend_Acl_Resource('usuario'))
             ->add(new Zend_Acl_Resource('hotsite'));

        return $this;
    }

    public function Permissoes(){
        // Primeiro dando as negações para depois dar as permissões.

        $this->allow('visitante','edicoes',array('index','detalhe'))
             ->deny('visitante','edicoes','download')
             ->allow('usuario','edicoes',array('download'))
             ->allow('visitante','index')
             ->allow('visitante','noticia')
             ->allow('visitante','contato')
             ->allow('visitante','auth')
             ->allow('visitante','usuario')
             ->allow('visitante','error')
             ->allow('visitante','hotsite');

        return $this;
    }

 }

?>
