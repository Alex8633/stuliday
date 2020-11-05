<?php
require 'includes/header.php';
require 'includes/functions.php';

// vérouiller acces à la page process
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<div class='alert is-danger'>Sorry the page you request don't exist</div>";
} elseif (isset($_POST['addAnnonce'])) {
    if (!empty($_POST['titreAnnonce']) && !empty($_POST['content']) && !empty($_POST['adressAnnonce']) &&
        !empty($_POST['cityAnnonce']) && !empty($_POST['annoncePrice'])) {
        $title = strip_tags($_POST['titreAnnonce']);
        $content = strip_tags($_POST['content']);
        $address = strip_tags($_POST['adressAnnonce']);
        $city = strip_tags($_POST['cityAnnonce']);
        $price = strip_tags($_POST['annoncePrice']);

        addAnnonce($title, $content, $city, $address, $price);
    }
}