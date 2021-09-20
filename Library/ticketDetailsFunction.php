<?php

//LOAD BOTH THE USER AND THE TICKET XML FILE TO DISPLAY BOTH INFORMATION
$ticketInfoDoc = simplexml_load_file("xml/ticket.xml");
$ticketInfoDoc->preserveWhiteSpace = false;
$ticketInfoDoc->formatOutput = true;
$userInfoDoc = simplexml_load_file("xml/user.xml");
$userInfoDoc->preserveWhiteSpace = false;
$userInfoDoc->formatOutput = true;

//SOTRE THE XPATH OF THE A PATICULAR TICKET BY GRABBING THE TICKET ID
$userTicketDetails = $ticketInfoDoc->xpath("//ticket[@ticketid ='$ticketId']");
//var_dump($userTicketDetails);
//INITIALIZE THE TICKET MESSAGE FOROM VARIABLE
$ticketMessageFormDisplay = "";
$messageRows ="";
$dateCreated = "";
$subject ="";
$ticketStatusToggle ="";
//LOOP THROUGH THE XML BASED ON XPATH TO DISPLAY THAT PARTICULAT TICKET BASED ON TICKET ID
foreach ($userTicketDetails as $ticket){
    $ticketId = $ticket->attributes()['ticketid'];
    $userId = $ticket->attributes()['userid'];
    $subject = $ticket->subject;
    $dateCreated = $ticket->datetime;
    $ticketStatus = $ticket->attributes()['status'];
    $messageText = $ticket->messages->message;
     $senderId = $messageText->attributes()['senderid'];
    $timestamp= $messageText->attributes()['timestamp'];
}
//STORE THE XPATH OF THE A PARTICULAR TICKET MESSAGES TO BE LOOPED AND DISPLAYED
$messageDetails =  $ticketInfoDoc->xpath("//ticket[@ticketid='$ticketId']//message");
//STORE THE XPATH OF THE A PARTICULAR TICKET MESSAGES TO BE LOOPED AND DISPLAYED
foreach ($messageDetails as $message){
    $messageRows .= '<div class="messageText">';
    $messageRows .= '<p class="senderId">Sender Id:'  . $message->attributes()['senderid'] . '</p>';
    $messageRows .= '<p class="dateSent">'  . $message->attributes()['timestamp'] . '</p>';
    $messageRows .= '<p class="messageBox">'  . $message . '</p>';
    $messageRows .= '</div>';
}
//STORE THE XPATH OF THE A PARTICULAR TICKET MESSAGE CHILD OF THE TICKET XML TO ADD NEW MESSAGE  TO THE XML AND AND DISLAYED
$messageSection =  $ticketInfoDoc->xpath("//ticket[@ticketid='$ticketId']/messages");
$userTicketStatus = $ticketInfoDoc->xpath("//ticket[@ticketid ='$ticketId']");
//WHEN CLOSE TICKET BUTTUON IS CLICKED BY ADMIN USER, THE MESSAGE FORM WILL DIAPPEAR TO DEACTIVATE CHAT AND THE STATUS OF THE TICKET WILL CHANGE TO RESOLVED
//HAVING ISSUES WITH THE PAGE REFRESH BUT THE TICKET STATUS AND BUTTONS GETS UPDATED
// $ticketStatusToggle =
if (isset($_POST["closeTicket"])){
     $userTicketStatus[0]->attributes()->status = "resolved";
        $ticketInfoDoc->asXML("xml/ticket.xml");
        $ticketStatusOpenbtn = "style='display:block'";
        $ticketStatusClosebtn = "style='display:none'";
        $ticketMessageFormDisplay = "style='display:none'";
          header("Location :./admin-page.php");
}
//WHEN OPEN TICKET BUTTUON IS CLICKED BY ADMIN USER, THE MESSAGE FORM WILL REAPPEAR TO ACTIVATE CHAT AND THE STATUS OF THE TICKET WILL CHANGE TO ONGOING AGAIN
//HAVING ISSUES WITH THE PAGE REFRESH BUT THE TICKET STATUS AND BUTTONS GETS UPDATED

if (isset($_POST["reOpenTicket"])){
    $_SESSION['post-data']['id'] = $_POST["id"];

    $userTicketStatus[0]->attributes()->status = "ongoing";
    $ticketInfoDoc->asXML("xml/ticket.xml");
    $ticketStatusOpenbtn = "style='display:none'";
    $ticketStatusClosebtn = "style='display:block'";
    $ticketMessageFormDisplay = "style='display:block'";
    header("Location :./admin-page.php");

}

if($userTicketStatus[0]->attributes()->status == "ongoing"){
  $ticketStatusOpenbtn = "style='display:none'";
  $ticketStatusClosebtn = "style='display:block'";
  $ticketMessageFormDisplay = "style='display:block'";
    header("Location :./admin-page.php");
}else{
  $ticketStatusOpenbtn = "style='display:block'";
  $ticketStatusClosebtn = "style='display:none'";
  $ticketMessageFormDisplay = "style='display:none'";
    header("Location :./admin-page.php");
}


//WHEN SUBMIT MESSAGE IS CLICKED BY ADMIN OR USER , THE MESSAGEWILL BE ADDED AND STORED IN THE TICKET XML FILE OF THAT PERTCULAR USER AND WILL BE DISPLAYED
//HAVING ISSUES WITH THE PAGE REFRESH BUT THE TICKET MESSAGE GETS AddED AND UPDATED
//ALSO LOSING THE TICKET ID SESSION ONCE THE PAGE REFRESHES.I tried trouble shooting it but will need more time to evntually figure it out
if (isset($_POST["submitMessage"])){
    (string)$senderId = $_SESSION['userid'];
    $newMessage= $_POST["postMessage"];
    $messageDate = new DateTime("NOW", new DateTimeZone('America/Toronto'));
    if (empty($newtMessage)){
        $error = "Please input a message.";
    }else{
        $error = "";
    }
    foreach($messageSection as $newMessagePost){
       $message = $newMessagePost->addChild('message',$newMessage);
       $message->addAttribute('senderid', $senderId);
       $message->addAttribute('timestamp',$messageDate->format('Y-m-d\TH:i:s') );

        $ticketInfoDoc->asXML("xml/ticket.xml");

        if( $ticketInfoDoc->asXML("xml/ticket.xml")){
          header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
     exit();
        }
    }
}
