<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$nif=$_GET['nif'];
$person=GetPersonByNif($nif);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $person['name']?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div id="left">
        <h1><?php echo $person['name']?></h1>
        <?php if (isset($person['profile_pic'])) { ?>
            <img src="../person_pic/<?=$person['profile_pic']?>.jpg">
        <?php }?>
        <p> <i>Sexo: </i><?php echo $person['gender']?> </p>
        <p> <i>Data de nascimento: </i><?php echo $person['birthdate']?>  </p>
        <p> <i>Peso: </i><?php echo $person['weight']?>  kg </p>
        <p> <i>Altura:</i> <?php echo $person['height']?>  cm </p>
        <p> <i>Naturalidade:</i><?php echo $person['naturality']?>  </p>
        <p> <i>Morada: </i><?php echo $person['adress']?>  </p>
        <p> <i>Descrição física:</i> <?php echo $person['physical_description']?> 
    </div>
</body>

<?php include_once('../common/footer.php'); ?>
</div>
</html>