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
    <link href="../css/layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div id="personal_info">
        <h1><?php echo $person['name']?></h1>
        <?php if (isset($person['profile_pic'])) { ?>
            <img src="../person_pic/<?=$person['profile_pic']?>.jpg">
        <?php }?>
        <p> Sexo: <?php echo $person['gender']?> </p>
        <p> Data de nascimento: <?php echo $person['birthdate']?>  </p>
        <p> Peso: <?php echo $person['weight']?>  kg </p>
        <p> Altura: <?php echo $person['height']?>  cm </p>
        <p> Naturalidade: <?php echo $person['naturality']?>  </p>
        <p> Morada: <?php echo $person['adress']?>  </p>
        <p> Descrição física: <?php echo $person['physical_description']?> 
    </div>
</body>

<?php include_once('../common/footer.php'); ?>
</div>
</html>