 <?php
    include_once('database/connection.php');  
    session_start();
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die("Não autorizado.");
    }
    $username = $_SESSION['username'];
    $user = getUserByUsername($username);
    $station = getUserStation($username);
    $station = $station['id'];
    $relevance= $_GET['relevance'];
    $occ_type=$_POST['occ_type'];
    $chief=$_POST['chief'];

    $missing=$_GET['missing'];
    if ($missing!==-1) {
        DeleteMissingPersonById($missing);
    }

    if ($user['position']=="Detetive"){
        $chief=$username;
    }

    $location=$_POST['location'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $state=$_POST['state'];
    $date=date("Y-m-d");

    $victim_nif=$_POST['victim_nif'];
    $victim_name=$_POST['victim_name'];
    $victim_gender=$_POST['victim_gender'];
    $victim_birthdate=$_POST['victim_birthdate'];
    $victim_naturality=$_POST['victim_naturality'];
    $victim_adress=$_POST['victim_adress'];
    $victim_description=$_POST['victim_description'];
    $victim_height=$_POST['victim_height'];
    $victim_weight=$_POST['victim_weight'];
    $type="Vítima";

    AddPerson($victim_nif, $victim_name, $victim_gender, $victim_birthdate, $victim_naturality, $victim_adress, $victim_description, $victim_height, $victim_weight);
    UploadPersonPicture($victim_nif, $victim_nif);
    $FileName = "person_pic/$victim_nif.jpg";
    // Move the uploaded file to its final destination
    move_uploaded_file($_FILES['image']['tmp_name'], $FileName);

    if ($relevance==1){
        AddOccurrence1($occ_type, $title, $state, $date, $location, $description, $station);
        $last_occurrence_id = $db->lastInsertId();
        AddWorksPersonnel($username,$last_occurrence_id );
        AddReference($victim_nif, $last_occurrence_id, $type);


    } elseif ($relevance==2){
        AddOccurrence2($occ_type, $title, $chief, $state, $date, $location, $description, $station);
        $last_occurrence_id = $db->lastInsertId();
        AddReference($victim_nif, $last_occurrence_id, $type);
    }


    header('Location: main.php'); 
?>  