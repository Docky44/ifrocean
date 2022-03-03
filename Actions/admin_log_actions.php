<?php
session_start();

//vérifier le token
$token = filter_input(INPUT_POST, "token");

if ($token != $_SESSION["token"]) {
    die("On te voit");
}

//récupration des valeurs
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$err = filter_input(INPUT_POST, "err");

require_once "../config.php";
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
$requete = $pdo->prepare("select id from admin where login = :email AND mdp = :password");
$requete->bindParam(":email", $email);
$requete->bindParam(":password", $password);
$requete->execute();
$result = $requete-> fetch();

//var_dump($email, $password, $result);

if ($result != False){
    header("location: ../visualiser_formulaires.php");
} elseif ($err == 5){
    die("C'est bon tu a fini de faire mumuse");
} else {
    $err ++;
    header("location: ../connexion.php?err=$err");
}