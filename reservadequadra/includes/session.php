<?php

	session_start();

	function mensagem() {
		if(isset($_SESSION["mensagem"])) {

			$mensagem =  "<div class=\"alert ".$_SESSION["btn_tipo"]." alert-dismissible fade show\" role=\"alert\">";
  		$mensagem .= "<strong>".$_SESSION["mensagem"]."</strong>".$_SESSION["mensagem1"]."";
  		$mensagem .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
    	$mensagem .= "<span aria-hidden=\"true\">&times;</span>";
  		$mensagem .= "</button>";
      $mensagem .= "</div>";

			$_SESSION["mensagem"] = NULL;
			$_SESSION["mensagem1"] = NULL;
			$_SESSION["btn_tipo"] = NULL;

			return $mensagem;
		}
	}

	function errors() {
		if(isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];

			$_SESSION["errors"] = NULL;

			return $errors;
		}
	}
?>
