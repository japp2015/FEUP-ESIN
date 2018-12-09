<?php 
include_once('database/connection.php');
session_start();
if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
    die('Não autorizado');
}
$username=$_SESSION["username"];
UploadProfilePicture($username, $username);

$FileName = "profile_pic/$username.jpg";

// Move the uploaded file to its final destination
move_uploaded_file($_FILES['image']['tmp_name'], $FileName);

header("Location: main.php");

?>