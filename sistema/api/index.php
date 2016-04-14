<?php
/*
	Author - Anjana Wijesundara
	Contact - wsanjana951@gmail.com
*/
require 'Slim/Slim.php';

$app = new Slim();

$app->get('/Cadastros', 'getCadastros');
$app->get('/Cadastros/:id', 'getCadastro');
$app->post('/Novo_Cadastro', 'addCadastro');
$app->put('/Cadastros/:id', 'updateCadastro');
$app->delete('/Cadastros/:id', 'deleteCadastro');

$app->run();

// Get Database Connection
function DB_Connection() {	
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "sistema";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}
//Get Customer Details
function getCadastros() {
	$sql = "SELECT id, nome, sobrenome, usuario, cadastrado, atualizado FROM usuarios";
	try {
		$db = DB_Connection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

// Add new Customer to the Database
function addCadastro() {
	$request = Slim::getInstance()->request();
	$cus = json_decode($request->getBody());

	$sql = "INSERT INTO usuarios (nome, sobrenome, usuario, senha) VALUES (:nome, :sobrenome, :usuario, :senha)";
	try {
		$db = DB_Connection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nome", $cus->nome);
		$stmt->bindParam("sobrenome", $cus->sobrenome);
		$stmt->bindParam("usuario", $cus->usuario);
		$stmt->bindParam("senha", $cus->senha);
		$stmt->execute();
		$cus->id = $db->lastInsertId();
		$db = null;
		echo json_encode($cus); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
// GET One Customer Details
function getCadastro($id) {
	$sql = "SELECT id, nome, sobrenome, usuario, senha FROM usuarios WHERE id=".$id." ORDER BY id";
	try {
		$db = DB_Connection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
//Update Cutomer Details
function updateCadastro($id) {
	$request = Slim::getInstance()->request();
	$cus = json_decode($request->getBody());

	$sql = "UPDATE usuarios SET nome=:nome, sobrenome=:sobrenome, usuario=:usuario, senha=:senha WHERE id=:id";
	try {
		$db = DB_Connection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nome", $cus->nome);
		$stmt->bindParam("sobrenome", $cus->sobrenome);
		$stmt->bindParam("usuario", $cus->usuario);
		$stmt->bindParam("senha", $cus->senha);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($cus); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
//DELETE Customer From the Database
function deleteCadastro($id) {
	$sql = "DELETE FROM usuarios WHERE id=".$id;
	try {
		$db = DB_Connection();
		$stmt = $db->query($sql);  
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($list);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

?>