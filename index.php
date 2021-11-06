<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('location: login.php');
} else {
  $user = $_SESSION['user'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css" />
  <title>Home</title>
</head>

<body>
  <section class="hero is-dark is-fullheight">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-5-tablet is-4-desktop is-5-widescreen">
            <h1 class="is-size-1">
              <?php
              echo "Bienvenido " . $user["nombres"] . " " . $user["apellidos"];
              ?>
            </h1>
            <form method="GET">
              <input class="button is-warning" type="submit" name="logout" value="Cerrar sesión " />
              <?php
              if (isset($_GET['logout'])) {
                session_destroy();
                unset($_SESSION['user']);
                header("location: login.php");
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>