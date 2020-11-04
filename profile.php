<?php
require 'includes/header.php';
require 'includes/navbar.php';
?>

<div class="container">
    <div class="columns">
        <div class="column">
            <div class="card p-2">
                <h2 class="title has-text-centered">Mon profil</h2>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-128x128 is-3by4">
                                <img src="images/photoprofil.jpg" alt="image profile">
                            </figure>
                        </div>
                        <div class="media-content has-text-centered">
                            <p class="title is-4"><?= $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?></p>
                            <p class="subtitle is-6"><?= $_SESSION['email'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="buttons">
                <a class="button is-link">Modifier mon profil</a>
                <a class="button is-link">Publier une nouvelle annonce</a>
            </div>
            <div class="buttons">
                <a class="button is-link">Voir mes annonces</a>
                <a class="button is-link">Voir mes réservations</a>
            </div>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php'
?>
