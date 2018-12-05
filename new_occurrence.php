<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$relevance = $_GET['relevance'];
$station = (int) GetStationByUsername($username);
?>

<!DOCTYPE html>
<html>
<title> Nova Ocorrência </title>

<?php include_once('common/header_aside.php'); ?>

<body>
   <h1> Registo de uma Nova Ocorrência </h1>
   <form action="action_occurence.php?relevance=<?=$relevance?>" method=post>
       
       <div id="occ_type">
         <h3> Tipo de ocorrência: </h3>
         <p> <select name="occ_type">
         <?php $occ_types=GetOcc_type($relevance);
         foreach ($occ_types as $occ_type){?>
            <option value=<?=$occ_type['id']?>> <?= $occ_type['name'] ?> </option>
         <?php } ?> 
         </select></p>
      </div>

      <?php if ($relevance==2 && $user['position']!="Detetive"){?>
        <div id="chief">
           <h3> Detetive Chefe: </h3>
           <p> <select name="chief">
              <?php $personnel="Detetive";
              $chiefs=GetPersonnelStation($personnel,$station);
              foreach ($chiefs as $chief){?>
                <option value=<?=$chief['username']?>> <?= $chief['fullname'] ?> </option>
              <?php } ?>          
           </select> </p>
        </div>
      <?php }?>

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
           <textarea rows="4" cols="50" name="description"  placeholder="Descreva sumariamente a ocorrência..."></textarea>
      </div> 

      <div id="state">
           <h3> Estado: </h3>
           <p><select name="state">
               <?php $states=GetStates();
               foreach ($states as $state){?>
                  <option value=<?=$state['name']?>> <?= $state['name'] ?> </option>
               <?php } ?>        
           </select></p>
      </div>

       <?php if ($user['position']=="Diretor Nacional"){?>
        <div id="station">
           <h3> Esquadra: </h3>
           <p> <select name="station">
              <?php $stations=GetAllStations();
              foreach ($stations as $station){?>
                <option value= <?=$station['id']?>> <?= $station['name'] ?> </option>
              <?php } ?>          
           </select> </p>
        </div>
      <?php }?>

      <div><input type="submit" value="Submeter"></div>
    </form>
</body>
</html>
