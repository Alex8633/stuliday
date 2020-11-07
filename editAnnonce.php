<?php
$title = 'Stuliday -- Edit Annonce';
require 'includes/header.php';
require 'includes/navbar.php';

$id = $_GET['id'];
$sql = "SELECT * FROM adverts WHERE ad_id = {$id}";
$res = $conn->query($sql);
$advert = $res->fetch(PDO::FETCH_ASSOC);

var_dump($advert);

?>

<div class="container">
    <div class="columns is-desktop is-vcentered">
        <div class="column is-three-fifths">
            <form action="process.php" method="post">
                <div class="field">
                    <label class="label" for="titreAnnonce">Title</label>
                    <div class="control">
                        <input class="input" type="text" name="titreAnnonce"
                               id="titreAnnonce" value="<?= $advert['title'] ?>" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="contentAnonce">Content</label>
                    <div class="control">
                        <textarea class="textarea" name="content"
                                  id="contentAnonce"><?= $advert['content'] ?></textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="adressAnnonce">Adress</label>
                    <div class="control">
                        <input class="input" type="text" name="adressAnnonce"
                               id="adressAnnonce" value="<?= $advert['address'] ?>" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="cityAnnonce">City</label>
                    <div class="control">
                        <input class="input" type="text" name="cityAnnonce"
                               id="cityAnnonce" value="<?= $advert['city'] ?>" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label for="PriceAnnonce" class="label">Price</label>
                        <input class="input" type="number" id="PriceAnnonce" name="annoncePrice"
                               value="<?= $advert['price'] ?>" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label for="dateBegin" class="label">disponibility beguin</label>
                        <input class="input" type="date" id="dateBegin" name="dateBegin"
                               value="<?= $advert['datedebut'] ?>" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label for="dateEnd" class="label">disponibility end</label>
                        <input class="input" type="date" id="dateEnd" name="dateEnd" value="<?= $advert['datefin'] ?>"
                               required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label for="placeNumber" class="label">Place numbers</label>
                        <input class="input" type="number" id="placeNumber" name="placeNumber"
                               value="<?= $advert['places'] ?>" required>
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

                <input type="hidden" name="advert_id"
                       value="<?php echo $advert['ad_id']; ?>"/>

                <div class="control">
                    <button class="button is-link" name="editAnnonce" value="editAnnonce">Edit Annonce</button>
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
    <?php if (!empty($_GET) and isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == 'places') {
            echo "<div class=\"notification is-warning\">
                            <button class=\"delete\"></button>
                            Numbers of places must be between 1 and 10
                      </div>";
        } elseif ($error == 'price') {
            echo "<div class=\"notification is-warning\">
                            <button class=\"delete\"></button>
                            Sorry your price must be between 1 and 999 €
                     </div>";
        }
    }
    ?>
</div>


<?php
require 'includes/footer.php';
?>
