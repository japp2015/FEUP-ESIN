<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$notes = getNotesByUsername($username);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo 'Notas ' . ' | ' . $user['fullname'] ?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>
        <div id="left">
            <h1> Notas Atuais </h1>
                <?php foreach ($notes as $note) { ?>
                    <div id="notes">
                        <h3 class="title"> <?=$note['title']?> </h3>                            
                        <p class="text"> <?=$note['text']?> </p>
                        <button type="button" class="delete" onclick="location.href='../actions/delete_note.php?id_note=<?=$note['id']?>';">Eliminar Nota</button>
                    </div>
                <?php } ?>
        </div>
        <div id = "right">
                <h1> Adicionar Nova Nota: </h1>
                    <form action="../actions/action_notes.php" method="post">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                        <input type="text" placeholder="Título da Nota" name="title"> <br>
                        <textarea rows="4" cols="30" name="note" placeholder="Texto da Nota..." > </textarea>
                        <input type="submit" value="Adicionar"></div>
                    </form>
        </div>   
    </body>
    <?php include_once('../common/footer.php'); ?>
</div>
</html>
