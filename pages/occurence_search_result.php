<?php 
    include_once('../database/connection.php');    
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    $username = $_SESSION['username'];
    $user = getUserByUsername($username);
 
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die('Não autorizado');
    } 

    $title = $_POST["title"];
    $type = $_POST["type"];
    $case_description = $_POST["case_description"];  
    $location = $_POST["location"];  
    $state = $_POST["state"];  
    
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

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Ocurrências Encontradas </title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div class="search_results">
    <h1> Ocurrências Encontradas: </h1>
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

<?php include_once('../common/footer.php'); ?>
</div>
</html>