<?php 
include_once('database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);

if ($user['position']=='Diretor Nacional'){
    $updates=GetAllUpdates();
}elseif ($user['position']=='Chefe de Esquadra'){
    $updates=GetUpdatesByStation($user['station']);
}elseif ($user['position']=='Detetive'){
    $updates=GetUpdatesByUsernameAndMinorOccurrences($username,$user['station']);
}elseif ($user['position']=='Polícia'){
    $updates=GetUpdatesByUsername($username);
}
?>

<!DOCTYPE html>
<html>
<title><?php echo 'Atualizações' ?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div id="Updates">
    <?php foreach ($updates as $update) { 
        $occurrence=getOccurrenceById($update['id_occurrence'])?>
        <h2> Atualização à ocorrência: <?php echo $update['id_occurrence'] . ' | '. $occurrence['title'] ?> </h2>
            <h3 class="title"> <?=$update['title']?> </h3>
            <p class="text"> <?=$update['text']?> </p>
            <?php $author=getUserByUsername($update['username_personnel']);?>
                <p class="author"><?=$author['position']." ".$author['fullname']?> </p>
    <?php } ?>
    </div>
  
</body>
</html>
