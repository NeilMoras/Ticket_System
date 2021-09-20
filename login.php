<?php
$invalidLoginMsg ="";
require_once 'Library/loginFunction.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ticket-System</title>
      <link  rel="stylesheet" type="text/css" href="css/style.css"/ >
  </head>
  <body>
  <header id="header">
      <!--    LOGO-->
      <div class="logo">
          <img src="images/logo.png" alt="website logo">
      </div>
      <div class="navigation">
          <nav class="nav-menu">
              <ul class="nav-bar">
                  <li><a href="login.php">login</a></li>
              </ul>
          </nav>
      </div>
  </header>
  <main id="login-signup">
      <div class="login-page-title"><h1>Wellcome to Web Service Assistance</h1></div>
      <div class="login">
          <h2>Login</h2>
          <p><?= $invalidLoginMsg ?></p>
          <div>
        <form method="POST" action="" class="login-form">
          <!--    USERNAME FIELD-->
            <div class="login-field" >
                <label for="username">Username:</label>
                <input id="username" name="username" type="text">
            </div>
            <!--    USER PASSWORD INPUT FIELD-->
            <div class="login-field">
                <label for="password">Password:</label>
                <input id="password" name="password" type="password">
            </div>
                <!--    LOGIN SUBMIT BUTTON-->
            <div class="login-field">
                <input id="loginBtn" type="submit" name="submitLogin" value="Login" />
            </div>
        </form>
          </div>
      </div>

      <div class="sign-up">
          <h2>Sign-up</h2>
          <div>
              <form method="POST" action="" class="sign-up-form">
                  <div class="sign-up-field">
                      <label for="username">Username:</label>
                      <input name="username" type="text" required >
                  </div>
                  <div class="sign-up-field">
                      <label for="email">Email:</label>
                      <input name="email" type="text" id="email" required>
                  </div>
                  <div class="sign-up-field">
                      <label for="password">Password:</label>
                      <input name="password" type="password" required>
                  </div>
                  <div class="sign-up-field">
                      <input id="signupBtn" type="submit" name="submitSignUp" value="Sign-Up" />
                  </div>
              </form>
          </div>
      </div>
      <div>
      </div>
  </main>
  <?php require_once 'footer.php'; ?>
  </body>
</html>
