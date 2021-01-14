<!-- Menu -->
  <table class="table table-dark"  style="background-color: #000;">
    <tbody >
     <tr>
       <td id="menu" scope="col" onclick="redirect(1)" class="bg-primary" style="text-align: center; vertical-align: middle;">Solicitação</td>
       <td id="menu" scope="col" onclick="redirect(2)" class="bg-primary" style="text-align: center; vertical-align: middle;">Configuração</td>
       <td id="menu" scope="col" onclick="redirect(3)" class="bg-primary" style="text-align: center; vertical-align: middle;">Sair</td>
     </tr>
   </tbody>
  </table>
  <?php switch($_GET["home"]){
   case "home":
    $solicitação = encontrar_reserva_all($diadehoje);?>
    <table class="table">

    <thead class="thead-dark">
      <tr>
        <th scope="col">Data</th>
        <th scope="col">Hora</th>
        <th scope="col">Modalidade</th>
        <th scope="col">Quem</th>
      </tr>
      <tr>
        <form class="" action="modulo.php" method="post">
        <th colspan="2"><button type="submit" name="button" value="aprovar_todos" class="btn btn-success btn-sm">Aprovar Todos</button></th>
        <th colspan="2"><button type="submit" name="button" value="negar_todos" class="btn btn-danger btn-sm">Recusar Todos</button></th>
        </form>
      </tr>
    </thead>
    <tbody>
      <?php while($solicitacao = mysqli_fetch_assoc($solicitação)){?>
      <form class="" action="modulo.php?id=<?php echo $solicitacao["id"];  ?>" method="post">
      <tr>
        <td ><?php echo $solicitacao["data"]; ?></td>
        <td><?php echo $solicitacao["hora"]; ?></td>
        <td><?php echo $solicitacao["modalidade"]; ?></td>
        <td><?php echo $solicitacao["responsavel"]; ?></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit" name="button" value="aprovar" class="btn btn-success btn-sm">Aprovar</button></td>
        <td colspan="2"><button type="submit" name="button" value="negar" class="btn btn-danger btn-sm">Recusar</button></td>
      </tr>
      </form>
      <?php } ?>
    </tbody>
  </table>
<?php break;
  case "config":
  ?>
  <table class="table">
    <thead class="thead-dark">
      <td>Telefone</td>
      <td> <input type="text" class="form-control" placeholder="Não Habilitado" name="" value=""> </td>
    </thead>
  </table>
<?php break;} ?>
