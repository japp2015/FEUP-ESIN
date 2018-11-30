<!-- Temos de decidir como pomos as pessoas no meio disto tudo--> 

<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$station = (int) GetStationByUsername($username);
?>

<!DOCTYPE html>
<html>
<title> Nova Ocorrência </title>

<?php include_once('common/header_aside.php'); ?>

<body>
   <h1> Registo de uma Nova Ocorrência </h1>
   <form action="action_occurence.php" method=post>
       <div id="occ_type">
          <h3> Tipo de ocorrência: </h3>
          <p><select name="occ_type">
              <?php $occ_types=GetAllOcc_type();
              foreach ($occ_types as $occ_type){?>
                <option value=<?=$occ_type['name']?>> <?= $occ_type['name'] ?> </option>
              <?php } ?>      
           </select></p>
        </div>
        <div id="chief">
           <h3> Detetive Chefe: </h3>
           <p><select name="chief">
              <?php $personnel="Detetive";
              $chiefs=GetPersonnelStation($personnel,$station);
              foreach ($chiefs as $chief){?>
                <option value= <?=$chief['username']?>> <?= $chief['fullname'] ?> </option>
              <?php } ?>          
           </select></p>
        </div>
        <div id="workers">
        <h3> Polícias associados: </h3>
              <?php $personnel="Polícia";
              $polices=GetPersonnelStation($personnel,$station);
              foreach ($polices as $police){?>
                  <input type="checkbox" name=<?=$police['username']?> value= <?=$police['username']?> > <?= $police['fullname']?>
              <?php } ?>
        </div>
        <div id="location">
           <h3> Localização: </h3>
           <input type="text" name="location">
        </div>
        <div id="title">
           <h3> Título: </h3>
           <input type="text" name="title">
        </div>
        <div id="description">
           <h3> Descrição: </h3>
           <textarea rows="4" cols="50" name="description" > Descreva sumariamente a ocorrência... </textarea>
        </div> 
        <div id="state">
           <h3> Estado: </h3>
           <p><select name="state">
                <option value="Arquivado"  > Arquivado </option>
                <option value= "Resolvido" > Resolvido </option>
                <option value= "Ativo" > Ativo </option>        
           </select></p>
        </div>
        <input type="submit" value="Submeter">
    </form>
