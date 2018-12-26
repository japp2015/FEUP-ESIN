<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
} 
$username = $_SESSION['username'];
$user = getUserByUsername($username);

if (!isset($_GET['id'])){
    die("Não Autorizado");
}
$id = $_GET['id'];

$validation=false;
if ($user['position']=='Diretor Nacional'){
    $user_occurrences=GetAllOccurrences();
    foreach ($user_occurrences as $user_occurrence){
        if ($id==$user_occurrence['id']){
            $validation=true;
        }
    }
}
elseif($user['position']=='Chefe de Esquadra'){
    $user_occurrences=GetOccurrencesByStation($user['station']);
    foreach ($user_occurrences as $user_occurrence){
        if ($id==$user_occurrence['id']){
            $validation=true;
        }
    }
}elseif ($user['position']=='Detetive'){
    $user_occurrences=GetOccurrencesByUsernameAndMinorOccurrences($username,$user['station']);
    foreach ($user_occurrences as $user_occurrence){
        if ($id==$user_occurrence['id']){
            $validation=true;
        }
    }
}elseif ($user['position']=='Polícia'){
    $user_occurrences=GetOccurrencesByUsername($username);
    foreach ($user_occurrences as $user_occurrence){
        if ($id==$user_occurrence['id']){
            $validation=true;
        }
    }
}
if ($validation==false){
    die("Não autorizado");
}

$occurrence = getOccurrenceById($id);
$occurrence_type=getOcc_TypeById($occurrence['type']);
$updates= getUpdatesByOccurrenceId($id);
$chief=getUserByUsername($occurrence['chief_detective']);
$victims=GetVictimsByOccurrence($id);
$guiltys=GetGuiltysByOccurrence($id);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $occurrence['id'] . ' | ' . $occurrence['title'] ?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_occ.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div id="left">
        <div id='title'> <h1> <?php echo $occurrence['title'] ?></h1></div>
        
        <?php if ($user['position']=="Chefe de Esquadra"){?>
            <button id= "occ_button" type="button" onclick="location.href='news_release.php?id=<?=$id?>'"> Libertar notícia </button>
        <? } ?>
        
        <div id='type'> <p> <i> Tipo de Ocorrência: </i> <?php echo $occurrence_type['name'] ?></p></div>
        
        <div id='description'> <p> <i>  Descrição da Ocorrência </i>  <br> <?php echo $occurrence['description'] ?></p></div>
        
        <?php if (isset($occurrence['chief_detective'])){
        $chief=getUserByUsername($occurrence['chief_detective'])?>
        <div id='chief'> <p> <i> Detetive Chefe:</i> <?php echo $chief['fullname'] ?></p></div>
        <?php } ?>

        <div id='state'> <p> <i> Estado:</i> <?php echo $occurrence['state'] ?></p>
            <?php if ($username==$occurrence['chief_detective']){?>
                <button id= "occ_button" type="button" onclick="location.href='single_occurrence.php?id=<?=$id?>&change=<?=$occurrence['state']?>'"> Mudar o Estado da Ocorrencia </button>
            <?php }
            if(isset($_GET['change'])){?>
                <form action="../actions/action_change_state.php?id=<?=$id?>" method=post>
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
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

        <div id="guilty">
            <?php if(!empty($guiltys)) {?>
                <p><i>Culpado(s):</i></p>
                <?php foreach ($guiltys as $guilty) {?>
                    <a href="person.php?nif=<?=$guilty['nif']?>"><?echo $guilty['name'];?></a>
                <?}
            }?>
        </div>

        <div id="new_guilty">
                <?php if  ($occurrence['state'] =="Aberto"){
                    if ($username==$occurrence['chief_detective']){?>
                        <button id= "occ_button" type="button" onclick="location.href='add_guilty.php?occurrence_id=<?=$id?>'"> Atribuir culpado </button>
                    <?php }
                }?>
        </div>

        <?php if(!empty($victims)) {?>
            <div id="victims"><p> <i> Vítima(s):</i> 
            <?php foreach ($victims as $victim) {?>
                <a href="person.php?nif=<?=$victim['nif']?>"><?echo $victim['name'];?></a>
            <?}?>
            <p> </div>
        <?}?>

        <div id='location'> <p> <i> Localização: </i> <?php echo $occurrence['location'] ?></p></div>
    </div>

    <div id="right">
        <h1> Pessoal Alocado </h1>
        <div id="all_personnel">
            <?php $personnels=GetOccurrencePersonnel($occurrence['id'])?>

            <?php if ($occurrence_type['relevance']==2){?>
                <div id='detectives'> <p> <i>Detetives Alocados:</i> </p>
                <?php $position="Detetive"?>
                <ul>
                <?php foreach ($personnels as $personnel){
                    if ($personnel['position']==$position){
                        echo "<li> <p> " . $personnel['fullname'] . " </p> </li>";
                    }
                }?>
                </ul>
                <?php if  ($occurrence['state'] =="Aberto"){
                    if ($user['position']!="Polícia"){?>
                        <button id= "occ_button" type="button" onclick="location.href='add_personnel.php?occurrence_id=<?=$occurrence['id']?>&type=<?=$position?>'"> Alocar detetive à Investigação </button>
                    <?php }
                }?> </div>
            <?}?>


            <div id='polices'> <p> <i>Polícias Alocados:</i> </p>
                <?php $position="Polícia"?>
                <ul>
                <?php foreach ($personnels as $personnel){
                    if ($personnel['position']=="Polícia"){
                        echo "<li> <p>" . $personnel['fullname'] . " </p> </li>";
                    }
                }?>
                </ul>
                <?php if  ($occurrence['state'] =="Aberto"){
                    if ($user['position']!="Polícia" || $occurrence_type['relevance']==1){?>
                        <button id= "occ_button" type="button" onclick="location.href='add_personnel.php?occurrence_id=<?=$occurrence['id']?>&type=<?=$position?>'"> Alocar polícia à Investigação </button>
                    <?php }
                }?>
            </div>
        </div>
    </div>

    <div id=occ_updates>
        <div id="updates">
            <h1> Atualizações: </h1>
            <?php foreach ($updates as $update) { ?>
                <div id="single_update">
                    <p class="update_title"> <?=$update['title']?> </p>
                    <p class="update_text"> <?=$update['text']?> </p>
                    <p class="update_date_hour_user">  <span ><?=getUserByUsername($update['username_personnel'])['position']." ". getUserByUsername($update['username_personnel'])['fullname']?></span> <?=$update['date_hour']?></p>
                    <?php if ($update['username_personnel']==$username){?>
                        <button id= "occ_button" type="button" class="delete" onclick="location.href='../actions/delete_update.php?id=<?=$id?>&id_update=<?=$update['id']?>';">Eliminar Atualização</button>
                    <?php } ?>
                </div>
            <?}?>
        </div>

        <?php if ($user['position']!="Diretor Nacional" && $user['position']!="Chefe de Esquadra" ){?>
        <div id = "add_update">
            <h1> Nova Atualização: </h1>
            <form action="../actions/action_update.php?id_occurrence=<?=$id?>" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <div><input type="text" placeholder="Título" name="title"></div>
                <textarea name="text" cols="40" rows="5" placeholder="Atualização"></textarea>
                <div><input type="submit" value="Submeter"></div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>

<?php include_once('../common/footer.php'); ?>

</html>