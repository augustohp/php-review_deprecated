<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    public function init(){

        $twitter = new Zend_Service_Twitter('phpreview','ciband2010');
        $resposta = $twitter->accountVerifyCredentials();

        $linhas = $twitter->statusUserTimeline();

        echo var_dump($linhas);

        // finalizando conexão com o Twitter.
        $twitter->accountEndSession();
    }
}

