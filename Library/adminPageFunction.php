<?php
//INITIALIZE TABLE ROW TO DISPLAY THE TICKET LIST
$ticketRows = '';
//LOAD THE TICKET XML FILE
$ticketDoc = simplexml_load_file("xml/ticket.xml");
//LOOP THROUGH ALL THE TICKETS IN THE XML FILE AND DISPLAY IT ON THE ADMIN PAGE
foreach ($ticketDoc->children() as $t) {
    $ticketId = $t->attributes()['ticketid'];
    $ticketRows .= '<tr>';
    $ticketRows .= '<td>'.$t->attributes()['ticketid'].'</td>';
    $ticketRows .= '<td>'. $t->subject .'</td>'
        .'<td>'.$t->datetime .'</td>';
    $ticketRows .= '<td>'.$t->attributes()['userid'].'</td>';
    $ticketRows .= '<td>'.$t->attributes()['status'].'</td>';
    $ticketRows .= '<td>'. '<form action="./ticketDetails.php" method="POST">
                        <input type="hidden" name="id" value="' . $ticketId . '"/>
                        <input type="submit" class="ticketDetailsBtn" name="ticketDetails" value="View Ticket"/>
                    </form>'.'</td>';
    $ticketRows .= '</tr>';

}
