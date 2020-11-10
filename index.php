<?php
$title = "Stuliday -- Home Page";
require 'includes/header.php';
require 'includes/navbar.php';


?>
    <section class="hero is-medium">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-8-desktop is-offset-2-desktop">
                        <h1 class="title is-2 is-spaced">
                            Welcome to Stuliday !
                        </h1>
                        <h2 class="subtitle is-4">
                            Come to discover our places to stay, or you can even add your own !
                        </h2>
                        <?php if (!empty($_SESSION)) { ?>
                            <a href="profile.php" class="button is-success">Go to your Profil</a>
                        <?php } else { ?>
                            <a href="signin.php" class="button is-success">Log in for book</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
require 'includes/footer.php';
