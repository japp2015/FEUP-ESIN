<?php
    include_once('database/connection.php');
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    if(!isset($_GET["id"])){
        die("Não autorizado");
    }
    $id=$_GET["id"];
    $occurrence=getOccurrenceById($id);
?>

<!DOCTYPE html>
<html>
<title><?php echo $occurrence['id'] . ' | ' . $occurrence['title'] ?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
<div id="title">
    <?php echo "<h1>Libertar notícia da ocorrência " . $occurrence['id'] . ' - ' . $occurrence['title'] . "</h1>"; ?>
    <form id=release_news action="release_news_action.php" method="post">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <input type="text" placeholder="Título" name="title">
        <div class="image_container">
        <form class="edit_image" action="news_img_upload.php" method="post" enctype="multipart/form-data">
            <label>Escolha uma imagem</label>
            <input type="file" name="image">
            <input type="submit" value="Inserir">
        </form>
        </div>
        <textarea name="text" cols="65" rows="8" placeholder="Texto da notícia"></textarea><br>
        <input type="submit" value="Libertar">
    </form>