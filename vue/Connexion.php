<?php 
require('header.php');

?>

<div class="ecran_connexion">
    <div class="content">
        <img src="assets/img/logo-vk.svg" width="200px" alt="logo">
        <h1 id="titre">Vakars</h1>
        <form method="post" action="">
            <?php if(isset($erreur)){ echo '<p>'.$erreur.'</p>'; }?>
            <p>
                <input type="email" name="mail" id="mail" placeholder="Adresse e-mail">
                <input type="password" name="password" id="password" placeholder="Mot de passe">
            </p>
            <p>
                <button type="submit">Se connecter</button>
            </p>
        </form>

        <p id="inscription"><a href="inscription.php">Je n'ai pas de compte</a></p>
    </div>
</div>
<?php 
require('footer.php');

?>
