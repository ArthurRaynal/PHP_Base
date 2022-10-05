<?php
$title = "Contact";
$firstname = $_POST["FirstName"];
$lastname = $_POST["LastName"];
$email = $_POST["Email"];
$raison = $_POST["raison"];
$civilite = $_POST["civilite"];
$message = $_POST["message"];
$empty_error = "Veuillez remplir ce champ.";
$email_error = "Veuillez renseigner une addresse email valide.";
$message_error = "Veuillez rentrer au moins 5 caracteres";
$methode = $_SERVER["REQUEST_METHOD"];
$email_valid_pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
$contact_file = 'form.txt';
$contact_infos = "firstname : $firstname\nlastname : $lastname\nemail : $email\nmessage : $message\n ------------------------------------\n";
$user_infos_array = array(
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email,
    'raison' => $raison,
    'civilite' => $civilite,
    'message' => $message
    );
$_SESSION['user_data'] = $user_infos_array;

require 'header.php';

?>

<!-- Contact Section -->
<div class="w3-container w3-padding-64" id="contact">

    <?php if($_SERVER["REQUEST_METHOD"] == "POST" && (!empty($lastname) && !empty($email) && !empty($firstname) && !empty($message) && !empty($civilite))){
        echo "<h2>Votre formulaire à bien été envoyer !</h2>";
        file_put_contents($contact_file,$contact_infos, FILE_APPEND);
        unset($_SESSION['user_data']);
    }
    ?>

    <h1>Contact</h1><br>
    <form method="post" action="?page=contact">
        <p><input class="w3-input w3-padding-16" type="text" placeholder="FirstName"  name="FirstName" value="<?= $_SESSION['user_data']['firstname'] ?>">
        <p style="color: orangered">
            <?php
            if ($methode == "POST" && empty($firstname)) {
                echo $empty_error;
            }
            ?>
        </p>
        </p>

        <p><input class="w3-input w3-padding-16" type="text" placeholder="LastName"  name="LastName" value="<?= $_SESSION['user_data']['lastname'] ?>">
        <p style="color: orangered">
            <?php
            if ($methode == "POST" && empty($lastname)) {
                    echo $empty_error;
            }
            ?>
        </p>
        </p>

        <label for="civilité">Quelle est votre civilité:</label>
            <select name="civilite">
                <option value="" disabled selected></option>
                <option  value="femme">Femme</option>
                <option value="homme">Homme</option>
            </select>
        <p style="color: orangered">
            <?php
            if ($methode == "POST" && empty($civilite)) {
                echo $empty_error;
            }
            ?></p>


        <p><input class="w3-input w3-padding-16" type="text" placeholder="Email"  name="Email"></p>
        <p style="color: orangered">
            <?php
            if ($methode == "POST") {
                if (empty($email)){
                    echo $empty_error;
                } elseif (!preg_match($email_valid_pattern,$email)){
                    echo $email_error;
                }

            }
            ?></p><br>


        <p> Raison :</p>
        <input type="radio" id="raison1" name="raison" value="raison1">
        <label for="raison1">Raison 1</label><br>
        <input type="radio" id="raison2" name="raison" value="raison2">
        <label for="raison1">Raison 2</label><br>
        <input type="radio" id="raison3" name="raison" value="raison3">
        <label for="raison1">Raison 3</label>
        <p style="color: orangered">
            <?php
            if ($methode == "POST" && empty($raison)) {
                echo $empty_error;
            }
            ?></p>
        <br>
        <p>Message :</p>
        <textarea name="message" ><?= $_SESSION['user_data']['message'] ?></textarea>
        <p style="color: orangered">
            <?php
            if ($methode == "POST" && (strlen($message) < 5)) {
                echo $message_error;
            }
            ?></p>

        <br>

        <input type="file" name="file"><br>


        <p><button name="submit" class="w3-button w3-light-grey w3-section" type="submit">SEND</button></p>
    </form>
</div>

<?= require 'footer.php'; ?>

