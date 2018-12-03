<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$id = $_GET['id'];
$occurrence = getOccurrenceById($id);
$updates= getUpdatesByOccurrenceId($id);
$chief=getUserByUsername($occurrence['chief_detective'])
?>

<!DOCTYPE html>
<html>
<title><?php echo $occurrence['id'] . ' | ' . $occurrence['title'] ?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
<div id="occurence">
    <div id='id'> <h1> <?php echo $occurrence['title'] ?></h1></div>
    <div id='title'> <h3> Tipo de Ocorrência: <?php echo $occurrence['type'] ?></h3></div>
    <div id='description'> Descrição da Ocurrência: <p> <?php echo $occurrence['description'] ?></p></div>
    <?php if (isset($occurrence['chief_detective'])){
       $chief=getUserByUsername($occurrence['chief_detective'])?>
       <div id='chief'> <p> Detetive Chefe: <?php echo $chief['fullname'] ?></p></div>
    <?php } ?>

    <div id='state'> <p> Estado: <?php echo $occurrence['state'] ?></p>
        <?php if ($username==$occurrence['chief_detective']){?>
            <button type="button" onclick="location.href='single_occurrence.php?id=<?=$id?>&change=<?=$occurrence['state']?>'"> Mudar o Estado da Ocorrencia </button>
        <?php }
        if(isset($_GET['change'])){?>
            <form action="change_state.php?id=<?=$id?>" method=post>
                <p><select name="change_state">
                <?php $states=GetStates();
                    foreach ($states as $state){
                        if ($state['name']!=$_GET['change']){?>
                            <option value=<?=$state['name']?>> <?= $state['name'] ?> </option>
                        <?php } 
                     } ?> 
                </select></p>
                <p> <input type="submit" value="Atualizar"></p>
            </form>
        <?php } ?>
    </div>

    <div id='location'> <p> Localização: <?php echo $occurrence['location'] ?></p></div>
    
    <div id='polices'> Polícias Alocados:
        <ul>
        <?php $polices=GetOccurrencePersonnel($occurrence['id']);
        foreach ($polices as $police){
            echo "<li> " . $police['fullname'] . "</li>";
        }?>
        </ul>
        <?php if  ($occurrence['state'] =="Aberto"){
            if ($user['position']!="Police"){?>
                <button type="button" onclick="location.href='add_police.php?occurrence_id=<?=$occurrence['id']?>'"> Alocar polícia à Investigação </button>
            <?php }
        }?>
    </div>

    <div id="updates">
        <p> Atualizações: </p>
        <?php foreach ($updates as $update) { ?>
            <span class="user"><?=getUserByUsername($update['username_personnel'])['fullname']?></span>
            <p class="title"> <?=$update['title']?> </p>
            <p class="text"> <?=$update['text']?> </p>
            <p class="date_hour"> <?=$update['date_hour']?> </p>
        <?php } ?>
    </div>

    <div id = "add_update">
        <p> Nova Atualização: </p>
        <form action="action_update.php?id_occurrence=<?=$id?>" method="post">
            <div><input type="text" placeholder="Título" name="title"></div>
            <div><input type="text" placeholder="Atualização" name="text"></div>
            <div><input type="submit" value="Submeter"></div>
        </form>
    </div>

</body>

</html>