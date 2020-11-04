<?php
require 'includes/header.php';
require 'includes/navbar.php';
?>

<div class="container">
    <div class="columns">
        <div class="column">
            <div class="card p-2">
                <div class="file">
                    <label class="file-label">
                        <input class="file-input" type="file" name="resume">
                        <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Choose a file…
      </span>
    </span>
                    </label>
                </div>
                <h2 class="title">Mon profil</h2>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-128x128">
                                <img src="https://bulma.io/images/placeholders/128x128.png">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4"><?= $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?></p>
                            <p class="subtitle is-6"><?= $_SESSION['email'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button class="button is-primary">Primary</button>
                    <button class="button is-link">Link</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php'
?>
