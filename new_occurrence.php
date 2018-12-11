<?php 
include_once('database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
   die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
if (isset($_GET['relevance'])) {
   $relevance = $_GET['relevance']; 
   if ($user['position']=='Diretor Nacional' || ($relevance==2 && $user['position']=='Polícia')){
      die('Página não disponível para as atuais permissões');
   }
   $missing=-1;
}
else {
   $relevance = 2;
   $missing = $_GET['id'];
}
$station = (int) GetStationByUsername($username);
?>

<!DOCTYPE html>
<html>
<title> Nova Ocorrência </title>

<?php include_once('common/header_aside.php'); ?>

<body>
   <h1> Registo de uma Nova Ocorrência </h1>
   <form action="action_occurence.php?relevance=<?=$relevance?>&missing=<?=$missing?>" method=post>
       <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
       <div id="occ_type">
         <h3> Tipo de ocorrência: </h3>
         <?if(isset($_GET['id'])) {?>
            <p><select name="occ_type">
               <option value=12>Desaparecimento</option>
            </select></p>
            <?php }
         else {?>
            <p> <select name="occ_type">
            <?php $occ_types=GetOcc_type($relevance);
            foreach ($occ_types as $occ_type){?>
               <option value=<?=$occ_type['id']?>> <?= $occ_type['name'] ?> </option>
            <?php } ?> 
            </select></p>
         <? } ?>
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
           <?if(isset($_GET['local'])) {
              $local=$_GET['local']; ?>
              <input type="text" name="location" value="<?echo $local;?>">
           <?}
           else {?>
           <input type="text" name="location">
           <?}?>
      </div>

      <div id="title">
           <h3> Título: </h3>
           <input type="text" name="title">
      </div>

      <div id="description">
           <h3> Descrição: </h3>
           <?if(isset($_GET['name']) && isset($_GET['date'])) {
              $name=$_GET['name'];
              $date=$_GET['date'];
              $local=$_GET['local']; ?>
              <textarea rows="4" cols="50" name="description"><?echo $name . "; " . $date . "; " . $local;?></textarea>
           <?}
           else {?>
           <textarea rows="4" cols="50" name="description"  placeholder="Descreva sumariamente a ocorrência..."></textarea>
           <?}?>
      </div> 

      <div id="victim">
           <h3>Adicionar vítima:</h3>
           <h4>Pessoa nova:</h4>
           NIF:<input type="number" name="victim_nif"><br>
           <?php if (!isset($_GET['id'])) { ?>
                Nome:<input type="text" name="victim_name"><br>
           <?}
           else {?>
                Nome:<input type="text" name="victim_name" value="<?echo $_GET['name'];?>"><br>
           <?}?>
           <label>Sexo:</label>
           <label><input type="radio" name="victim_gender" value="Masculino">Masculino</label>
           <label><input type="radio" name="victim_gender" value="Feminino">Feminino</label><br>
           Data de nascimento:<input type="date" name="victim_birthdate"><br>
           Naturalidade:<input type="text" name="victim_naturality"><br>
           <?php if (!isset($_GET['id'])) { ?>
                Morada:<input type="text" name="victim_adress"><br>
           <?}
           else {?>
                Morada:<input type="text" name="victim_adress" value="<?echo $_GET['adress'];?>"><br>
           <?}?>
           <?php if (!isset($_GET['id'])) { ?>
                <textarea rows="4" cols="50" name="victim_description"  placeholder="Descrição física"></textarea><br>
           <?}
           else {?>
                <textarea rows="4" cols="50" name="victim_description"><?echo $_GET['description'];?></textarea><br>
           <?}?>
           Altura(cm):<input type="number" name="victim_height"><br>
           Peso(kg):<input type="number" name="victim_weight"><br>
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

      <div><input type="submit" value="Submeter"></div>
    </form>
   
</body>

<?php include_once('common/footer.php'); ?>
</html>
