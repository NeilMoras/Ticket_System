<?php
//USE LOGIN, ADMIN AND USER FUCNTION IN ORDER TO DISPLAY THE DETAILS ACCORDING TO THE Acount type
require_once 'Library/loginFunction.php';

require_once 'Library/userPageFunction.php';
require_once 'Library/adminPageFunction.php';
//START THE SESSION
session_start();


//GRAB THE TICKET ID FROM THE ADMIN AND THE USER FUNCTION PAGE AS WHEN CLICKED ON "VIEW DETAILS" BRAGS THE ID FROMT HE FORM BUTTON AND STORES IT IN TICKET VARIABLE
if (empty($_POST)) {
    $ticketId = $_POST['id'];
}

// STORE THE SESSION USER ID AND THE USERNAME BY IN A VARIABLE GRABBING IT FROM THE LOGIN FUNCTION PAGE DECLARED ABOVE

(string)$senderId = $_SESSION['userid'];
(string)$username = $_SESSION['username'];
$accountType = $_SESSION['accountType'];
//INITIALIZING THE BACK PAGE LINK AND USING AN IFF ATATEMNT TO REDIRECT THE PAGE ACCORDING TO THE ACCOUNT TYPE
$backPageLink = "";

//USING CONDITONS TO HIDE AND DISPLAY RTHE ADMIN USER BUTTONS TO UPDATE STATUS WHN A USER IS ACCESSING THE PAGE

//USING THE TICKET DETAILS FUNCTION LATER AS ITWILL USE THE DESCLARED SESSION VARIBALESTO DISPLAY THE INFO
$ticketMessageFormDisplay = "";
$messageRows ="";
$dateCreated = "";
$subject ="";

require_once 'Library/ticketDetailsFunction.php';

if (($accountType == "admin") && ($userTicketStatus[0]->attributes()->status == "ongoing")){
   $backPageLink = "admin-page.php";
   $ticketStatusClosebtn  = "style='display:block'";
   $ticketStatusOpenbtn  = "style='display:none'";
}else if(($accountType == "admin") && ($userTicketStatus[0]->attributes()->status == "resolved")){
  $backPageLink = "admin-page.php";
  $ticketStatusClosebtn  = "style='display:none'";
  $ticketStatusOpenbtn  = "style='display:block'";
}
else if (($accountType == "client")){
   $backPageLink = "user-page.php";
   $ticketStatusClosebtn  = "style='display:none;'";
   $ticketStatusOpenbtn  = "style='display:none'";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ticket-System</title>
      <link  rel="stylesheet" type="text/css" href="css/style.css"/ >
  </head>
  <body>
  <?php require_once 'header.php'; ?>
  <main id="login-signup">
    <!--    BACK BUTTON-->
      <div class ="back-link">
        <a href="<?= $backPageLink; ?>" class="backPage">Back to Ticket List</a>
      </div>
      <div>
        <h2>Ticket #<?= $ticketId; ?> Details</h2>
        <p>Ticket Date:<?= $dateCreated; ?> </p>
        <p>Subject: <?= $subject; ?></p>
        <p>Ticket Status: <?= $ticketStatus; ?></p>
      </div>
      <div>
        <h3>Messages:</h3>
        <?php echo $messageRows;?>
      </div>
      <form method="POST" action="" class="messageForm" <?= $ticketMessageFormDisplay; ?> >
          <label for="postMessage">Post a message: </label>
          <textarea class="" type="textbox" name="postMessage" id="postMessage" placeholder="Type your response here"  rows="3" cols="80"></textarea>
          <input type="hidden" name="id" value="<?= $ticketId ?>"/>
          <input type="submit" id="inputBtn" name="submitMessage" value="Send" />
      </form>
      <div class="ticketStatusMessage" >
          <h3>This ticket Status is <?= $ticketStatus; ?></h3>
      </div>
      <div class="closeBtnDiv" <?= $ticketStatusClosebtn ?>>
        <form method="post" action="" >
           <div class= "ticketCloseBtn" >
              <input type="hidden" name="id" value="<?= $ticketId ?>"/>
              <input type="submit" class="closeBtn" name="closeTicket" value="Close Ticket" />
           </div>
        </form>
      </div>
      <div class="closeBtnDiv" <?= $ticketStatusOpenbtn ?>>
      <form method="post" action="">
           <div class="ticketOpenBtn">
              <input type="hidden" name="id" value="<?= $ticketId ?>"/>
              <input type="submit" class="openBtn" name="reOpenTicket" value="Re-Open Ticket" />
           </div>
      </form>
      </div>
  </main>
  <?php require_once 'footer.php'; ?>
  </body>
</html>
