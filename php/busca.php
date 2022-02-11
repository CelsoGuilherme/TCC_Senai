<?php
  include("conexao.php");

  $busca =  htmlspecialchars($_POST['busca'], ENT_QUOTES);

  $selectid = "SELECT * FROM postagens";
  $con = $conexao->query($selectid) or die ($conexao->error);
  
  if(empty($busca)){
    
  } else {
    $aspas = "'";
    $query = mysqli_query($conexao, "SELECT * FROM professor WHERE Nome LIKE '%$busca%' OR Email LIKE '%$busca%'");
    $tabelprof="professor";
    $num   = mysqli_num_rows($query);
    $queryescola = mysqli_query($conexao, "SELECT * FROM escola WHERE Nome LIKE '%$busca%' OR emailescola LIKE '%$busca%'");
    $tabelescola="escola";
    $numescola   = mysqli_num_rows($queryescola);
    if($num >0 || $numescola >0){
        while($row = mysqli_fetch_assoc($query)){
          echo '<div class="wrapperResultPerfil" onclick="abrePopupPerfil('.$aspas.$row["IdProfessor"].$aspas.','.$aspas.$tabelprof.$aspas.')">'.$row['Nome'].' - '.$row['Email'].'</div>';
        }
        while($rowescola = mysqli_fetch_assoc($queryescola)){
          echo '<div class="wrapperResultPerfil" onclick="abrePopupPerfil('.$aspas.$rowescola["IdEscola"].$aspas.','.$aspas.$tabelescola.$aspas.')">'.$rowescola['Nome'].' - '.$rowescola['emailescola'].'</div>';
        }
    } else {
      echo "<p class='text-white avisosBuscaPerfil erroBusca'>Usuário Não Encontrado!</p>";
    }
  }
?>
