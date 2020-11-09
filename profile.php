<?php
$title = "Stuliday - Profile";
require 'includes/header.php';
require 'includes/navbar.php';
$id = $_SESSION['id'];
$sql = "SELECT profil_image FROM users WHERE id = {$id}";
$res = $conn->query($sql);
$imageProfil = $res->fetch(PDO::FETCH_ASSOC);
if (!empty($_GET['book'])) {
    echo '<div class="notification is-success"><button class="delete"></button>Booking registred !</div>';
}
?>

<div class="container mb-2">
    <div class="columns is-desktop is-vcentered">
        <div class="column">
            <div class="card p-2">
                <h2 class="title has-text-centered">Welcome <?= $_SESSION['prenom'] ?></h2>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-128x128 is-3by4">
                                <img src="<?php if ($imageProfil['profil_image'] != null) {
                                    echo $imageProfil['profil_image'];
                                } else {
                                    echo 'images/opinion-sin-imagen.png';
                                } ?>"
                                     alt="image profile">
                            </figure>
                        </div>
                        <div class="media-content has-text-centered">
                            <p class="subtitle is-4">nom : <?= $_SESSION['nom'] ?></p>
                            <p class="subtitle is-4">prenom : <?= $_SESSION['prenom'] ?></p>
                            <p class="subtitle is-6">mail : <?= $_SESSION['email'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="buttons">
                <a class="button is-link is-fullwidth" href='editProfil.php?id=<?php echo $_SESSION['id'] ?>'>Edit
                    profil</a>
                <a class="button is-link is-fullwidth" href="addAnnonce.php">Add Advert</a>
                <a class="button is-link is-fullwidth" href="viewAnnonces.php?id=<?php echo $_SESSION['id'] ?>">See my
                    ads</a>
                <a class="button is-link is-fullwidth"
                   href="viewAnnonces.php?id=<?php echo $_SESSION['id'] ?>&book=book">See my
                    reservations</a>
            </div>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php'
?>
