<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$notes = getNotesByUsername($username);
?>

<!DOCTYPE html>
<html>
<title><?php echo 'Notas ' . ' | ' . $user['fullname'] ?></title>

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
                    <div><input type="text" placeholder="Título da Nota" name="title"></div>
                    <div><input type="text" placeholder="Texto" name="note"></div>
                    <div><input type="submit" value="Adicionar"></div>
                </form>
        </section>
            
    </div>
  
</body>
</html>
