<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username=$_SESSION['username'];
$user = getUserByUsername($username);
if (isset($_GET['error'])){
    die($_GET['error']);    
}
if(!isset($_GET['position'])){
    die('Não autorizado');
}
$position=$_GET['position'];
if ($user['position']=='Polícia' || $user['position']=='Detetive' || ($position=='Chefe de Esquadra' && $user['position']=='Chefe de Esquadra')){
    die('Página não disponível para as atuais permissões');
 }
?>

<!DOCTYPE html> 
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Criar <?=$position?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>
        <form id="left" class="signup_content" action="../actions/action_personnel.php?position=<?=$position?>" method="post">
                <h1> Criar Novo <?=$position?>: </h1>
                <div> <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>"></div>
                <div> Username: <input type="text" placeholder="Username" name="username" required> </div>
                <div> Password: <input type="password" placeholder="Password" name="password" pattern=".{6,}" title="Pelo menos 8 caracteres" required> </div>
                <div> Confirme Password: <input type="password" placeholder="Confirme a password" pattern=".{6,}" title="Pelo menos 8 caracteres" name="confirmed_password" required> </div>
                <div> E-mail: <input type="email" placeholder="E-mail" name="email" required> </div>
                <div> Nome Completo: <input type="text" placeholder="Nome Completo" name="fullname" required> </div>
                <div> Género: 
                    <input type="radio" name="gender" value="Masculino" required> Masculino
                    <input type="radio" name="gender" value="Feminino"> Feminino
                </div>
                <div> Naturalidade: <input type="text" placeholder="Naturalidade" name="naturality" required> </div>
                <div> Data de Nascimento: <input type="date"  max="2000-12-31" min="1940-12-31" name="birthdate" required> </div>
                
                <div> Escola: 
                    <select name="school"> <?php $schools=GetAllSchools();
                    foreach ($schools as $school){?>
                        <option value= <?=$school['name']?>> <?= $school['name'] ?> </option>
                    <?php } ?>
                    </select>
                </div>
                
                <?php if ($user['position']=="Diretor Nacional"){?>
                <div> Atribuir uma esquadra: 
                    <select name="station"> <?php $stations=GetAllStations();
                    if ($position=="Chefe de Esquadra"){
                        foreach ($stations as $station){
                            if (!isset($station['chief'])){?>
                                <option value= <?=$station['id']?>> <?= $station['name'] ?> </option>
                            <?php }
                        }
                    }
                    else {
                        foreach ($stations as $station){?>
                            <option value= <?=$station['id']?>> <?= $station['name'] ?> </option>
                        <?php }
                    } ?>
                    </select> 
                </div>
                <?php }?>
                
                <div> <input type="submit" value="Adicionar"></div>
        </form>
    </body>

    <?php include_once('../common/footer.php'); ?>
</div>
</html>