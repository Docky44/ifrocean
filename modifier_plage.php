<?php
//pour pouvoir utiliser les sessions
session_start();
//token anti forgery (ou anti faille CSRF)
$token=uniqid();
//je le stocke en session
$_SESSION["token"]=$token;

require_once "config.php";
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);

$requete = $pdo->prepare("select * from plage");
$requete->execute();
$lignes = $requete-> fetchAll();

//var_dump($lignes);

$title="Modifier Plage";
require_once "header.php";
require_once "navbar_admin.php";
?>



    <div class="container">

        <h1>Modifier les Secteur d'activité</h1>

        <div>
            <table class="table">
                <thead>
                <th>Secteur plage</th>
                <th>Renomer la plage</th>
                <th></th>
                </thead>
                <tbody>
                <?php foreach($lignes as $l){ ?>
                    <tr>
                        <td><?php echo $l["nom"] ?></td>
                        <td>
                            <form action="Actions/renommer_secteur_actions.php" method="post">
                                <input type="hidden" value="<?php echo $token ?>" name="token" id="token">
                                <input type="hidden" value="<?php echo $l["id"] ?>" name="id" id="id">
                                <input type="text" id="nom" name="nom" required>
                                <input type="submit" class="btn btn-primary" value="Modifier" >
                            </form>
                        </td>
                        <td>
                            <a href="Actions/supprimer_plage_actions.php?id=<?php echo $l["id"] ?>" class="btn btn-primary">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <section id="home-form">
        <br><br><br>

        <div id="form">
            <h2>Ajouter une plage</h2>
            <form action="Actions/ajouter_plage_actions.php" method="post">
                <input type="hidden" value="<?php echo $token ?>" name="token" id="token">
                <div class="form-group">
                    <label for="nom">Entrer le Nom de la plage :<em class="required"></em></label>
                    <input type="text" id="nom" name="nom" class="form-control" required>
                </div>
                <br>
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
        </section>
    </div>




<?php
require_once "footer.php";