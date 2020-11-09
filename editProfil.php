<?php
$title = "Stuliday - Edit Profil";
require 'includes/header.php';
require 'includes/navbar.php';

$id = $_GET['id'];
$sql = "SELECT * FROM users where id = {$id}";
$res = $conn->query($sql);
$user = $res->fetch(PDO::FETCH_ASSOC);

?>
    <div class="container">
        <div class="columns">
            <div class="column is-half">
                <h2 class="subtitle is-3"> Edit profil</h2>
                <form action="process.php" method="post" enctype="multipart/form-data">
                    <div class="field">
                        <label class="label" for="email_signup">Email</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id="email_signup" type="email" value="<?= $user['email'] ?>"
                                   name="email_edit">
                            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            <span class="icon is-small is-right"><i class="fas fa-exclamation-triangle"></i></span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="firstname_signup">First Name</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id="firstname_signup" type="text"
                                   value="<?= $user['prenom'] ?>"
                                   name="firstname_edit">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="lastname_signup"> Last Name </label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id="lastname_edit" type="text"
                                   value=" <?= $user['nom'] ?>"
                                   name="lastname_edit">
                        </div>
                    </div>

                    <div class="field">
                        <label for="password1" class="label">Password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="password" placeholder="Chose a password" value=""
                                   name="password1_edit" id="password1">
                        </div>
                    </div>

                    <div class="field">
                        <label for="password2" class="label">Confirm your password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="password" placeholder="Re-enter your password" value=""
                                   name="password2_edit" id="password2">
                        </div>
                    </div>
                    <div class="field">
                        <div class="file has-name is-info">
                            <label class="file-label">
                                <input class="file-input" type="file" name="avatar"
                                       onchange="document.getElementById('myfileURL').innerHTML=this.value;">
                                <span class="file-cta">
                                <span class="file-icon"><i class="fas fa-upload"></i></span>
                                <span class="file-label">Choose a file…</span>
                            </span>
                                <span class="file-name" id="myfileURL"></span>
                            </label>
                        </div>
                    </div>

                    <div class="field is-grouped my-2">
                        <div class="control">
                            <button name="edit_profil" class="button is-link" value="signup">Edit Profil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
require 'includes/footer.php';
