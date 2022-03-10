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


$commune = $pdo->prepare("select * from commune");
    $commune->execute();



//var_dump($lignes);

$title="Modifier plage";
require_once "header.php";
require_once "navbar_admin.php";
?>



    <div class="container">

        <h1>Modifier les communes</h1>

        <div>
            <table class="table">
                <thead>
                <th>Plage</th>
                <th>Renomer les plages</th>
                <th></th>
                </thead>
                <tbody>
                <?php foreach($lignes as $l){ ?>
                    <tr>
                        <td><?php echo $l["nom"] ?></td>
                        <td>
                            <form action="Actions/renommer_plage_actions.php" method="post">
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
                    <br>
                    <div class="form-group">
                        <label for="estran">Entrer l'estran maximum :<em class="required"></em></label>
                        <input type="number" id="estran" name="estran" min="1" step="5" value="1" class="form-control" required>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="id_commune">Sellectionner la commune de la plage</label>
                        <select name="id_commune" id="id_commune" class="form-control">
                            <option selected disabled>Faites un choix</option>
                            <?php foreach($commune as $c){?>
                                <option value="<?php echo $c['id']?>"> <?php echo $c['nom']?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </section>
    </div>




<?php
require_once "footer.php";