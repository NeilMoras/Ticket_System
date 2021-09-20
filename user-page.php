<?php
// STARTING THE SESSION
session_start();
//USING LOGIN FUCNTION TO GRAB THE SESION VARIABLES
require_once 'Library/loginFunction.php';
// VERIFY IF THE ACCOUNT  TYPE IS CLIENT, IF NOT THE USER WILL BE REDIRECTED TO THE LOGIN PAGE
if($_SESSION['accountType']!="client"){
    header("Location: login.php");
}
// STORE THE SESSION USER ID AND THE USERNAME BY IN A VARIABLE GRABBING IT FROM THE LOGIN FUNCTION PAGE DECLARED ABOVE
(string)$userId = $_SESSION['userid'];
(string)$DisplayUsername = $_SESSION['username'];
// USING THE USER PAGE FUNCTION TO DISPLAY THE TICKETS AS PER USER ID USING XPATH
require_once 'Library/userPageFunction.php';
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
      <div>
        <h1>Hello <?= $DisplayUsername; ?></h1>
      </div>
      <div>
          <form method="POST" action="">
              <div>
                  <label for="subject">Subject:</label>
                  <input name="subject" type="text" id="subject">
              </div>
              <div>
                  <label for="postMessage">Message:</label>
                  <textarea class="" name="postMessage" id="postMessage"></textarea>
              </div>
              <div class="">
                  <input type="submit" class="inputBtn" name="submitTicket" value="Submit" />
              </div>
          </form>
      <div class="ticketList">
          <h2>Your Tickets</h2>
          <div class="tableWrapper">
              <table class="supportTickets">
                  <thead>
                  <tr>
                      <th>Ticket ID</th>
                      <th>Subject</th>
                      <th>Created</th>
                      <th>Client ID</th>
                      <th>Status</th>
                      <th>View</th>
                  </tr>
                  </thead>
                  <tbody>
                    <!--    display tickets FROM XML FILE based on user ID-->
           <?php echo $ticketRows ?>
                  </tbody>
              </table>
          </div>
      </div>
  </main>
  <?php require_once 'footer.php'; ?>
  </body>
</html>
