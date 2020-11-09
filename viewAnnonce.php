<?php
$title = 'Stuliday -- Annonce';
require 'includes/header.php';
require 'includes/navbar.php';
require 'includes/functions.php';

$id = $_GET['id'];

$sql = "SELECT a.*, u.nom, u.prenom FROM adverts a
        LEFT JOIN users u ON a.author = u.id
        WHERE ad_id = {$id}";
$res = $conn->query($sql);
$annonce = $res->fetch(PDO::FETCH_ASSOC);
$author = $annonce['author']
?>
    <section class="section">
        <div class="container">
            <h2 class="subtitle is-2"><?= $annonce['title'] . ' post by ' . $annonce['nom'] . ' ' . $annonce['prenom'] ?></h2>
            <div class="columns">
                <div class="column is-two-fifths">
                    <figure class="image is-4by3">
                        <img src="images/maison-cubique-noir-blanc-moderne-nantes.jpg" alt="maison">
                    </figure>
                </div>
                <div class="column">
                    <h4 class="subtitle is-4">Description</h4>
                    <p><?= $annonce['content'] ?></p>
                    <p><?= $annonce['city'] ?></p>
                    <p><?= $annonce['address'] ?></p>
                    <p><?= $annonce['price'] . ' €' ?></p>
                    <p>Availability <?= $annonce['datedebut'] . ' ' . ' to ' . ' ' . $annonce['datefin'] ?></p>

                    <!-- On affiche le bouton réservation uniquement si l'utilisateur est connecté et n'est pas l'auteur de l'annonce  -->
                    <?php if (!empty($_SESSION) and $author != $_SESSION['id']) { ?>
                        <form action="process.php" method="post">
                            <input type="hidden" name="add_id" value="<?= $id ?>">
                            <button type="submit" name="reserve_add" class="button is-link">Book</button>
                        </form>
                    <?php } else if (empty($_SESSION)) { ?>
                        <div class="buttons">
                            <a href="signin.php" class="button is-link">log in to book</a>
                        </div>
                    <?php } ?>
                    <div class="buttons">
                        <a href="viewAnnonces.php" class="button is-link">Retourn to Annonces</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
require 'includes/footer.php';