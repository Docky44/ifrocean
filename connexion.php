<?php
//pour pouvoir utiliser les sessions
session_start();
//token anti forgery (ou anti faille CSRF)
$token = uniqid();
//je le stocke en session
$_SESSION["token"] = $token;

$title = "Connexion - Raminagrobis";
require_once "header.php";
$err = filter_input(INPUT_GET, "err");
?>
    <header id="header">
        <div class="site-brand">
            <a href="index.html"> <img id="site-logo" width="640" height="413" src="photo/Ifrocean.png"
                                       alt="Logo ifrocéan"></a>
            <span>IFROCEAN</span>
        </div>
        <nav class="navbar">
            <ul>
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="connexion_user.php">Connexion élève</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="home-form">
            <div class="container">
                <h2>Connexion administrateur</h2>

                <form method="post" action="Actions/admin_log_actions.php">
                    <input type="hidden" name="err" id="err" value="<?php echo $err ?>">
                    <input type="hidden" name="token" id="token" value="<?php echo $token ?>">
                    <div class="form-group col-md-6">
                        <label for="email">Login :</label>
                        <input type="text" class="form_control" id="email" name="email" placeholder="exemple@mail.com"
                               required>
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                        <label for="password">Mot de passe :</label>
                        <input type="password" class="form_control" id="password" name="password" placeholder="password"
                               required>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </section>
    </main>


<?php
require_once "footer.php";

?>