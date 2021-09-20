<header id="header">
    <!--    LOGO-->
    <div class="logo">
        <img src="images/logo.png" alt="website logo">
    </div>
    <div class="navigation">
        <nav class="nav-menu">
            <ul class="nav-bar">
            <!--  display the usermame once succesfully logged in to the nav bar using sessions -->
                <li><?php  echo 'Hello' . ' ' . $_SESSION['username']. '!'; ?></li>
              <li><a href="logout.php">Log-out</a></li>
            </ul>
        </nav>
    </div>
</header>
