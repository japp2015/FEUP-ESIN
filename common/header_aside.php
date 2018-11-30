<?php 
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$station=GetStationByID($user['station']);
?>

<!DOCTYPE html>
<html lang="en-US">
    <header>
        <a href="main.php"><h2>Polícia Nacional</h2></a>
    </header>
    <aside id="right_bar">
            <ul>
                <li><a href="log_out.php">Terminar Sessão</a></li> 
                <li><a href="news.php">Atualizações</a></li> 
                <li><a href="notes.php">Notas</a></li>
                <li><a href="new_occurence.php">Nova Ocorrência</a></li>
                <li><a href="occurences.php">Ocorrência</a></li>
                <?php if ($user['position']!="Diretor Nacional"){?>
                    <li><a href="station.php?station=<?=$station['id']?>">Esquadra</a></li>
                <?php } ?>
                <li><a href="search.php">Pesquisa</a></li>
            </ul>
    </aside>
</html>