<?php 
    include_once('database/connection.php');    
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    $username = $_SESSION['username'];
    $user = getUserByUsername($username);
 
    $title=$type=$location=$state=$case_description=""; 
    if(!empty($_POST["title"])){
        $title = $_POST["title"];
    }   
    
    if(!empty($_POST["type"])){
        $type = $_POST["type"];
    } 

    if(!empty($_POST["case_description"])){
        $case_description = $_POST["case_description"];  
    }

    if(!empty($_POST["location"])){
        $location = $_POST["location"];  
    }

    if(!empty($_POST["state"])){
        $state = $_POST["state"];  
    }
    
    if ($user['position']=='Diretor Nacional'){
        $occurrences=SearchOccurrences($title, $type, $location, $state, $case_description);
    }elseif ($user['position']=='Chefe de Esquadra'){
        $occurrences=SearchOccurrencesByStation($user['station'],$title, $type, $location, $state, $case_description);
    }elseif ($user['position']=='Detetive'){
        $occurrences=SearchOccurrencesByUsernameAndMinorOccurrences($username,$user['station'],$title, $type, $location, $state, $case_description);
    }elseif ($user['position']=='Polícia'){
        $occurrences=SearchOccurrencesByUsername($username,$title, $type, $location, $state, $case_description );
    }
    
?>
<!DOCTYPE html>
<html>

<title> Pesquisa de Pessoas </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div class="search_results">

        <?php if (empty($occurrences) ) {
            echo  "Não foram encontrados resultados para a sua pesquisa.";
        } else{
            foreach($occurrences as $occurrence) { ?>
            <section>
            <?php echo "<li><a href='single_occurrence.php?id=" . $occurrence['id'] . "'>" . $occurrence['id'] . " | " . $occurrence['title'] . "</a></li>" ; ?> 
            </section>
            <? }
        } ?>
        
    </div>

</body>

<?php include_once('common/footer.php'); ?>
</html>