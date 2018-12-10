<?php 
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
?>

<!-- PÁGINA GERAL DE PESSOA -->
<!DOCTYPE html>
<html>
<title>André Maria Ferreira</title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div id="personal_info">
        <h1>José Maria Ferreira</h1>
        <img src="http://lorempixel.com/600/300/business/" alt="photo">
        <p> Sexo: Masculino </p>
        <p> Data de nascimento: 12/05/1987 </p>
        <p> Peso: 75 kg </p>
        <p> Altura: 175 cm </p>
        <p> Naturalidade: Porto, Portugal </p>
        <p> Morada: Rua Areosa, Porto </p>
        <p> Descrição física: Caucasiano; Cabelo castanho; Olhos verdes
    </div>
    <div id="references">
        <h3>Referências</h3>
        <ul>
            <li><a href="10201.php">10201</a><p>Homicídio</p></li> 
            <p>Posição: Testemunha</p>
            <li><a href="10201.php">10201</a><p>Furto</p></li>
            <p>Posição: Vítima</p>
            <li><a href="10200.php">10200</a><p>Desaparecimento</p></li></li>
            <p>Posição: Queixoso</p>
        </ul>
    </div>

</body>

<?php include_once('common/footer.php'); ?>
</html>