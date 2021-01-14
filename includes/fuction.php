<?php
//Verificar Consulta
function confirmar_resultado($resultado) {
  if (!$resultado) {
    die("Consulta ao banco de dados falhou");
  }
}
//Verificar Consulta Final
function vesetemhorario($dia,$hora){
global $conexao;
$consulta  = "SELECT * ";
$consulta .= "FROM mv_reserva ";
$consulta .= "WHERE data = '{$dia}' and hora = '{$hora}' ";
$consulta .= "ORDER BY id ASC";
$clientes = mysqli_query($conexao, $consulta);
$query = mysqli_num_rows($clientes);

  if ($query == 0) {
    return FALSE;
  }else{
  return TRUE;
}
}
function encontrar_reserva($dia,$hora){
global $conexao;
$consulta  = "SELECT * ";
$consulta .= "FROM mv_reserva ";
$consulta .= "WHERE data = '{$dia}' and hora = '{$hora}' ";
$consulta .= "ORDER BY id ASC";
$clientes = mysqli_query($conexao, $consulta);
$reserva = mysqli_fetch_assoc($clientes);
confirmar_resultado($clientes);
return $reserva;
}
// Função para ADM
if (isset($_SESSION['cliente'])) {

  function encontrar_reserva_all($diadehoje){
  $hora = date('H').":00";
  global $conexao;
  $consulta  = "SELECT * ";
  $consulta .= "FROM mv_reserva ";
  $consulta .= "WHERE data >= '{$diadehoje}' and hora >= '{$hora}' and solicitação = 1 ";
  $consulta .= "ORDER BY data ASC, hora ASC";
  $clientes = mysqli_query($conexao, $consulta);
  confirmar_resultado($clientes);
  return $clientes;
}

}
 ?>
