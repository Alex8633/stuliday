<?php
$title = "Stuliday - Annonces";
require 'includes/header.php';
require 'includes/navbar.php';
require 'includes/functions.php'
?>

    <div class="container">
        <?php if (empty($_GET)) {
            echo '<h2 class="subtitle is-2">All our announcements</h2>';
            showAnnonces();
        } elseif (!empty($_GET) && empty($_GET['book'])) {
            $id = $_GET['id'];
            echo '<h2 class="subtitle is-2">My add</h2>';
            showAnnoncesByUsuer($id);
        } elseif (!empty($_GET) && !empty($_GET['book'])) {
            $id = $_GET['id'];
            echo '<h2 class="subtitle is-2">My Booking</h2>';
            showBook($id);
        }
        ?>
    </div>

<?php
require 'includes/footer.php';
