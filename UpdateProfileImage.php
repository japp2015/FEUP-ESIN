<?php 
include_once('database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
?>

<!DOCTYPE html>
<title> Atualizar Foto Pessoal </title>

<body>
    <?php include_once('common/header_aside.php'); ?>
    <div class="image_container">
        <form class="edit_image" action="action_upload_profile_pic.php" method="post" enctype="multipart/form-data" >
        <h3>Atualizar Foto Pessoal</h3>
        <label>Selecionar ficheiro pretendido:</label>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label for="imageUpload" class="button here"> => Clique para escolher imagem <= </label>
            <p><input type="file" name="image" id="imageUpload" style="display: none"> </p>
            <p><input type="submit" value="Submeter Imagem"></p>
        </form>
    </div>

    
</body>

</html>