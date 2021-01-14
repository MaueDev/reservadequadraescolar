﻿<?php
	// 1. Criar conexão com o banco de dados
	define("BD_HOST", "localhost");
	define("BD_USUARIO", "root");
	define("BD_SENHA", "");
	define("BD_NOME", "reservaquadra");

	$conexao = mysqli_connect(BD_HOST, BD_USUARIO, BD_SENHA, BD_NOME);
	mysqli_set_charset($conexao,"utf8");
	// 2. Testar conexão criada
	if(mysqli_connect_errno()) {
		die("Conexão com o banco de dados falhou: " .
			mysqli_connect_error() .
			" (" . mysqli_connect_errno() . ")"
		);
	}
?>
