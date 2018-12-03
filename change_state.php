<?php
    include_once('database/connection.php');  
          
    $state=$_POST['change_state'];
    $occurrence=$_GET['id'];
    UpdateState($state,$occurrence);
    header('Location: single_occurrence.php?id=' . $occurrence); 
    