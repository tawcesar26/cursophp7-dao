<?php 

require_once("config.php");

/*$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);
*/
/////////////////////////////////////////////////////////////////////////
//Carrega somente um usuário
/*$root = new Usuario();
$root->loadById(1);
echo $root;
*/
/////////////////////////////////////////////////////////////////////////
//Carregar lista de usuarios
/*
$lista = Usuario::buscarUsuario("user");
echo json_encode($lista);
*/
/////////////////////////////////////////////////////////////////////////
/*
$login = new Usuario();
$login->login("user","123456");

echo $login;
*/
/////////////////////////////////////////////////////////////////////////
/* Cadastro de Usuario
$aluno = new Usuario("aluno","123456");

$aluno->insert();

echo $aluno;
*/
/////////////////////////////////////////////////////////////////////////
/*
$usuario = new Usuario();

$usuario->loadByID(8);

$usuario->update("professor","123");

echo $usuario;
*/

$usuario = new Usuario();

$usuario->loadByID(7);

$usuario->delete("");

echo $usuario;


?>