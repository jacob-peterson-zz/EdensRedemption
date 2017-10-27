<?php

//Extract all inputs
if (isset($_POST["submit"])) {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $window = $_POST['window'];
    $gutter = $_POST['gutter'];
    $yard = $_POST['yard'];
    $wall = $_POST['wall'];
    $other = $_POST['other'];
    $description = $_POST['description'];
    $workers = $_POST['workers'];
    $valid = $_POST['valid'];
    $submit = $_POST['submit'];
    $tools = $_POST['tools'];
}


$from = $email; 
$to = 'edensredemption@gmail.com'; 
$subject = 'New Job Request from Edens Website!';
 
$body = "From: $first $last\n E-Mail: $email\n Address: $address1 $address2 $city $state $zip\n Phone number: $phone\n Desired work date: $date\n Work to be done:\n $window $gutter $yard $wall $other\n Description of work:\n $description\n Tools that we need to provide: $tools\n Number of workers requested: $workers\n\n Sincerely,\n\n Eden's Redemption";

//Validate
if (empty(str_ireplace(' ','',$first)) || empty(str_ireplace(' ','',$last)) || empty(str_ireplace(' ','',$address1)) || empty(str_ireplace(' ','',$city)) || empty(str_ireplace(' ','',$state)) || empty(str_ireplace(' ','',$phone)) || empty(str_ireplace(' ','',$email)) || empty(str_ireplace(' ','',$date)) || empty(str_ireplace(' ','',$description))) {

    header('Location: error.html', false, 302);
    exit; // Ensures, that there is no code _after_ the redirect executed
}
// If there are no errors, send the email
if (mail ($to, $subject, $body, $from)) {
    header('Location: thanks.html', false, 302);
    exit; // Ensures, that there is no code _after_ the redirect executed
}
?>