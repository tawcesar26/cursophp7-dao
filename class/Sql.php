<?php 

//Classe Sql herdando os métodos do PDO
class Sql extends PDO{

	private $conn;


	//Sempre que a classe Sql for chamado o Método construtor será executado automaticamente, realizando a conexão com o banco de dados.
	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

	}

	//Método para fazer o bind em vários dados (Chamando a cada vez o método SetParam)
	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->setParam($key, $value);

		}

	}

	//Métódo para fazer o bind em um único dado
	private function setParam($statment, $key, $value){

		$statment->bindParam($key, $value);

	}

	//Método para preparar e fazer o bind dos parametros, para depois executar
	public function executarQuery($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->executarQuery($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
	
}


 ?>