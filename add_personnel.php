<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$id = $_GET['occurrence_id'];
$type= $_GET['type'];
$occurrence = getOccurrenceById($id);
$station=$occurrence['station'];
$personnels=GetPersonnelAvailable($type,$station,$id);
?>

<!DOCTYPE html>
<html>
<title><?php echo "Alocar ". $type ?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
<form action="action_personnel_to_occ.php?occurrence=<?=$id?>" method=post>     
    <div id="add_personnel">
        <h3> <?=$type . "s"?> Disponiveis: </h3>
        <p><select name="add_personnel">
        <?php foreach ($personnels as $personnel){?>
            <option value=<?=$personnel['username']?>> <?= $personnel['fullname'] ?> </option>
        <?php } ?> 
        </select></p>
    </div>
    
    <div><input type="submit" value="Submeter"></div>

</form>

</body>

</html>