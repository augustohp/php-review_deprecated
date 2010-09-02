<?php

class AuthController extends Zend_Controller_Action
{

    protected $_application = null;

    public function init()
    {
        /* Initialize action controller here */
        //$this->_helper->acl->allow(null);
        $this->_application = new Zend_Session_Namespace('PHPReview');
        $usuario = new Application_Model_UsuarioMapper();
        $this->view->totalUsuarios = $usuario->getQuantidade();
    }

    public function loginAction()
    {
        // action body
                        $formLogin = new Application_Form_Auth();
                
                        if ($this->getRequest()->isPost()){
                            if ($formLogin->isValid($this->getRequest()->getPost())){
                
                                $usuario = new Application_Model_UsuarioMapper();
                                $db = $usuario->getDbTable()->getAdapter();
                
                                $adapter = new Zend_Auth_Adapter_DbTable($db,'usuario','ds_email','ds_senha',"concat('BASH!',md5(?))");
                
                                $adapter->setIdentity($formLogin->getValue('login'));
                                $adapter->setCredential($formLogin->getValue('password'));
                
                                $auth = Zend_Auth::getInstance();
                
                                $autenticado = $adapter->authenticate();
                
                                if ($autenticado->isValid()){
                                    $usuario = $adapter->getResultRowObject();
                                    $this->_application->currentRole = 'usuario';
                                    $this->_application->id = $usuario->id_usuario;
                                    $this->_application->nome = $usuario->nm_usuario;
                                    $auth->getStorage()->write($this->_application);
                                    $this->_helper->FlashMessenger('Login realizado com sucesso!');
                
                                    $this->_redirect('/');
                                   // return;
                                }else{
                                    $this->view->erroMessage = "Usuário ou Senha inválido. Tente novamente.";
                                }
                            }
                        }
                
                        $this->view->loginForm = $formLogin;
    }

    public function logoutAction()
    {
        // action body
                                $auth = Zend_Auth::getInstance();
                                $auth->clearIdentity();
                                $this->_application->currentRole = 'visitante';
                                $this->_redirect('/');
    }

    public function rememberAction()
    {
        // action body
            $form_mail = new Application_Form_Remember();

            if ($this->getRequest()->isPost()){
                if ($form_mail->isValid($this->getRequest()->getPost())){
                    $usuario = new Application_Model_UsuarioMapper();
                    $db = $usuario->getDbTable();

                    $sel  = $db->select();
                    $sel->where('ds_email = ?',$form_mail->getValue('email'));
                    $usuario = $db->fetchAll($sel);
                    if ($usuario->count() == 0){
                        $this->view->alerta = 'O e-mail informado não foi encontrado. Verifique se informou corretamente.';
                    }else{
                        $user = $usuario->current();
                        $token= $this->view->url(array('controller'=>'auth','action'=>'verify','token'=>base64_encode($user->ds_email."#".$user->id_usuario)));
                        echo $token;
                        // montando o e-mail a ser envaido.
                        $email = "<h2>Reenvio da senha</h2>
    <p>Foi feita uma solicitação de alteração de senha para o seu usuário. Verifique se as informações abaixo são do seu usuário.</p>
    <table>
      <tr><td>Nome: </td><td>".$usuario->ds_nome."</td></tr>
      <tr><td>E-mail:</td><td>".$usuario->ds_email."</td></tr>
    </table>
    <p>Caso este seja o seu usuário, <a href='http://www.revista.br/".$token."'>clique aqui</a> para alterar a sua senha.

    <p>Equipe PHP Review</p>";

                        // enviando o e-mail para o usuario.
                        $mail = new Zend_Mail();

                        $mail->setFrom('no-reply@revistaphp.com',"PHP Review")
                             ->addTo($usuario->ds_email,$usuario->ds_nome)
                             ->setBodyText("Alteração de senha!!!")
                             ->setSubject($email)
                             ->send();

                       // $this->_redirect('/auth/confirma');
                    }

                }
            }
            $this->view->formulario = $form_mail;
    }

    public function confirmaAction()
    {
        $id = $this->getRequest()->getParam('id');
        // action body
        if (!empty($id)){
           // verificando se a senha está correta.

           $senha = $this->getRequest()->getParam('senha');

           $usuario = new Application_Model_Usuario();
           $usuario->setId($id);
           $usuario->setSenha($senha);
           $usuarioM = new Application_Model_UsuarioMapper();
           $usuarioM->save($usuario);
           $this->view->mensagem = 'atualizado';
        }else{
            $this->view->mensagem = 'enviado';
        }
    }

    public function verifyAction()
    {
        // action body
        $token = $this->getRequest()->getParam('token');

        if (empty($token)){
            $this->_redirect("/");
            return;
        }

        $token_d = base64_decode($token);

        $itens = explode('#',$token_d);
echo var_dump($itens);
        $id = $itens[1];

        $form_confirma = new Application_Form_Confirma();
        $form_confirma->setAction('/auth/confirma');
        $form_confirma->addElement('hidden','id',array(
            'value'=> $id
        ));

        $this->view->formulario = $form_confirma;
    }


}









