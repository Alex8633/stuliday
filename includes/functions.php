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
                $sth->execute();
                echo '<div class="notification is-success"><button class="delete"></button>Utilisateur bien enregistré</div>';
            } catch (PDOException $e) {
                echo 'Error' . $e->getMessage();
            }
        } else {
            echo '<div class="notification is-danger"><button class="delete"></button>Les mots de passe ne concordent pas</div>';
        }
    } elseif ($count > 0) {
        echo '<div class="notification is-danger"><button class="delete"></button>Cette adresse email est déja enregistré</div>';
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
                echo 'Vous êtes connectés !';
                header('Location: profile.php');
            } else {
                echo '<div class="alert alert-danger" role="alert">Le mot de passe est éronné !</div>';
                unset($_POST);
            }
        } else {
            echo 'Le mail n\'est pas connu !';
            unset($_POST);
        }
    } catch (PDOException $e) {
        echo 'Error ' . $e->getMessage();
    }
}

function addAnnonce($title, $content, $city, $address, $price)
{
    global $conn;
    try {

        $sth = $conn->prepare("INSERT INTO adverts (title, content, city, address, price, author) 
                VALUES (:title, :content, :city, :address, :price, :author)");

        $sth->bindValue(':title', $title);
        $sth->bindValue(':content', $content);
        $sth->bindValue(':city', $city);
        $sth->bindValue(':address', $address);
        $sth->bindValue(':price', $price);
        $sth->bindValue(':author', $_SESSION['id']);

        if ($sth->execute()) {
            header('Location: advertAdd.php');
        };

    } catch (PDOException $e) {
        echo 'Error' . $e->getMessage();
    }
}



function showAnnonces()
{
    global $conn;
    $sth = $conn->prepare('SELECT * ');
    $sth->execute();
    $products = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        ?>
        <tr>
            <th scope="row"><?php echo $product['products_id']; ?>
            </th>
            <td><?php echo $product['name']; ?>
            </td>
            <td><?php echo $product['description']; ?>
            </td>
            <td><?php echo $product['ville']; ?>
            </td>
            <td><?php echo $product['price']; ?>
            </td>
            <td><?php echo $product['categories_name']; ?>
            </td>
            <td><?php echo $product['username']; ?>
            </td>
            <td>
                <a
                    href="product.php/?id=<?php echo $product['products_id']; ?>">Afficher
                    article</a>
            </td>
        </tr>
        <?php
    }
}

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