<?php
require_once("../includes/session.php");

require_once("../includes/fuction.php");
/////////////////////////////////////////
//Area de Programação///////////////////
if(isset($_GET["dia"])){
  $diadehoje = $_GET["dia"];
}else{$diadehoje = Date("Y-m-d"); }
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
  function atual(){
    var hora = "<?php date_default_timezone_set('America/Sao_Paulo');
    echo date('H').":00"; ?>";
    var conteudo = document.getElementById(hora).innerHTML;
    var mAtual = "<table class=\"table table-sm table-dark\"><thead><tr><th colspan=\"5\">Periodo em Quadra</th></tr>" + conteudo + "</thead></table>"
    document.getElementById('atual').innerHTML = mAtual;
  }
    </script>
    <title>Quadra Izoldino</title>
  </head>
  <body onload="atual();" style="background-color: #503DFF;">

    <header >

      <div style="margin-bottom: 5px; background-color: #fff; border-radius: 0px 0px 5px 5px; margin-left:3px; margin-right:3px; text-align: center; padding:10px; box-shadow: 1px 1px 5px 1px #000;">
        <small style="float:right; font-size:9px">Site Não Governamental</small>
        <br>
        <h1>E.E Izoldino Soares De Freitas </h1>
        <h6>Horario Disponiveis</h6>
      </div>
    </header>
    <div style="margin-bottom: 5px; background-color: #fff; border-radius: 5px; margin-left:3px; margin-right:3px; text-align: center; padding:10px; box-shadow: 1px 1px 5px 1px #000;">
      <?php require_once("../includes/conexão.php");
      echo mensagem();
      if(isset($_GET["fazerlogin"]) and $_GET["fazerlogin"] == "login"){
        if (isset($_SESSION['cliente'])) {
          $mostralperiodo = "Nãomostrar";
          require_once("../includes/adm.php");
        }else{
          require_once("../includes/login.html");
          $mostralperiodo = "Nãomostrar";
        }
      }else{
        $mostralperiodo = "mostrar";
      } ?>

      <table class="table table-sm table-dark">
        <thead>
          <tr>
            <th style="text-align: center; vertical-align: middle;" id="data-hora"></th>
            <th style="text-align: center; vertical-align: middle;">Data:</th>
            <th style="text-align: center; vertical-align: middle;"> <input type="date" id="data" class="form-control" onChange="selecionardata()" value="<?php  if(isset($_GET["dia"])){echo $_GET["dia"];}else{ echo Date("Y-m-d");} ?>"> </th>
          </tr>
          <?php if($mostralperiodo == "mostrar"){ ?>
          <tr>
            <?php if($diadehoje == Date("Y-m-d")){ ?>
            <div id="atual">
            </div>
          <?php } ?>
          </tr>
          <?php } ?>
        </thead>
      </table>
      <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">Horario</th>
            <th scope="col">Modalidade</th>
            <th scope="col" colspan="2">Responsavel</th>
          </tr>
        </thead>
        <tbody>
          <?php $a = 0;
          while ($a <= 16) { $hora = 7+$a.":00";

            ///Desabilitar botão
            if($diadehoje == Date("Y-m-d")){
            if(strlen($hora) == 4){$horap = "0".$hora;}else{$horap = $hora; }
            }elseif($diadehoje < Date("Y-m-d")){$horap = -10000;}else{ $horap = 10000000000000000;}
            ///Desabilitar botão
            $reserva = encontrar_reserva($diadehoje,$hora);
            if(isset($reserva)){
              if($reserva["solicitação"] == 2){?>


              <tr id="<?php echo $hora;?>">
                <th class="table-info" scope="row" style="text-align: center; vertical-align: middle;"><?php echo $hora;?></th>
                <td class="table-info" style="text-align: center; vertical-align: middle;"> <?php echo $reserva["modalidade"]; ?> </td>
                <td class="table-info" colspan="2" style="text-align: center; vertical-align: middle;"> <?php echo $reserva["responsavel"]; ?> </td>
              </tr>
            <?php } elseif ($reserva["solicitação"] == 1) {
              echo "<tr id=\"".$hora."\"><th class=\"table-warning\" scope=\"row\" style=\"text-align: center; vertical-align: middle;\">".$hora."</th><th class=\"table-warning\" scope=\"row\" style=\"text-align: center; vertical-align: middle;\">".$reserva["modalidade"]."</th><td class=\"table-warning\" style=\"text-align: center; vertical-align: middle;\" colspan=\"2\">Horario Solicitado Aguarde liberação da Diretoria</td></tr>";
            } ?>

          <?php }else{
            $horaatual = date('H:i');
            $tempo1 = $hora.":00";
            $tempo2 = "00:30:00";
            $tempo = gmdate('H:i:s', abs( strtotime( $tempo1 ) - strtotime( $tempo2 ) ) );
            $verificadoraa = vesetemhorario($diadehoje,$tempo);
            if($verificadoraa == TRUE){
            $a-1;
            }
            ?>

            <form class="" action="modulo.php?dia=<?php echo $diadehoje."&hora=".$hora; ?>" method="post">
          <tr id="<?php echo $hora;?>" <?php if($horap <= $horaatual){ echo "class=\"table-active\""; } ?>>
            <th scope="row" style="text-align: center; vertical-align: middle;font-size:12px; width:50px;">
              <select class="" name="hora">
                <option value="<?php echo $hora.":00";?>"><?php echo $hora.":00";?></option>
                <option value="<?php echo $tempo; ?>"><?php echo $tempo; ?></option>

              </select>
            </th>
            <td style="text-align: center; vertical-align: middle;">
                <select <?php if($horap <= $horaatual){ echo "disabled=\"\""; } ?> name="opcoes" class="form-control" id="select">
                  <option value=""></option>
                  <option value="Basquete">Basquete</option>
                  <option value="Volei">Volei</option>
                  <option value="Futebol">Futebol</option>
                  <option value="Outro">Outro</option>
                </select>
            </td>
            <td style=""> <input type="text" class="form-control"  placeholder="Seu nome"name="nome" value="" <?php if($horap <= $horaatual){ echo "disabled=\"\""; } ?>> </td>
            <td> <button type="submit" class="btn btn-primary mb-2"  style="color: #fff;"name="solicitação" value="solicitar" <?php if($horap <= $horaatual){ echo "disabled=\"\""; } ?>>Solicitar</button> </td>
          </tr>
            </form>
          <?php  }$a ++;} ?>
        </tbody>
      </table>

    </div>
    <footer onclick="redirect(4)" style="margin-bottom: 5px; background-color: #fff; border-radius: 0px 0px 5px 5px; margin-left:3px; margin-right:3px; text-align: center; padding:10px; box-shadow: 1px 1px 5px 1px #000;">

      <h5 style="text-align:center;">Desenvolvido Por: M Λ U Ξ</h5>

    </footer>
    <!-- Script -->
  <script>

  function selecionardata(){
    var valor = document.getElementById('data').value;


    var local = "index.php?dia="+valor;
    window.location.href = local;
  }
    </script>
    <script>
    // Função para formatar 1 em 01
    const zeroFill = n => {
      return ('0' + n).slice(-2);
    }

    // Cria intervalo
    const interval = setInterval(() => {
      // Pega o horário atual
      const now = new Date();

      // Formata a data conforme dd/mm/aaaa hh:ii:ss
      const dataHora = zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(now.getSeconds());

      // Exibe na tela usando a div#data-hora
      document.getElementById('data-hora').innerHTML = dataHora;
    }, 1000);
  </script>
    <script type="text/javascript" src="js/function.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>
