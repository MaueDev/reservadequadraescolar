<?php
require_once("../includes/session.php");
if (isset($_POST["solicitação"])) {
//Funçoes permitida para o publico//
if($_POST["solicitação"] == "solicitar"){
  require_once("../includes/conexão.php");
  $telefone = "3499978414";
  $dia = $_GET["dia"];
  $hora = $_POST["hora"];
  $nome = $_POST["nome"];
  $modalidade = $_POST["opcoes"];
  if($nome == "" or $nome == " " or $nome == NULL or !isset($nome) or empty($nome)){
    $_SESSION["mensagem"] = " Preencha ";
    $_SESSION["mensagem1"] = "Modalidade e Seu nome" ;
    $_SESSION["btn_tipo"] = "alert-danger";
    echo "<script> window.location.href = \"index.php\";</script>";

  }elseif($modalidade == "" or $modalidade == " " or $modalidade == NULL or !isset($modalidade) or empty($modalidade)){
    $_SESSION["mensagem"] = " Preencha ";
    $_SESSION["mensagem1"] = "Modalidade e Seu nome" ;
    $_SESSION["btn_tipo"] = "alert-danger";
    echo "<script> window.location.href = \"index.php\";</script>";

  }else{

  //Mensgem Whatsapp//
  if($modalidade == "outro"){
    $msg = "%20Para%20outros%20fins";
  }else{ $msg = "%20Para%20jogar%20".$modalidade;}
    $mensagem = "Olá%20gostaria%20de%20reservar%20a%20quadra%20Dia%20".$dia."%20as%20".$hora.$msg.",%20Me%20chamo%20".$nome."%20Clique%20aqui%20para%20Liberar:%20http://quadraizoldino.sportsontheweb.net/index.php?fazerlogin=login";
  //Mensgem Whatsapp/FINAL/
  //Insert no DB//
    $query = "INSERT INTO mv_reserva (";
    $query .=" data, hora, modalidade, responsavel, solicitação";
    $query .=") VALUES (";
    $query .=" '{$dia}', '{$hora}', '{$modalidade}', '{$nome}', 1 ";
    $query .=")";
    $resultado = mysqli_query($conexao, $query);
      if($resultado) {  echo "<script> window.location.href = \"https://api.whatsapp.com/send?phone=55".$telefone."&text=".$mensagem."\";</script>";
    }
  //Insert no DB/FINAL/
}}
//Login
if ($_POST["solicitação"] == "entrar"){
  require_once("../includes/conexão.php");
  $usuario = htmlspecialchars(addslashes($_POST["usuario"]));
  $senha = $_POST['senha'] ? md5(trim(mysqli_real_escape_string($conexao,$_POST["senha"]))) : FALSE;
  // Definir Usuario Final
  //Caso Usuario e Senha estiver Vazio
  if($usuario == "" || $senha == ""){
    $_SESSION["mensagem"] = " Preencha ";
    $_SESSION["mensagem1"] = "Usuario e Senha" ;
    $_SESSION["btn_tipo"] = "alert-danger";
    echo "<script> window.location.href = \"index.php?fazerlogin=login\";</script>";

    // Caso estiver Preenchido os campos
  }else{

    $query = "SELECT * FROM cad_usuario WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $query);
      if(mysqli_num_rows($resultado) > 0){
       $_SESSION['cliente'] = $usuario;
       echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";

    }else{
      $_SESSION["mensagem"] = " Senha ou Usuario ";
      $_SESSION["mensagem1"] = "Incorreto" ;
      $_SESSION["btn_tipo"] = "alert-danger";
    echo "<script> window.location.href = \"index.php?fazerlogin=login\";</script>";

    }
  }
}
//Login/FINAL/

}else{
  //Funçoes para USUARIO LOGADO
  if (isset($_SESSION['cliente'])) {
    require_once("../includes/conexão.php");
    if(isset($_POST["button"])){
        switch($_POST["button"]){
          case 'aprovar':
          $id = $_GET["id"];
          $query = "UPDATE mv_reserva SET ";
          $query .= "solicitação = '2' ";
          $query .= "WHERE id = '{$id}' LIMIT 1";
          $resultado = mysqli_query($conexao, $query);
            if($resultado)
              {
              $_SESSION["mensagem"] = "Horario:";
              $_SESSION["mensagem1"] = " Aprovado!";
              $_SESSION["btn_tipo"] = "alert-success";

              echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";
              break;
            }else{
                  $_SESSION["mensagem"] = "Erro:";
                  $_SESSION["mensagem1"] = "Não foi possivel aprovar";
                  $_SESSION["btn_tipo"] = "alert-danger";
                    echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";
                    break;
                }
            break;
          case "negar":
            $id = $_GET["id"];
            $query = "DELETE FROM mv_reserva WHERE id = '{$id}' LIMIT 1";
            $resultado = mysqli_query($conexao, $query);
              if($resultado)
                {
                $_SESSION["mensagem"] = "Horario:";
                $_SESSION["mensagem1"] = " Recusado!";
                $_SESSION["btn_tipo"] = "alert-danger";

                echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";
                break;
              }else{
                    $_SESSION["mensagem"] = "Erro:";
                    $_SESSION["mensagem1"] = "Não foi possivel Recusar o horario";
                    $_SESSION["btn_tipo"] = "alert-danger";
                      echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";
                      break;
                  }
              break;
              case 'aprovar_todos':
              $query = "UPDATE mv_reserva SET ";
              $query .= "solicitação = '2' ";
              $query .= "WHERE solicitação = 1";
              $resultado = mysqli_query($conexao, $query);
                if($resultado)
                  {
                  $_SESSION["mensagem"] = "Todos os Horarios:";
                  $_SESSION["mensagem1"] = " Aprovado!";
                  $_SESSION["btn_tipo"] = "alert-success";

                  echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";
                  break;
                }else{
                      $_SESSION["mensagem"] = "Erro:";
                      $_SESSION["mensagem1"] = "Não foi possivel aprovar";
                      $_SESSION["btn_tipo"] = "alert-danger";
                        echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";
                        break;
                    }
                break;
                case "negar_todos":
                  $query = "DELETE FROM mv_reserva WHERE solicitação = '1' ";
                  $resultado = mysqli_query($conexao, $query);
                    if($resultado)
                      {
                      $_SESSION["mensagem"] = "Todos os Horarios:";
                      $_SESSION["mensagem1"] = " Recusado!";
                      $_SESSION["btn_tipo"] = "alert-danger";

                      echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";
                      break;
                    }else{
                          $_SESSION["mensagem"] = "Erro:";
                          $_SESSION["mensagem1"] = "Não foi possivel Recusar Todos os horario";
                          $_SESSION["btn_tipo"] = "alert-danger";
                            echo "<script> window.location.href = \"index.php?fazerlogin=login&home=home\";</script>";
                            break;
                        }
                    break;
        }
    }
  }
  echo "<script> window.location.href = \"index.php\";</script>"; }
 ?>
