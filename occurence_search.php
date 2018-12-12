
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php 
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username=$_SESSION['username'];
?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pesquisa de Ocurrência </title>
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('common/header_aside.php'); ?>

<body>

<form action="occurence_search_result.php" method="post">
    <h1>Pesquisa de ocorrência</h1>
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label>Título:<input type="text" name="title"></label><br>
    <label>Tipo: <select name="type">
        <?php $occ_types=GetAllOcc_type();?>
        <option value=""> </option>
        <?php foreach ($occ_types as $occ_type){?>
            <option value=<?=$occ_type['name']?>> <?= $occ_type['name'] ?> </option>
        <?php } ?> 
    </select></label><br>
    <label>Localização:<input type="text" name="location"></label><br>
    <label>Estado: <select name="state">
        <?php $states=GetStates();?>
        <option value=""> </option>
        <?php foreach ($states as $state){?>
            <option value=<?=$state['name']?>> <?= $state['name'] ?> </option>
        <?php } ?>        
    </select></label><br>
    <label>Descrição:</label><br>
    <textarea name="case_description" cols="40" rows="5"></textarea><br>
    <input type="submit" value="Pesquisar">
</form>
</body>

<?php include_once('common/footer.php'); ?>
</div>
</html>