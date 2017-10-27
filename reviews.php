<?php
$link = mysqli_connect("edensredemptioncom.ipagemysql.com","edensredemption","Pet3rson#54") or die("failed to connect to server!!");
mysqli_select_db($link,"reviews");
if(isset($_REQUEST['submit'])) {
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $date=date("Y/m/d");
    $stars=$_POST['star'];
    $comment=$_POST['comment'];
 
    // Validation will be added here
    if (empty($firstname) || empty($lastname) || empty($stars) || empty($comment)){
         header('Location: error.html', false, 302);
        exit; // Ensures, that there is no code _after_ the redirect executed
    }
}
//Inserting record in table using INSERT query
         $insqDbtb="INSERT INTO `reviews`.`members`
         (`firstname`, `lastname`, `date`, `stars`, `comment`) VALUES ('$firstname', '$lastname', '$date', '$stars', '$comment')";
         mysqli_query($link,$insqDbtb) or die(mysqli_error($link));
        header('Location: thanksr.html', false, 302);
        exit; // Ensures, that there is no code _after_ the redirect executed

?>