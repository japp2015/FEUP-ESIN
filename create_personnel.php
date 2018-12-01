<?php 
include_once('database/connection.php');
session_start();
$username=$_SESSION['username'];
$position=$_GET['position'];
?>

<!DOCTYPE html>
<html>
<title> Criar <?=$position?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <section class="new_personnel"> 
        <p> Criar Novo <?=$position?>: </p>
        <form action="action_personnel.php?position=<?=$position?>" method="post">
            <div> Username: <input type="text" placeholder="Username" name="username"> </div>
            <div> Password: <input type="password" placeholder="Password" name="password"> </div>
            <div> Confirme Password: <input type="password" placeholder="Confirme password" name="confirmed_password"> </div>
            <div> E-mail: <input type="email" placeholder="E-mail" name="email"> </div>
            <div> Nome Completo: <input type="text" placeholder="Nome Completo" name="fullname"> </div>
            <div> Género: <input type="text" placeholder="Género" name="gender"> </div>
            <div> Naturalidade: <input type="text" placeholder="Naturalidade" name="naturality"> </div>
            <div> Data de Nascimento: <input type="date"  max="2000-12-31" min="1940-12-31" name="birthdate"> </div>
            
            <div> Escola: <select name="school"> <?php $schools=GetAllSchools();
                foreach ($schools as $school){?>
                    <option value= <?=$school['name']?>> <?= $school['name'] ?> </option>
                <?php } ?>
            </select> </div>
            
            <div> Atribuir uma esquadra: <select name="station"> <?php $stations=GetAllStations();
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
            </select> </div>
            
                <div> <input type="submit" value="Adicionar"></div>
            </form>
    </section>
</body>
</html>