
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
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>
    <div id="left">
        <form action="occurence_search_result.php" method="post">
            <h1>Pesquisa de ocorrência</h1>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label>Título: </label> <input type="text" name="title"><br>
            <label>Tipo: </label> <select name="type">
                <?php $occ_types=GetAllOcc_type();?>
                <option value=""> </option>
                <?php foreach ($occ_types as $occ_type){?>
                    <option value=<?=$occ_type['name']?>> <?= $occ_type['name'] ?> </option>
                <?php } ?> 
            </select><br>
            <label>Localização: </label><input type="text" name="location"><br>
            <label>Estado: </label> <select name="state">
                <?php $states=GetStates();?>
                <option value=""> </option>
                <?php foreach ($states as $state){?>
                    <option value=<?=$state['name']?>> <?= $state['name'] ?> </option>
                <?php } ?>        
            </select><br>
            <label>Descrição:</label><br>
            <textarea name="case_description" cols="40" rows="5"></textarea><br>
            <input type="submit" value="Pesquisar">
        </form>
    </div>
    </body>

    <?php include_once('../common/footer.php'); ?>
</div>
</html>