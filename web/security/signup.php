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
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" > Check me out
                </label>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <?php
}
?>
