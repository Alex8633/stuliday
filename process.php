<?php
$title = "Stuliday -- process";
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
} elseif (isset($_POST['submit_signup'])) {
    if (!empty($_POST['email_signup']) && !empty($_POST['password1_signup'])
        && !empty($_POST['firstname_signup']) && !empty($_POST['lastname_signup'])) {
        $pass_su = htmlspecialchars($_POST['password1_signup']);
        $repass_su = htmlspecialchars($_POST['password2_signup']);
        $email_su = htmlspecialchars($_POST['email_signup']);
        $firstname = htmlspecialchars($_POST['firstname_signup']);
        $lastname = htmlspecialchars($_POST['lastname_signup']);
        inscription($email_su, $pass_su, $repass_su, $firstname, $lastname);
    }
} elseif (isset($_POST['editAnnonce'])) {
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
        $id = intval(strip_tags($_POST['advert_id']));
        editAnnonce($title, $content, $city, $address, $price, $dateBegin, $dateEnd, $id, $placeNumbers, $_SESSION['id']);
    }
} elseif (isset($_POST['submit_login'])) {
    if (!empty($_POST['email_login']) && !empty($_POST['password_login'])) {
        $pass_login = htmlspecialchars($_POST['password_login']);
        $email_login = htmlspecialchars($_POST['email_login']);
        connexion($email_login, $pass_login);
    }
} elseif (isset($_POST['edit_profil'])) {
    if (!empty($_POST['email_edit']) && !empty($_POST['password1_edit'] && !empty($_POST['password2_edit']))
        && !empty($_POST['firstname_edit']) && !empty($_POST['lastname_edit'])) {
        $pass_su = htmlspecialchars($_POST['password1_edit']);
        $repass_su = htmlspecialchars($_POST['password2_edit']);
        $email_su = htmlspecialchars($_POST['email_edit']);
        $firstname = htmlspecialchars($_POST['firstname_edit']);
        $lastname = htmlspecialchars($_POST['lastname_edit']);
        if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
            $taillemax = 2097152;
            $extensionsValides = ['jpg', 'jpeg', 'gif', 'png'];
            if ($_FILES['avatar']['size'] <= $taillemax) {
                $extensionUpload = substr(strrchr($_FILES['avatar']['type'], '/'), 1);
                if (in_array($extensionUpload, $extensionsValides)) {
                    $path = "images/avatars/" . $_SESSION['id'] . "." . $extensionUpload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
                    if ($resultat) {
                        $sql = 'UPDATE users SET profil_image = :profil_image WHERE id = :id';
                        $updateavatar = $conn->prepare($sql);
                        $updateavatar->bindValue(':profil_image', $path);
                        $updateavatar->bindValue(':id', $_SESSION['id']);
                        if ($updateavatar->execute()) {
                            header('Location: profile.php');
                        }
                    } else {
                        header('Location: editProfil.php?error=import');
                    }
                } else {
                    header('Location: editProfil.php?error=extension');
                }
            } else {
                header('Location: editProfil.php?error=avatarsize');
            }
        }
    }
} elseif (isset($_POST['delete_ad'])) {
    if (!empty($_POST['adverts_id'])) {
        $advert_id = strip_tags($_POST['adverts_id']);
        suppAdverts($_SESSION['id'], $advert_id);
    }
} elseif (isset($_POST['reserve_add'])) {
    if (!empty($_POST['add_id'])) {
        $add_id = intval(strip_tags($_POST['add_id']));
        $user_id = intval($_SESSION['id']);
        bookAdd($add_id, $user_id);
    }
}