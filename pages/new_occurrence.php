<?php 
include_once('../database/connection.php');
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

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Nova Ocorrência </title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
   <?php include_once('../common/header_aside.php'); ?>

   <body>
      <form id= "left" action="../actions/action_occurence.php?relevance=<?=$relevance?>&missing=<?=$missing?>" method=post enctype="multipart/form-data">
         <h1> Registo de uma Nova Ocorrência </h1>    
         <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
         <div id="occ_type">
            <label> Tipo de ocorrência: </label>
            <?if(isset($_GET['id'])) {?>
               <select name="occ_type">
                  <option value=12>Desaparecimento</option>
               </select>
               <?php }
            else {?>
               <select name="occ_type">
               <?php $occ_types=GetOcc_type($relevance);
               foreach ($occ_types as $occ_type){?>
                  <option value=<?=$occ_type['id']?>> <?= $occ_type['name'] ?> </option>
               <?php } ?> 
               </select>
            <? } ?>
         </div>
         
         <?php if ($relevance==2 && $user['position']!="Detetive"){?>
         <div id="chief">
            <label> Detetive Chefe: </label>
            <select name="chief">
               <?php $personnel="Detetive";
               $chiefs=GetPersonnelStation($personnel,$station);
               foreach ($chiefs as $chief){?>
                  <option value=<?=$chief['username']?>> <?= $chief['fullname'] ?> </option>
               <?php } ?>          
            </select> 
         </div>
         <?php }?>

         <div id="location">
            <label> Localização: </label>
            <?if(isset($_GET['local'])) {
               $local=$_GET['local']; ?>
               <input type="text" name="location" value="<?echo $local;?>">
            <?}
            else {?>
            <input type="text" name="location">
            <?}?>
         </div>

         <div id="title">
            <label> Título: </label>
            <input type="text" name="title">
         </div>

         <div id="description">
            <label> Descrição: </label><br>
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

         <div id="state">
            <label> Estado: </label>
            <select name="state">
                  <?php $states=GetStates();
                  foreach ($states as $state){?>
                     <option value=<?=$state['name']?>> <?= $state['name'] ?> </option>
                  <?php } ?>        
            </select>
         </div>

         <div id="victim">
            <h1>Adicionar vítima:</h1>
            <label> NIF: </label> <input type="number" name="victim_nif"><br>
            <label> Foto: </label> <input type="file" name="image"> <br>
            <?php if (!isset($_GET['id'])) { ?>
                  Nome:<input type="text" name="victim_name"><br>
            <?}
            else {?>
                  Nome:<input type="text" name="victim_name" value="<?echo $_GET['name'];?>"><br>
            <?}?>
            <label>Sexo:</label>
            <label><input type="radio" name="victim_gender" value="Masculino">Masculino</label>
            <label><input type="radio" name="victim_gender" value="Feminino">Feminino</label><br>
            <label> Data de nascimento:</label><input type="date" name="victim_birthdate"><br>
            <label> Naturalidade:</label><input type="text" name="victim_naturality"><br>
            <?php if (!isset($_GET['id'])) { ?>
                  <label> Morada:</label><input type="text" name="victim_adress"><br>
            <?}
            else {?>
                  <label> Morada:</label><input type="text" name="victim_adress" value="<?echo $_GET['adress'];?>"><br>
            <?}?>
            <?php if (!isset($_GET['id'])) { ?>
                  <textarea rows="4" cols="50" name="victim_description"  placeholder="Descrição física"></textarea><br>
            <?}
            else {?>
                  <textarea rows="4" cols="50" name="victim_description"><?echo $_GET['description'];?></textarea><br>
            <?}?>
            <label>Altura(cm):</label><input type="number" name="victim_height"><br>
            <label>Peso(kg):</label><input type="number" name="victim_weight"><br>
         </div>

         <div><input type="submit" value="Submeter"></div>
      </form>
      
   </body>

   <?php include_once('../common/footer.php'); ?>
</div>
</html>
