<?php
// STARTING THE SESSION
session_start();
//USING LOGIN FUNCTION TO GRAB THE SESION VARIABLES
require_once 'Library/loginFunction.php';
// VERIFY IF THE ACCOUNT  TYPE IS ADMIN, IF NOT THE USER WILL BE REDIRECTED TO THE LOGIN PAGE
 if($_SESSION['accountType']!="admin"){
     header("Location: login.php");
 }
 // STORE THE SESSION USER ID AND THE USERNAME BY IN A VARIABLE GRABBING IT FROM THE LOGIN FUNCTION PAGE DECLARED ABOVE
(string)$userId = $_SESSION['userid'];
(string)$DisplayAdminName = $_SESSION['username'];
// USING THE ADMIN PAGE FUNCTION TO DISPLAY ALL THE TICKETS FROM ALL THE USERS
require_once 'Library/adminPageFunction.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>User Page</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css"/ >
</head>
<body>
<?php require_once 'header.php'; ?>
<main>
<div class="ticketList">
    <h2>Hello Admin <?= $DisplayAdminName; ?>!</h2>
    <h3>All Tickets</h3>
    <div class="tableWrapper">
        <table class="supportTickets">
            <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Subject</th>
                <th>Created Date</th>
                <th>Client ID</th>
                <th>Status</th>
                <th>View</th>
            </tr>
            </thead>
            <tbody>
                <!--    DISPLAY ALL THE TICKET SFROM XML FILE-->
            <?php print $ticketRows; ?>
            </tbody>
        </table>
    </div>
</div>

    <div class="sign-up">
        <h2>Sign-up</h2>
        <div>
            <form method="POST" action="" class="sign-up-form">
                <div class="sign-up-field">
                    <label for="username">Username:</label>
                    <input  name="username" type="text" required >
                </div>
                <div class="sign-up-field">
                    <label for="email">Email:</label>
                    <input  name="email" type="text" id="email" required>
                </div>
                <div class="sign-up-field">
                    <label for="password">Password:</label>
                    <input  name="password" type="password" required>
                </div>
                <div class="sign-up-field">
                    <label for="staffnumber">Employee Number:(Admin Only)</label>
                    <input name="staffNumber" type="text" id="staffNumber">
                </div>
                <div class="sign-up-field">
                    <input id="signupBtn" type="submit" name="submitSignUp" value="Sign-Up" />
                </div>
            </form>
        </div>
    </div>

</main>
<?php require_once 'footer.php'; ?>
</body>
</html>
