<?php
//pour pouvoir utiliser les sessions
session_start();
//token anti forgery (ou anti faille CSRF)
$token=uniqid();
//je le stocke en session
$_SESSION["token"]=$token;

$title="Acueil - IFROCEAN";
require_once "header.php";
$err = filter_input(INPUT_GET, "err");
?>
<body>
<header id="header">
    <div class="site-brand">
        <a href="index.php"> <img id="site-logo" width="640" height="413" src="photo/Ifrocean.png"
                                   alt="Logo ifrocéan"></a>
        <span>IFROCEAN</span>
    </div>
    <nav class="navbar">
        <ul>
            <li>
                <a href="index.php">Accueil</a>
            </li>
            <li>
                <a href="connexion.php">Connexion admin</a>
            </li>
        </ul>
    </nav>
</header>
<main>
    <section id="home_hero">
        <div class="container">
            <h1>Bienvenue sur le site d'iffrocéan</h1>
            <p id="presentation">Nous sommes une entreprise qui recense des espèces de la zone intertidale du littoral Nord-Ouest de la
                France sur les plages de sables. <br>
                <br>Le réchauffement climatique rapide auquel sont exposées les espèces du littoral atlantique impacte
                fortement leur distribution.
                <br>Le but de cette étude est de recenser et quantifier les populations animales présentes sur l’estran
                des grandes plages de sable du littoral nord-ouest de la côte atlantique française. Cette étude se
                concentrera sur les annélides.</p>
        </div>
    </section>
</main>


<?php
require_once "footer.php";

?>
