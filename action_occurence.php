 <?php
    include_once('database/connection.php');  
    session_start();
    $username = $_SESSION['username'];
    $user = getUserByUsername($username);
    $station = getUserStation($username);
    $station = $station['id'];
    $relevance= $_GET['relevance'];
    $occ_type=$_POST['occ_type'];
    $chief=$_POST['chief'];
    
    if ($user['position']=="Detetive"){
        $chief=$username;
    }

    $location=$_POST['location'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $state=$_POST['state'];
    $date=date("Y-m-d");

    if ($user['position']=="Diretor Nacional"){
        $station=$_POST['station'];
    }

    if ($relevance==1){
        AddOccurrence1($occ_type, $title, $state, $date, $location, $description, $station);
        $last_occurrence_id = $db->lastInsertId();
        AddWorksPersonnel($username,$last_occurrence_id );
        header('Location: main.php'); 

    } elseif ($relevance==2){
        AddOccurrence2($occ_type, $title, $chief, $state, $date, $location, $description, $station);
        header('Location: main.php'); 
    }
    
?>  