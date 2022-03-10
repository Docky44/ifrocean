<?php
session_start();

//vérifier le token
$token=filter_input(INPUT_POST, "token");

if($token!=$_SESSION["token"]){
    die("On te voit");
}

//récupration des valeurs
$nom = filter_input(INPUT_POST, "nom");
$c = filter_input(INPUT_POST, "id_commune");
$estran = filter_input(INPUT_POST, "estran");

//var_dump($nom);

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("insert into plage(nom, id_commune, estran) values (:nom, :id_commune, :estran)");
$requete->bindParam(":nom", $nom);
$requete->bindParam(":id_commune", $c);
$requete->bindParam(":estran", $estran);

//var_dump($requete, $nom, $c);

$requete->execute();

header("location: ../modifier_plage.php");