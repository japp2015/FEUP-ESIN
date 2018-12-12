<?php 
include_once('database/connection.php');
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
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('common/header_aside.php'); ?>

<body>
    <div id="Notes">
    <h1> Notas de <?php echo $user['position'] . ' '. $user['fullname'] ?> </h1>
    <section class="view_notes">
            <?php foreach ($notes as $note) { ?>
                <h3 class="title"> <?=$note['title']?> </h3>
                <p class="text"> <?=$note['text']?> </p>
                <button type="button" class="delete" onclick="location.href='delete_note.php?id_note=<?=$note['id']?>';">Eliminar Nota</button>
            <?php } ?>
        </section>

        <section class = "add_notes">
            <h2> Adicionar Nova Nota: </h2>
                <form action="action_notes.php" method="post">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <div><input type="text" placeholder="Título da Nota" name="title"></div> <br>
                    <div><textarea rows="4" cols="50" name="note" placeholder="Texto da Nota..." > </textarea></div>
                    <div><input type="submit" value="Adicionar"></div>
                </form>
        </section>
            
    </div>
</body>
<?php include_once('common/footer.php'); ?>
</div>
</html>
