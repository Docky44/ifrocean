<?php
//récupration des valeurs
$id = filter_input(INPUT_GET, "id");

//var_dump($id);

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("delete from commune where(id = :id)");
$requete->bindParam(":id", $id);

$requete->execute();

header("location: ../modifier_commune.php");