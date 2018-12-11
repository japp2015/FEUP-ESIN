<?php 
    include_once('database/connection.php');    
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    $username = $_SESSION['username'];
    $user = getUserByUsername($username);

    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die('Não autorizado');
    } 
  
    $search = $_POST['general_search'];

    $person = GeneralSearchPerson($search);
    $personnel = GeneralSearchPersonnel($search);
    $stations = GeneralSearchStation($search);   

    if ($user['position']=='Diretor Nacional'){
        $occurrences=GeneralSearchOccurrences($search);
    }elseif ($user['position']=='Chefe de Esquadra'){
        $occurrences=GeneralSearchOccurrencesByStation($user['station'], $search);
    }elseif ($user['position']=='Detetive'){
        $occurrences=GeneralSearchOccurrencesByUsernameAndMinorOccurrences($username, $user['station'], $search);
    }elseif ($user['position']=='Polícia'){
        $occurrences=GeneralSearchOccurrencesByUsername($username, $search);
    }

?>
<!DOCTYPE html>
<html>

<title> Pesquisa Geral </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div class="search_results">

        <?php if (empty($stations) && empty($personnel) && empty($occurrences) && empty($person)) {
            echo  "Não foram encontrados resultados para a sua pesquisa.";
        } else {
            if (!empty($stations)){?>
                <h3> Estações encontradas: </h3>
                <?php foreach($stations as $station) { ?>
                    <section>
                    <a href="station.php?station=<?=$station['id']?>"> <?=$station['name']?> </a> 
                    </section>
                <? }
            }
            if (!empty($occurrences)){ ?>
                <h3> Ocurrências encontradas: </h3>
                <?php foreach($occurrences as $occurrence) { ?>
                    <section>
                    <?php echo "<li><a href='single_occurrence.php?id=" . $occurrence['id'] . "'>" . $occurrence['id'] . " | " . $occurrence['title'] . "</a></li>" ; ?> 
                    </section>
                <? }
            }
            if (!empty($personnel)){ ?>
                <h3> Pessoal encontrado: </h3>
                <?php foreach($personnel as $personnel) { ?>
                    <section>
                    <?php echo "<p>" . $personnel['position'] . " " .$personnel['fullname'] . "</p>"; ?> 
                    </section>
                <? }
            } 
            if (!empty($person)){ ?>
                <h3> Pessoas encontrado: </h3>
                <?php foreach($person as $person) { ?>
                    <section>
                    <?php echo "<p>" . $person['name'] . "</p>"; #remeter para a pagina da pessoa quando estiver funcional ?>
                    </section>
                <? }
            }  
        } ?>

    </div>

</body>

<?php include_once('common/footer.php'); ?>
</html>