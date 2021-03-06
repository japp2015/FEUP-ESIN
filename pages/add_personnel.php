<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
if (!isset($_GET['occurrence_id']) || !isset($_GET['type'])){
    die('Não autorizado');
}
$id = $_GET['occurrence_id']; 
$type= $_GET['type'];
$occurrence = getOccurrenceById($id);
$station=$occurrence['station'];
$personnels=GetPersonnelAvailable($type,$station,$id);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "Alocar ". $type ?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>
    <form id="left" action="../actions/action_personnel_to_occ.php?occurrence=<?=$id?>" method=post>     
        <div id="add_personnel">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <h1> <?=$type . "s"?> Disponiveis </h1>
            <p><select name="add_personnel">
            <?php foreach ($personnels as $personnel){?>
                <option value=<?=$personnel['username']?>> <?= $personnel['fullname'] ?> </option>
            <?php } ?> 
            </select></p>
        </div>
        
        <div><input type="submit" value="Submeter"></div>

    </form>
    </body>

    <?php include_once('../common/footer.php'); ?>
</div>
</html>