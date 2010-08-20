<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 class Zend_View_Helper_UsuarioLogado{
     protected $view;

     public function setView($view){
         $this->view = $view;
     }

     public function UsuarioLogado(){
         $auth = Zend_Auth::getInstance();
         
         if ($auth->hasIdentity()){ // o usuário está logado
             $logout = $this->view->url(array('controller'=>'auth','action'=>'logout'));
             $user = $auth->getIdentity();
             $usuario = new Application_Model_Usuario();
             $usuario->setId($user->id);

             $login = $usuario->getNome();

             $string = "<p>Bem vindo, ".$login.".</p>
             <a href='$logout' >Desconectar</a>";
         }else{
             $login = $this->view->url(array('controller'=>'auth','action'=>'login'));

             $formLogin = new Application_Form_Auth();
             $formLogin->setAction('/auth/login');

             echo $formLogin->__toString();
         }
         return $string;
     }
 }

?>
