<?php
$title = "Stuliday -- ADD Annonces";
require 'includes/header.php';
require 'includes/functions.php';

// vérouiller acces à la page process
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<article class=\"message is-danger\">
                <div class=\"message-header\">
                    <p>Danger</p>
                    <button class=\"delete\" aria-label=\"delete\"></button>
                </div>
                <div class=\"message-body\">
                Sorry the page you request don't exist
                </div>
                </article>";
} elseif (isset($_POST['addAnnonce'])) {
    var_dump($_POST);
    if (!empty($_POST['titreAnnonce']) && !empty($_POST['content']) && !empty($_POST['adressAnnonce']) &&
        !empty($_POST['cityAnnonce']) && !empty($_POST['annoncePrice'] && !empty($_POST['dateBegin']) && !empty($_POST['dateEnd']))
        && !empty($_POST['placeNumber'])) {
        $title = strip_tags($_POST['titreAnnonce']);
        $content = strip_tags($_POST['content']);
        $address = strip_tags($_POST['adressAnnonce']);
        $city = strip_tags($_POST['cityAnnonce']);
        $price = intval(strip_tags($_POST['annoncePrice']));
        $dateBegin = strip_tags($_POST['dateBegin']);
        $dateEnd = strip_tags($_POST['dateEnd']);
        $placeNumbers = intval(strip_tags($_POST['placeNumber']));
        addAnnonce($title, $content, $city, $address, $price, $dateBegin, $dateEnd, $placeNumbers);
    }
}