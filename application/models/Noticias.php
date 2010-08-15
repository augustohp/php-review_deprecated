<?php

class Application_Model_Noticias
{

    protected $_id;
    protected $_titulo;
    protected $_conteudo;
    protected $_publicacao;
    protected $_data_publicacao;
    protected $_data_alteracao;
    protected $_limite;
    protected $_pagina_principal;
    protected $_usuario;
    protected $_resumo;
    protected $_imagem;


    public function __contruct(array $opcoes = null){

        if (is_array($opcoes)){
            $this->setOptions($opcoes);
        }
    }

    public function  __set($name,  $value) {
        $metodo = 'set'.ucfirst($name);

        // Verificando se o campo solicitado existe.
        if (('mapper' == $name) || !method_exists($this,$metodo)){
            throw  new Exception("O método solicitado para o campo $name não existe.");
        }

        // Passando o valor para o método correspondente.
        $this->$metodo($value);
    }

    public function __get($name){
        $metodo = 'get'.ucfirst($name);

        // Verificando se o campo solicitado existe.
        if (('mapper' == $name) || !method_exists($this,$metodo)){
            throw  new Exception("O método solicitado para o campo $name não existe.");
        }

        // Passando o valor para o método correspondente.
        return $this->$metodo();
    }

    public function setOptions(array $opcoes){
        // buscando todos os métodos da classe
        $metodos = get_class_methods($this);

        foreach($opcoes as $item => $opcao){
             $metodo = 'set'.ucfirst($item);
             if (in_array($metodo,$metodos)){
                 $this->$metodo($opcao);
             }
        }
        return $this;
    }

    public function setTitulo($titulo){
        $this->_titulo = (string)$titulo;
        return $this;
    }

    public function getTitulo(){
        return $this->_titulo;
    }
    
    public function setDataPublicacao($data){
        if (strtotime($data) !== null){
            $this->_data_publicacao = strtotime($data);
            return $this;
        }else{
            throw new Exception('A data informada está em um formato inválido');
        }
    }

    public function getDataPublicacao($formato = 'd/m/Y'){
        return date($formato,$this->_data_publicacao);
    }

    public function setId($id){
        $this->_id = (int)$id;

        $mapper = new Application_Model_NoticiasMapper();
        $noticia = $mapper->find($this->_id);

        $param = array(
            'dataPublicacao'=> $noticia->dt_publicacao,
            'dataAtualizacao'=> $noticia->dt_alteracao,
            'titulo'=> $noticia->ds_titulo,
            'conteudo'=> $noticia->tx_materia,
            'edicao'=> $noticia->id_publicacao,
            'dataLimite' => $noticia->dt_limite,
            'entrada' => $noticia->in_home,
            'usuario' => $noticia->id_usuario,
            'resumo' => $noticia->ds_resumo,
            'imagem' => $noticia->url_imagem
        );

        $this->setOptions($param);

        return $this;

    }
    
    public function getId(){
        return $this->_id;
    }

    public function setConteudo($conteudo){
        $this->_conteudo = $conteudo;
        return $this;
    }

    /**
     * Busca conteúdo
     *
     * Recupera o conteúdo da notícia que está cadastrado no banco de dados.
     *
     * @return Text
     */
    public function getConteudo(){
        return $this->_conteudo;
    }

    /**
     * Edição
     *
     * Informa em qual edição esta matéria faz parte
     *
     * @param Int $edicao
     * @return Objeto
     */
    public function setEdicao($edicao){
        $this->_publicacao = $edicao;
        return $this;
    }
/**
 * Busca Edição
 *
 * Recupera a edição no qual esta reportagem faz parte.
 * 
 * @return Application_Model_Noticia
 */
    public function getEdicao(){
        return $this->_publicacao;
    }

    /**
     * Data de Atualização
     *
     * Informa qual a data de atualizacao da notícia
     *
     * @param datetime $data
     * @return Objeto
     */
    public function setDataAtualizacao($data){
        if (strtotime($data) !== null){
            $this->_data_alteracao = strtotime($data);
            return $this;
        }else{
            throw new Exception('A data informada está em um formato inválido');
        }
    }

    /**
     * Data de Atualização
     *
     * Recupera a data de atualização da matéria da revista
     * @param String $formato
     * @return Data
     */
    public function getDataAtualizacao($formato = 'd/m/Y'){
        return date($formato,$this->_data_alteracao);
    }

    /**
     * Data limite da publicação
     *
     * Informa a data máxima em que esta notícia estará vinculada na tela de entrada.
     * 
     * @param datetime $data
     * @return Objeto
     */
    public function setDataLimite($data){
       if (strtotime($data) !== null){
            $this->_limite = strtotime($data);
            return $this;
        }else{
            throw new Exception('A data informada está em um formato inválido');
       }
    }

    /**
     * Busca data limite
     *
     * Recupera a data limite em que a matéria estará vinculada
     *
     * @param String $formato
     * @return data
     */
    public function getDataLimite($formato = 'd/m/Y'){
        return date($formato,$this->_limite);
    }

    /**
     * Página de Entrada
     *
     * Define se a notícia deverá aparecer na tela de entrada ou não.
     *
     * @param Boolean $home
     */
    public function setEntrada($home){
        $this->_pagina_principal = $home;
        return $this;
    }

    public function getEntrada(){
        return $this->_pagina_principal;
    }

    public function setUsuario($usuario){
        $user = new Application_Model_Usuario();
        $user->setId($usuario);
        $this->_usuario = $user;
        return $this;
    }

    public function getUsuario(){
        return $this->_usuario;
    }

    public function setResumo($resumo){
        $this->_resumo = $resumo;
        return $this;
    }

    public function getResumo(){
        return $this->_resumo;
    }

    public function getImagem(){
        return $this->_imagem;
    }

    public function setImagem($url){
        $this->_imagem = $url;
        return $this;
    }
    

}

