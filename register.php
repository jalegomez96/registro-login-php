<?php
session_start();
if (isset($_SESSION['user'])) {
  header('location: index.php');
}

$error = '';
if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css" />
  <title>Registro</title>
</head>

<body>
  <section class="hero is-dark is-fullheight">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-5-tablet is-4-desktop is-5-widescreen">
            <h1 class="is-size-1">Registro</h1>
            <form method="post" action="register.php" class="box">
              <div class="field">
                <label for="" class="label">Nombres</label>
                <div class="control has-icons-left">
                  <input type="text" name="nombres" class="input" required />
                  <span class="icon is-small is-left">
                    <i class="fa fa-envelope"></i>
                  </span>
                </div>
              </div>
              <div class="field">
                <label for="" class="label">Apellidos</label>
                <div class="control has-icons-left">
                  <input type="text" name="apellidos" class="input" required />
                  <span class="icon is-small is-left">
                    <i class="fa fa-envelope"></i>
                  </span>
                </div>
              </div>
              <div class="field">
                <label for="" class="label">Email</label>
                <div class="control has-icons-left">
                  <input type="email" name="email" placeholder="example@gmail.com" class="input" required />
                  <span class="icon is-small is-left">
                    <i class="fa fa-envelope"></i>
                  </span>
                </div>
              </div>
              <div class="field">
                <label for="" class="label">Contraseña</label>
                <div class="control has-icons-left">
                  <input type="password" name="pw" placeholder="*******" class="input" required />
                  <span class="icon is-small is-left">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
              </div>
              <div class="field">
                <label for="" class="label">Confirmar contraseña</label>
                <div class="control has-icons-left">
                  <input type="password" name="pw2" placeholder="*******" class="input" required />
                  <span class="icon is-small is-left">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
              </div>
              <div class="field">
                <?php
                if ($error) {
                  echo '<div class="notification is-warning">' . $error . '</div>';
                }
                ?>
              </div>
              <div class="field">
                <input class="button is-success" type="submit" name="reg_user" value="Registrar" />
                <a class="button is-success" href="login.php">Ingresa</a>
              </div>
              <?php
              include_once('user.php');
              $nombres = '';
              $apellidos = '';
              $email = '';
              $pw = '';
              $pw2 = '';
              if (isset($_POST['reg_user'])) {
                $nombres = $_POST['nombres'];
                $apellidos = $_POST['apellidos'];
                $email = $_POST['email'];
                $pw = $_POST['pw'];
                $pw2 = $_POST['pw2'];
                $result = register($nombres, $apellidos, $email, $pw, $pw2);
                if ($result['ok']) {
                  $_SESSION['user'] = $result['data'];
                  header('location: index.php');
                } else {
                  $_SESSION['error'] = $result['error'];
                  header('location: register.php');
                }
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