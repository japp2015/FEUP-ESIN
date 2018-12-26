<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Atualizar Foto Pessoal </title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container"> 
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div id="left">
        <form action="../actions/action_upload_profile_pic.php" method="post" enctype="multipart/form-data" >
        <h1>Atualizar Foto Pessoal</h1>
        <label>Selecione foto pretendida:</label><br>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <input type="file" name="image"> <br>
            <input type="submit" value="Submeter">
        </form>
    </div>  
</body>

<?php include_once('../common/footer.php'); ?>
</div>
</html>