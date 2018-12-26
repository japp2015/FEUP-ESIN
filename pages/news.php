<?php 
    include_once('../database/connection.php');
    $id=$_GET["id"];
    $new=GetNewById($id);
    $missings = getMissingPeople();
?>
   
<!DOCTYPE html>
<html>
<head>
    <title>Notícias</title>
    <link href="../css/public_style.css" rel="stylesheet">
    <link href="../css/public_layout.css" rel="stylesheet">
</head>

<div class="news_container">

    <header class="header" id="news_header">
        <a href="public.php"><h2>Polícia Nacional</h2></a>
        <button type="log_in" onclick="location.href='log_in.php'">Entrar</button>
    </header>

    <body id="news_body">
        <div id="news_title">
            <?php echo "<h1>" . $new['title'] . "</h1>";
            echo "<h4>" . $new['date'] . "</h4>"; ?>
        </div>
        <div id="news_text">
            <?php echo "<p>" . $new['text'] . "</p>"; ?>
        </div>
        <?php if (isset($new['pic'])) { ?>
            <img src="../news_pic/<?=$new['pic']?>.jpg">
        <?php }?>
    </body>

</div>
<?php include_once('../common/footer.php'); ?>
</html>