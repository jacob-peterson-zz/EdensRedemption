<?php
/*
 *  CONFIGURE EVERYTHING HERE
 */
require 'PHPMailer-master/PHPMailerAutoload.php';

// an email address that will be in the From field of the email.
$fromEmail = 'jpeterson1996@gmail.com';
$fromName = 'Website';
// an email address that will receive the email with the output of the form
$sendToEmail = 'jpeterson1996@gmail.com';
sendToName = 'Jacob Peterson'

// subject of the email
$subject = 'New yard work job!';

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('firstname' => 'First Name', 'lastname' => 'Last Name', 'address1' => 'Address 1', 'address2' => 'Address 2', 'city' => 'City', 'state' => 'State', 'zip' => 'Zip Code', 'phone' => 'Phone Number', 'email' => 'Email Address', 'date' => 'Date', 'window' => 'Window Washing', 'gutter' => 'Gutter Cleaning', 'yard' => 'Yard Maintenance', 'wall' => 'Retaining Wall', 'other' => 'Other', 'description' => 'Description of Work'); 

// message that will be displayed when everything is OK :)
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

/*
 *  LET'S DO THE SENDING
 */

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(0);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "You have a new message from your contact form\n=============================\n";
    $emailText .= "<table>";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($fields[$key])) {
            $emailText .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
        }
    }
    $emailText .= "</table><hr>";
    $emailText .= "<p>Get to work!<br>Blessings,<br>Your Boss</p>";
    
    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    $mail = new PHPMailer;
    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($sendtoEmail, $sendToName);
    $mail->addReplyTo($from);
    
    // Send email
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->msgHTML($emailText);

    if(!$mail->send()) {
        throw new \Exception('I could not send the email.' . $mail->ErrorInfo);
    }
    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}