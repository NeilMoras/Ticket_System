<?php
//INITIALIZE THE VARIABLE TO DISPLAY THE TICKEY LIST OF A PARTICULAR USER
$ticketRows = '';
//LOAD THE TICKET XML FILE
$ticketDoc = simplexml_load_file("xml/ticket.xml");
$ticketDoc->preserveWhiteSpace = false;
$ticketDoc->formatOutput = true;
//USE XPATH TO GRAB TICKET OF THE USER AND USE SESSION USER ID TO GRAB THE TICKETS ONLY OF THAT PARTICULAR USER
$userTicketList = $ticketDoc->xpath("//ticket[@userid= '$userId']");
//LOOP THROUGH THE XML FILE USING THE ABOVE XPATH TO DISPLAY THE PARTICULATR USER TICKET
foreach ($userTicketList as $ticket) {
    $ticketRows .= '<tr>';
    $ticketRows .= '<td>'.$ticket->attributes()['ticketid'].'</td>';
    $ticketRows .= '<td>'. $ticket->subject .'</td>'
        .'<td>'.$ticket->datetime .'</td>';
    $ticketRows .= '<td>'.$ticket->attributes()['userid'].'</td>';
    $ticketRows .= '<td>'.$ticket->attributes()['status'].'</td>';
    $ticketRows .= '<td>'. '<form action="./ticketDetails.php" method="POST">
                        <input type="hidden" name="id" value="' . $ticket->attributes()['ticketid'] . '"/>
                        <input type="submit" class="ticketDetailsBtn" name="ticketDetails" value="View Ticket"/>
                    </form>'.'</td>';
    $ticketRows .= '</tr>';
//    var_dump($ticket->attributes()['status']);
}

if(isset($_POST["submitTicket"])){

    $subject = $_POST["subject"];
    $postMessage = $_POST["postMessage"];
    $date = new DateTime("NOW", new DateTimeZone('America/Toronto'));

    $ticketDoc = simplexml_load_file("xml/ticket.xml");
    $newTicket = $ticketDoc->addChild('ticket');
    $newTicket->addAttribute('userid', $userId);
    $newTicket->addAttribute('ticketid', rand(100, 200));
    $newTicket->addAttribute('status', 'ongoing');
    $newTicket->addChild('subject', $subject);
    $newTicket->addChild('datetime', $date->format('Y-m-d\TH:i:s'));
    $messages = $newTicket->addChild('messages');
    $message = $messages->addChild('message', $postMessage);
    $message->addAttribute('senderid', $userId);
    $message->addAttribute('timestamp', $date->format('Y-m-d\TH:i:s'));

    $ticketDoc->asXML("xml/ticket.xml");




    if( $ticketDoc->asXML("xml/ticket.xml")){
        echo "success";
    }else{
        echo "something went wrong";
    }

}
?>
