<?php
$title = "Stuliday -- Delete annonce";
require 'includes/header.php';
require 'includes/navbar.php';
$id = $_GET['id'];
$sql = "SELECT title FROM adverts WHERE ad_id = $id";
$res = $conn->query($sql);
$titleAnnonce = $res->fetch(PDO::FETCH_ASSOC);
?>
    <div class="container">
        <div class="notification is-warning">
            <button class="delete"></button>
            Are rou sure you want to delete this Annonce ?
            <strong><?= $titleAnnonce['title'] ?></strong>
        </div>
        <form action="process.php" method="post">
            <div class="buttons">

                <a href="viewAnnonces.php" class="button is-link">Cancel</a>
                <input type="hidden" name="adverts_id" value="<?= $id ?>">
                <button type="submit" name="delete_ad" class="button is-warning">Delete</button>
            </div>
        </form>
    </div>

<?php
require 'includes/footer.php';