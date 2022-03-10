<?php
session_start();

//vérifier le token
$token=filter_input(INPUT_POST, "token");

if($token!=$_SESSION["token"]){
    die("On te voit");
}

//récupration des valeurs
$nom = filter_input(INPUT_POST, "nom");
$id = filter_input(INPUT_POST, "id");

//var_dump($nom, $id);

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("UPDATE departement SET nom = :nom where(departement.id = :id)");
$requete->bindParam(":nom", $nom);
$requete->bindParam(":id", $id);

$requete->execute();

header("location: ../modifier_departement.php");