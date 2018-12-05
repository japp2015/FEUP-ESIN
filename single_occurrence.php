<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$id = $_GET['id'];
$occurrence = getOccurrenceById($id);
$occurrence_type=getOcc_TypeById($occurrence['type']);
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
    
    <button type="button" onclick="location.href='news_release.php?id=<?=$id?>'"> Libertar notícia </button>
    
    <div id='title'> <h3> Tipo de Ocorrência: <?php echo $occurrence_type['name'] ?></h3></div>
    
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
    
    <?php $personnels=GetOccurrencePersonnel($occurrence['id'])?>

    <?php if ($occurrence_type['relevance']==2){?>
        <div id='detectives'> Detetives Alocados:
        <?php $position="Detetive"?>
        <ul>
        <?php foreach ($personnels as $personnel){
            if ($personnel['position']==$position){
                 echo "<li> " . $personnel['fullname'] . "</li>";
            }
        }?>
        </ul>
        <?php if  ($occurrence['state'] =="Aberto"){
            if ($user['position']!="Polícia"){?>
                <button type="button" onclick="location.href='add_personnel.php?occurrence_id=<?=$occurrence['id']?>&type=<?=$position?>'"> Alocar detetive à Investigação </button>
            <?php }
        }?> </div>
    <?}?>


    <div id='polices'> Polícias Alocados:
        <?php $position="Polícia"?>
        <ul>
        <?php foreach ($personnels as $personnel){
            if ($personnel['position']=="Polícia"){
                 echo "<li> " . $personnel['fullname'] . "</li>";
            }
        }?>
        </ul>
        <?php if  ($occurrence['state'] =="Aberto"){
            if ($user['position']!="Polícia" || $occurrence_type['relevance']==1){?>
                <button type="button" onclick="location.href='add_personnel.php?occurrence_id=<?=$occurrence['id']?>&type=<?=$position?>'"> Alocar polícia à Investigação </button>
            <?php }
        }?>
    </div>

    <div id="updates">
        <p> Atualizações: </p>
        <?php foreach ($updates as $update) { ?>
            <span class="user"><?=getUserByUsername($update['username_personnel'])['position']." ". getUserByUsername($update['username_personnel'])['fullname']?></span>
            <p class="title"> <?=$update['title']?> </p>
            <p class="text"> <?=$update['text']?> </p>
            <p class="date_hour"> <?=$update['date_hour']?> </p>
            <?php if ($update['username_personnel']==$username){?>
                <button type="button" class="delete" onclick="location.href='delete_update.php?id=<?=$id?>&id_update=<?=$update['id']?>';">Eliminar Atualização</button>
            <?php } 
        }?>
    </div>

    <div id = "add_update">
        <p> Nova Atualização: </p>
        <form action="action_update.php?id_occurrence=<?=$id?>" method="post">
            <div><input type="text" placeholder="Título" name="title"></div>
            <textarea name="text" cols="40" rows="5" placeholder="Atualização"></textarea>
            <div><input type="submit" value="Submeter"></div>
        </form>
    </div>

</body>

</html>