<?php
$title = "Stuliday - Annonces";
require 'includes/header.php';
require 'includes/navbar.php';
require 'includes/functions.php'
?>

    <div class="container">
        <?php if (empty($_GET)) {
            showAnnonces();
        } elseif (!empty($_GET)) {
            $id = $_GET['id'];
            showAnnoncesByUsuer($id);
        } ?>
    </div>

<?php
require 'includes/footer.php';
