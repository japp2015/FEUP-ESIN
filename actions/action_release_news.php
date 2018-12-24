<?php
    include_once('../database/connection.php');
    session_start();

    $title=$_POST['title'];
    $text=$_POST['text'];
    $date=date("Y-m-d");

    AddNews($title, $text, $date);
    $last_news_id = $db->lastInsertId();
    UploadNewsPicture($last_news_id, $last_news_id);
    $FileName = "../news_pic/$last_news_id.jpg";
    // Move the uploaded file to its final destination
    move_uploaded_file($_FILES['image']['tmp_name'], $FileName);
    header('Location: ../pages/main.php');

?>