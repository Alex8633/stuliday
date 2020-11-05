<?php
$title = "Stuliday - Add Annonce";
require 'includes/header.php';
require 'includes/navbar.php';
?>

<div class="container">
    <div class="columns is-desktop is-vcentered">
        <div class="column is-three-fifths">
            <form action="process.php" method="post">
                <div class="field">
                    <label class="label" for="titreAnnonce">Title</label>
                    <div class="control">
                        <input class="input" type="text" name="titreAnnonce"
                               id="titreAnnonce" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="contentAnonce">Content</label>
                    <div class="control">
                        <textarea class="textarea" name="content" id="contentAnonce"></textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="adressAnnonce">Adress</label>
                    <div class="control">
                        <input class="input" type="text" name="adressAnnonce"
                               id="adressAnnonce" required>
                    </div>
                </div>


                <div class="field">
                    <label class="label" for="cityAnnonce">City</label>
                    <div class="control">
                        <input class="input" type="text" name="cityAnnonce"
                               id="cityAnnonce" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label for="PriceAnnonce" class="label">Price</label>
                        <input class="input" type="number" id="PriceAnnonce" name="annoncePrice" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox">
                            I agree to the <a href="#">terms and conditions</a>
                        </label>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" name="addAnnonce" value="addAnnonce">Add Annonce</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="column">
            <div class="file">
                <label class="file-label">
                    <input class="file-input" type="file" name="resume">
                    <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        add a picture
      </span>
    </span>
                </label>
            </div>
        </div>
    </div>

</div>