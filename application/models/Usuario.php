<?php

class Application_Model_Usuario
{

    protected $_id;
    protected $_nome;
    protected $_email;
    protected $_sexo;
    protected $_endereco;
    protected $_complemento_endereco;
    protected $_numero;
    protected $_cep;
    protected $_bairro;
    protected $_cidade;
    protected $_estado;
    protected $_senha;
    protected $_escolaridade;
    protected $_faixa_salarial;
    protected $_nivel_cargo;
    protected $_como_conheceu;
    protected $_dt_criacao;
    protected $_dt_atualizacao;
    protected $_grupo;
    protected $usuarioMapper;

    public function  __construct(array $options = null) {

        if (is_array($options)){
            $this->setOptions($options);
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

    /**
     * Preenchendo novo usuário
     *
     *  Este método é utlizado quando não existe usuário cadastrado no sistema. Neste caso, cada item do
     *  do array deve corresponder a um método desta classe.
     *
     * @param Array $opcoes
     * @return Objeto
     */
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

    /**
     * Seleciona o Id
     * 
     * Neste método serão preenchidas as variáveis quando o usuário já existe.
     *  
     * @param int $id 
     */
    public function setId($id){
        // selecionando o item Id
        $this->_id = (int)$id;

        // buscando os valores no banco de dados
        $mapper = new Application_Model_UsuarioMapper();
        $usuario = $mapper->find($id);

        // Preenchendo os campos para utilizacao.
        $itens = array(
                'nome' => $usuario->nm_usuario,
                'email'   => $usuario->ds_email,
                'sexo'    => $usuario->sexo,
                'endereco'=> $usuario->ds_endereco,
                'complEndereco'=> $usuario->ds_complemento,
                'numero'  => $usuario->ds_numero,
                'cep'     => $usuario->nr_cep,
                'bairro'  => $usuario->ds_bairro,
                'cidade'  => $usuario->ds_cidade,
                'estado'  => $usuario->id_estado,
                'escolaridade'=> $usuario->id_escolaridade,
                'faixaSalarial'=> $usuario->id_faixa_salarial,
                'comoConheceu'=> $usuario->ds_como_conheceu,
                'dataCriacao' => $usuario->dt_criacao,
                'dataAtualizacao'=> $usuario->dt_atualizacao,
                'grupo'   => $usuario->id_grupo);

        $this->setOptions($itens);
        return $this;
    }

    /**
     * Retorna o id do usuário solicitado.
     * @return Int
     */
    public function getId(){
        return $this->_id;
    }

    public function setNome($nome){
       $this->_nome = $nome;
       return $this;
    }

    public function getNome(){
        return $this->_nome;
    }

    public function setEmail($email){
        if (is_string($email)){
            $this->_email = $email;
        }
        return $this;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function setSexo($sexo){
        $this->_sexo = $sexo;
        return $this;
    }

    public function getSexo(){
        return $this->_sexo;
    }

    public function setEndereco($endereco){
        $this->_endereco = (string)$endereco;
        return $this;
    }
    
    public function getEndereco(){
        return $this->_endereco;
    }
    
    public function setComplEndereco($complemento){
        $this->_complemento_endereco = (string)$complemento;
        return $this;
    }
    
    public function getComplEndereco(){
        return $this->_complemento_endereco;
    }
    
    public function setNumero($numero){
        $this->_numero = (int)$numero;
        return $this;
    } 
    
    public function getNumero(){
        return $this->_numero;
    }
    
    public function setCep($cep){
        $this->_cep = (int)$cep;
        return $this;
    }
    
    public function getCep(){
        return $this->_cep;
    }
    
    /**
     * Insere o bairro do usuário.
     *
     * @param string $bairro
     * @return Objeto
     */
    public function setBairro($bairro){
        $this->_bairro = (string)$bairro;
        return $this;
    }

    public function getBairro(){
        return $this->_bairro;
    }

    public function setCidade($cidade){
        $this->_cidade = (string)$cidade;
        return $this;
    }

    public function getCidade(){
        return $this->_cidade;
    }

    public function setEstado($estado){
        $this->_estado = $estado;
        return $this;
    }

    public function getEstado(){
        return $this->_estado;
    }

    public function setEscolaridade($escolaridade){
        $this->_escolaridade = new Application_Model_Escolaridade();
        $this->_escolaridade->setId($escolaridade);
        return $this;
    }
    
    public function getEscolaridade(){
        return $this->_escolaridade;
    }
    
    public function setFaixaSalarial($faixa){
        $this->_faixa_salarial = new Application_Model_FaixaSalarial();
        $this->_faixa_salarial->setId($faixa);
        return $this;
    }
    
    public function getFaixaSalarial(){
        return $this->_faixa_salarial;
    }

    public function setCargo($nivel){
        $this->_nivel_cargo = new Application_Model_Cargos();
        $this->_nivel_cargo->setId($nivel);
        return $this;
    }

    public function getCargo(){
        return $this->_nivel_cargo;
    }

    public function setComoConheceu($opniao){
        $this->_como_conheceu = (string)$opniao;
        return $this;
    }

    public function getComoConheceu(){
        return $this->_como_conheceu;
    }

    public function setDataCriacao($data){
        if (strtotime($data)){
            $this->_dt_criacao = $data;
        }
        return $this;
    }

    public function getDataCriacao(){
        return $this->_dt_criacao;
    }

    public function setDataAtualizacao($data){
        if(strtotime($data)){
            $this->_dt_atualizacao = $data;
        }
        return $this;
    }

    public function getDataAtualizacao(){
        return $this->_dt_atualizacao;
    }

    public function setGrupo($grupo){
        $this->_grupo = $grupo;
    }

    public function getGrupo(){
        // TODO: retornar neste método uma instancia da classe grupo.

        return 'usuario';//$this->_grupo;
    }

    public function setSenha($senha){
        if (strpos($senha, 'BASH!') === false){
           $this->_senha = 'BASH!'.sha1($senha);
        }else{
            $this->_senha = $senha;
        }

        return $this;
    }

    public function getSenha(){
        return $this->_senha;
    }

}