<?php 
include_once('database/connection.php');
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
        <?php if(isset($guiltys)) {?>
            <p>Culpados:</p>
            <?php foreach ($guiltys as $guilty) {?>
                <a href="person.php?nif=<?=$guilty['nif']?>"><?echo $guilty['name'];?></a>
            <?}
        }?>
    </div>

    <div id="new_guilty">
        <?php if ($username==$occurrence['chief_detective']){?>
            <button type="button" onclick="location.href='single_occurrence.php?id=<?=$id?>&guilty=1'"> Atribuir culpado </button>
        <?php }
        if(isset($_GET['guilty'])){?>
            <h3>Adicionar culpado:</h3>
            <h4>Pessoa no sistema:</h4>
            <form action="guilty.php?id=<?=$id?>&known=1" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                NIF:<input type="number" name="nif"><br>
            </form>
            <h4>Pessoa nova:</h4>
            <form action="guilty.php?id=<?=$id?>" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                NIF:<input type="number" name="nif"><br>
                Nome:<input type="text" name="name"><br>
                <label>Sexo:</label>
                <label><input type="radio" name="gender" value="Masculino">Masculino</label>
                <label><input type="radio" name="gender" value="Feminino">Feminino</label><br>
                Data de nascimento:<input type="date" name="birthdate"><br>
                Naturalidade:<input type="text" name="naturality"><br>
                Morada:<input type="text" name="adress"><br>
                <textarea rows="4" cols="50" name="description"  placeholder="Descrição física"></textarea><br>
                Altura(cm):<input type="number" name="victim_height"><br>
                Peso(kg):<input type="number" name="victim_weight"><br>
                <input type="submit" value="Atribuir">
            </form>
        <? } ?>
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

    <?php if(isset($victims)) {?>
        <div id="victims"> Vítimas:
        <?php foreach ($victims as $victim) {?>
            <a href="person.php?nif=<?=$victim['nif']?>"><?echo $victim['name'];?></a>
        <?}
    }?>

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

    <?php if ($user['position']!="Diretor Nacional" && $user['position']!="Chefe de Esquadra" ){?>
    <div id = "add_update">
        <p> Nova Atualização: </p>
        <form action="action_update.php?id_occurrence=<?=$id?>" method="post">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <div><input type="text" placeholder="Título" name="title"></div>
            <textarea name="text" cols="40" rows="5" placeholder="Atualização"></textarea>
            <div><input type="submit" value="Submeter"></div>
        </form>
    </div>
    <?php } ?>

</body>

<?php include_once('common/footer.php'); ?>
</html>