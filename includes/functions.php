<?php

function inscription($email, $password1, $password2, $firstname, $lastname)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();
    if (!$count) {
        if ($password1 === $password2) {
            try {
                $pass_su = password_hash($password1, PASSWORD_DEFAULT);
                $sth = $conn->prepare('INSERT INTO users (email, password, nom, prenom) VALUES (:email, :password, :nom, :prenom)');
                $sth->bindValue('email', $email);
                $sth->bindValue('password', $pass_su);
                $sth->bindValue('nom', $lastname);
                $sth->bindValue('prenom', $firstname);
                if ($sth->execute()) {
                    header('Location: signin.php?signin=sucess');
                }
            } catch (PDOException $e) {
                echo 'Error' . $e->getMessage();
            }
        } else {
            header('Location: signin.php?signin=errorpassword');
        }
    } elseif ($count > 0) {
        header('Location: signin.php?signin=errormail');
    }
}

function connexion($email, $password)
{
    global $conn;
    try {
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $res = $conn->query($sql);
        $user = $res->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            var_dump($user);
            $db_password = $user['password'];
            if (password_verify($password, $db_password)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                header('Location: profile.php');
            } else {
                header('Location: signin.php?signin=errorpassword');
            }
        } else {
            header('Location: signin.php?signin=errormailcon');
        }
    } catch (PDOException $e) {
        echo 'Error ' . $e->getMessage();
    }
}

function addAnnonce($title, $content, $city, $address, $price, $dateBegin, $dateEnd, $placeNumber)
{
    global $conn;
    if ($price > 0 && $price < 1000) {
        if ($placeNumber > 0 && $placeNumber <= 10) {
            try {
                $sth = $conn->prepare("INSERT INTO adverts (title, content, city, address, price, author, datedebut, datefin, places) 
                VALUES (:title, :content, :city, :address, :price, :author, :datedebut, :datefin, :places)");
                $sth->bindValue(':title', $title);
                $sth->bindValue(':content', $content);
                $sth->bindValue(':city', $city);
                $sth->bindValue(':address', $address);
                $sth->bindValue(':price', $price);
                $sth->bindValue(':datedebut', $dateBegin);
                $sth->bindValue(':datefin', $dateEnd);
                $sth->bindValue(':places', $placeNumber);
                $sth->bindValue(':author', $_SESSION['id']);
                if ($sth->execute()) {
                    header('Location: advertAdd.php');
                };
            } catch (PDOException $e) {
                echo 'Error' . $e->getMessage();
            }
        } else {
            header('Location: addAnnonce.php?error=places');
        }
    } else {
        header('Location: addAnnonce.php?error=price');
    }
}

// Affiche toute les annonces posté sur le site
function showAnnonces()
{
    global $conn;
    $sth = $conn->prepare('SELECT a.*, u.nom, u.prenom FROM adverts AS a LEFT JOIN users u on a.author = u.id');
    $sth->execute();
    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    printAnnonces($adverts);
}

// affiche les annonces par utilisateur en fonction de son id
function showAnnoncesByUsuer($id)
{
    global $conn;
    $sth = $conn->prepare("SELECT a.*, u.nom, u.prenom 
                                    FROM adverts AS a 
                                    LEFT JOIN users u on a.author = u.id 
                                    WHERE author = {$id}");
    $sth->execute();
    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    printAnnonces($adverts);
}

// création des "cards" annonces
function printAnnonces($adverts)
{
    foreach ($adverts as $advert) {
        ?>
        <div class="card-annonce">
            <div class="card-annonce-image">
                <img class="img-responsive" src="images/placeholder.png" alt="maison">
            </div>
            <div class="card-annonce-content">
                <div class="annonce-title"><h2 class="subtitle is-2"
                                               style="color: black"><?php echo $advert['title'] ?></h2></div>
                <div class="annonce-city"><h2 class="subtitle is-3"><?php echo $advert['city'] ?></h2></div>
                <div class="annonce-price"><h2 class="subtitle is-4"><?php echo $advert['price'] . '€' ?></h2></div>
                <div class="annonce-author">
                    <h2 class="subtitle is-4"><?php echo $advert['nom'] . ' ' . $advert['prenom'] ?></h2></div>
                <div class="annonce-dates"> Availability <?php echo $advert['datedebut'] ?>
                    to <?= $advert['datefin'] ?></div>
            </div>
            <div class="annonce-lien">
                <a href="viewAnnonce.php?id=<?php echo $advert['ad_id']; ?>" class="button is-primary">show Annonce</a>
                <!-- affichage du bouton edit annonce seulement pour les annonces de l'utilisateur connecté -->
                <?php if (!empty($_SESSION) && $advert['author'] == $_SESSION['id']) { ?>
                    <a href="editAnnonce.php?id=<?php echo $advert['ad_id']; ?>" class="button is-primary">Edit
                        Annonce</a>
                    <a href="suppAnnonce.php?id=<?php echo $advert['ad_id']; ?>" class="button is-danger">Delete
                        Annonce</a>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}

// fonction de modification d'une annonce
function editAnnonce($title, $content, $city, $address, $price, $dateBegin, $dateEnd, $id, $placeNumber, $user_id)
{
    global $conn;
    if ($price > 0 && $price < 1000) {
        if ($placeNumber > 0 && $placeNumber <= 10) {
            try {
                $sth = $conn->prepare("UPDATE adverts SET title =:title, content =:content, city =:city, 
                   address =:address, price =:price, author =:author, datedebut =:datedebut, datefin =:datefin, places =:places
                    WHERE ad_id = $id AND author = $user_id");
                $sth->bindValue(':title', $title);
                $sth->bindValue(':content', $content);
                $sth->bindValue(':city', $city);
                $sth->bindValue(':address', $address);
                $sth->bindValue(':price', $price);
                $sth->bindValue(':datedebut', $dateBegin);
                $sth->bindValue(':datefin', $dateEnd);
                $sth->bindValue(':places', $placeNumber);
                $sth->bindValue(':author', $_SESSION['id']);
                if ($sth->execute()) {
                    header('Location: viewAnnonces.php');
                }
            } catch (PDOException $e) {
                echo 'Error' . $e->getMessage();
            }
        } else {
            header("Location: editAnnonce.php?error=places&id={$id}");
        }
    } else {
        header("Location: editAnnonce.php?error=price&id={$id}");
    }
}

// affiche les informations pour une annonce
function showAnnonce($id)
{
    global $conn;
    $sth = $conn->prepare("SELECT * 
                                    FROM adverts
                                    WHERE ad_id = $id");
    $sth->execute();
    $annonce = $sth->fetch(PDO::FETCH_ASSOC);
    var_dump($annonce);
}

function suppAdverts($user_id, $ad_id)
{
    // Récupération de la connexion à la BDD à partir de l'espace global.
    global $conn;
    // Tentative de la requête de suppression.
    try {
        $sth = $conn->prepare('DELETE FROM adverts WHERE ad_id = :adverts_id AND author =:user_id');
        $sth->bindValue(':adverts_id', $ad_id);
        $sth->bindValue(':user_id', $user_id);
        if ($sth->execute()) {
            header("Location:viewAnnonces.php?s&id={$user_id}");
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// fonction pour les réservations
function bookAdd($add_id, $user_id)
{
    global $conn;
    try {
        $sth = $conn->prepare("INSERT INTO reservations (users_id, adverts_id) VALUES (:user_id, :add_id)");
        $sth->bindValue(':add_id', $add_id);
        $sth->bindValue(':user_id', $user_id);
        if ($sth->execute()) {
            header('Location: profile.php?book=s');
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

//fonction qui affiche les réservation de l'utilisateur
function showBook($id)
{
    global $conn;
    try {
        $sql = "SELECT a.*, r.users_id, r.reserv_id, u.id, u.nom, u.prenom
        FROM adverts AS a 
        LEFT JOIN reservations r ON a.ad_id = r.adverts_id
        LEFT JOIN users u on r.users_id = u.id 
        WHERE u.id = {$id}";
        $sth = $conn->prepare($sql);
        $sth->execute();
        $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
        printAnnonces($adverts);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}