 <?php 

class Usuario{

private $idusuario;
private $deslogin;
private $dessenha;
private $dtcadastro;

//Pegar o valor
public function getIdusuario(){

		return $this->idusuario;

}
//Gravar o valor
public function setIdusuario($value){

	$this->idusuario = $value;

}
public function getDeslogin(){

		return $this->deslogin;

}

public function setDeslogin($value){

	$this->deslogin = $value;

}
public function getDessenha(){

	return $this->dessenha;

}

public function setDessenha($value){

	$this->dessenha = $value;

}
public function getDtcadastro(){

	return $this->dtcadastro;

}

public function setDtcadastro($value){

	$this->dtcadastro = $value;

}
//Método para listar somente um usuário pelo ID
public function loadById($id){

	$sql = new Sql();
	$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

	if(isset($result[0])){
		$row = $result[0];
		$this->setData($result[0]);
	}

}
//Transformando o método em STATIC eu posso chamar diretamente através do código Usuario::getList() sem necessidade de instanciar a classe new Usuario()
//Método para listar todos os usuários da tabela
public static function listarUsuarios(){

	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario");

}
//Metodo para buscar somente um usuario especifico
public static function BuscarUsuario($login){

	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :LOGIN ORDER BY deslogin", array(
		"LOGIN"=>"%".$login."%"
	));

}
//Login de usuario
public function login($login, $senha){

	$sql = new Sql();
	$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(

		":LOGIN"=>$login,
		":SENHA"=>$senha

	));

	if(isset($result[0])){
		$row = $result[0];
		
		$this->setData($result[0]);

	} else{

		throw new Exception("Login e/ou Senha inválidos");
	}

}

public function setData($data){


	$this->setIdusuario($data['idusuario']);
	$this->setDeslogin($data['deslogin']);
	$this->setDessenha($data['dessenha']);
	$this->setDtcadastro(new DateTime($data['dtcadastro']));

}


//Método para cadastro de usuário
public function insert(){

	$sql = new SQL();

	$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
		':LOGIN'=>$this->getDeslogin(),
		':SENHA'=>$this->getDessenha()
	));

	if(isset($results[0])){

		$this->setData($results[0]);
	}

}
public function __construct($login = "", $senha = ""){

	$this->setDEslogin($login);
	$this->setDessenha($senha);


}


//Método para atualizar usuário
public function update($login, $senha){

	$this->setDeslogin($login);
	$this->setDessenha($senha);

	$sql = new Sql();

	$results = $sql->select("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(

		':LOGIN'=>$this->getDeslogin(),
		':SENHA'=>$this->getDessenha(),
		':ID'=>$this->getIdusuario()
	));
}

public function delete(){

	$sql = new Sql();

	$sql->select("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
		':ID'=>$this->getIdusuario()
	));

	$this->setIdusuario(0);
	$this->setDeslogin();
	$this->setDessenha();
	$this->setDtcadastro(new DateTime());

}

/////////////////////

//Método mágico para exibir dados de um objeto como string decodificada em json
public function __toString(){

	return json_encode(array(
		"idusuario"=>$this->getIdusuario(),
		"deslogin"=>$this->getDeslogin(),
		"dessenha"=>$this->getDessenha(),
		"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
	));
}


}


?>