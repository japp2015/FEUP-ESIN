<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$id = $_GET['occurrence_id'];
$occurrence = getOccurrenceById($id);
$station=$occurrence['station'];
$position="Polícia";
$polices=GetPolicesAvailable($position,$station,$id);
?>

<!DOCTYPE html>
<html>
<title><?php echo "Alocar Polícias" ?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
<form action="action_police.php?occurrence=<?=$id?>" method=post>     
    <div id="add_police">
        <h3> Polícias Disponiveis: </h3>
        <p><select name="add_police">
        <?php foreach ($polices as $police){?>
            <option value=<?=$police['username']?>> <?= $police['fullname'] ?> </option>
        <?php } ?> 
        </select></p>
    </div>
    
    <div><input type="submit" value="Submeter"></div>

</form>

</body>

</html>