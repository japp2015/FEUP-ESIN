<?php 
include_once('database/connection.php');
session_start();
$id = $_GET['id'];
$occurrence = getOccurrenceById($id);
?>

<!DOCTYPE html>
<html>
<title><?php echo $occurrence['id'] . ' | ' . $occurrence['title'] ?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <h1><?php echo $occurrence['title'] ?></h1>
    <h3><?php echo $occurrence['type'] ?></h3>
</body>

</html>