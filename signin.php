<?php
require 'includes/header.php';
require 'includes/navbar.php';
require 'includes/functions.php';

if (!empty($_POST['submit_signup']) && !empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['firstname_signup'])
    && !empty($_POST['lastname_signup'])) {
    $pass_su = htmlspecialchars($_POST['password1_signup']);
    $repass_su = htmlspecialchars($_POST['password2_signup']);
    $email_su = htmlspecialchars($_POST['email_signup']);
    $firstname = htmlspecialchars($_POST['firstname_signup']);
    $lastname = htmlspecialchars($_POST['lastname_signup']);
    inscription($email_su, $pass_su, $repass_su, $firstname, $lastname);
}

if (!empty($_POST['submit_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login'])) {
    $pass_login = htmlspecialchars($_POST['password_login']);
    $email_login = htmlspecialchars($_POST['email_login']);
    connexion($email_login, $pass_login);
}
?>
    <div class="container">
        <div class="columns">
            <div class="column">
                <form action="signin.php" method="post">
                    <div class="field">
                        <label class="label" for="email_signup">Email</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id="email_signup" type="email" placeholder="Type your email" value=""
                                   name="email_signup">
                            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            <span class="icon is-small is-right"><i class="fas fa-exclamation-triangle"></i></span>
                        </div>

                    </div>

                    <div class="field">
                        <label class="label" for="firstname_signup">First Name</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id="firstname_signup" type="text" placeholder="Enter your name"
                                   value=""
                                   name="firstname_signup">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="lastname_signup">Last Name</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id="lastname_signup" type="text" placeholder="Enter your Lastname"
                                   value=""
                                   name="lastname_signup">
                        </div>
                    </div>

                    <div class="field">
                        <label for="password1" class="label">Password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="password" placeholder="Chose a password" value=""
                                   name="password1_signup" id="password1">
                        </div>
                    </div>

                    <div class="field">
                        <label for="password2" class="label">Confirm your password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="password" placeholder="Re-enter your password" value=""
                                   name="password2_signup" id="password2">
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="submit_signup">
                                I agree to the <a href="#">terms and conditions</a>
                            </label>
                        </div>
                    </div>

                    <div class="field is-grouped">
                        <div class="control">
                            <button name="submit_signup" class="button is-link" value="sigup">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="column">
                <form action="signin.php" method="post">
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="email" placeholder="Type your email" value=""
                                   name="email_login">
                            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            <span class="icon is-small is-right"><i class="fas fa-exclamation-triangle"></i></span>
                        </div>

                    </div>

                    <div class="field">
                        <label class="label" for="passwordLogin">Password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id="passwordLogin" type="password" placeholder="Chose a password"
                                   value=""
                                   name="password_login">
                        </div>
                    </div>


                    <div class="field is-grouped">
                        <div class="control">
                            <button name="submit_login" class="button is-link" value="login">Login !</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
require 'includes/footer.php';