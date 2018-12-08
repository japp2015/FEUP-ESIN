<?php
include_once('database/connection.php');
$user = getUserByUsername($username);
if (!isset($station)){
    $station=GetStationByID($user['station']);
}
?>

<!DOCTYPE html>
<html lang="en-US">
    <header>
        <a href="main.php"><h2>Polícia Nacional</h2></a>
    </header>
    <aside id="right_bar"> 
            <ul>
                <li><a href="log_out.php">Terminar Sessão</a></li> 
                <li><a href="updates.php">Atualizações</a></li> 
                <li><a href="notes.php">Notas</a></li>
                <?php if ($user['position']!="Diretor Nacional"){?>
                    <li><a> Nova Ocorrência</a></li>
                    <ul> 
                        <?php if ($user['position']!="Polícia"){?>
                            <li><a href="new_occurrence.php?relevance=2"> Delito Grave </a></li>
                        <?php } ?>
                            <li><a href="new_occurrence.php?relevance=1"> Delito Leve </a></li>
                    </ul>   
                <?php }?>
                <?php if ($user['position']=="Diretor Nacional" || $user['position']=="Chefe de Esquadra" ){?>
                    <li><a> Criar Colaborador </a></li> 
                        <ul>
                            <?php if ($user['position']=="Diretor Nacional"){?>
                                <li><a href="create_personnel.php?position=Chefe de Esquadra"> Chefe de Esquadra </a></li>
                            <?php } ?>
                                <li><a href="create_personnel.php?position=Detetive"> Detetive </a></li>
                                <li><a href="create_personnel.php?position=Polícia"> Polícia </a></li>
                        </ul>   
                <?php } ?>
                <?php if ($user['position']=="Diretor Nacional"){?>
                    <li><a href="view_station.php"> Esquadras Nacionais </a></li> 
                    <li><a href="create_station.php"> Criar Esquadra</a></li>
                <?php } ?>
                <?php if ($user['position']!="Diretor Nacional"){?>
                    <li><a href="station.php?station=<?=$station['id']?>">Esquadra</a></li>
                <?php } ?>
                <li><a href="search.php">Pesquisa</a></li>
            </ul>
    </aside>
</html>
