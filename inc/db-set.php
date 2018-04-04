<?php
// Uma classe para a conexão com o banco de dados
mysqli_report(MYSQLI_REPORT_STRICT);	

// Função para abrir a conexão
function open_database() {
	try {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		 return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		 return null;
	}
}
// Função para fecha a conexão
function close_database($conn) {
	try {
		mysqli_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}