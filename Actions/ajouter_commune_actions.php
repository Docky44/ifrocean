<?php
session_start();

//vérifier le token
$token=filter_input(INPUT_POST, "token");

if($token!=$_SESSION["token"]){
    die("On te voit");
}

//récupration des valeurs
$nom = filter_input(INPUT_POST, "nom");
$d = filter_input(INPUT_POST, "id_departement");
//var_dump($nom, $d);

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("insert into commune(nom, id_departement) values (:nom, :id_departement)");
$requete->bindParam(":nom", $nom);
$requete->bindParam(":id_departement", $d);
//var_dump($requete, $nom, $d);
$requete->execute();

header("location: ../modifier_commune.php");