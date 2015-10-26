<?php
if (isset($_POST) && isset($_POST['email']) && isset($_POST['password'])) {
    $_SESSION['auth'] = true;
    header('Location: index.php');
} else {
    ?>
    <div class="col-md-6 col-md-offset-3">

        <h2>Bienvenue</h2>

        <p>
            Créez un compte et faites-vous livrer votre repas directement à votre lieu de travail !
        </p>

        <form method="post" action="#">
            <div class="form-group">
                <label for="exampleInputEmail1">Adresse e-mail</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firsName">Prénom</label>
                  <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Prénom">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName">Nom</label>
                  <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Nom">
                </div>
              </div>
            </div>
            <div class="form-group">
                <label for="idEntreprise">Identifiant entreprise</label>
                <input type="text" name="idEntreprise" class="form-control" id="idEntreprise" placeholder="Identifiant entreprise">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="passwordCheck">Vérifiez votre mot de passe</label>
                  <input type="password" name="passwordCheck" class="form-control" id="passwordCheck" placeholder="Vérifiez votre mot de passe">
                </div>
              </div>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" > En cochant cette case, j'accepte de recevoir des offres de la part d'Aurore Traiteur
                </label>
            </div>
            <button type="submit" class="btn btn-warning">Finaliser l'inscription</button>
        </form>
    </div>
    <?php
}
?>
