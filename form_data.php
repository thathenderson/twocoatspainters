<?php
    if(isset($_POST['mail'])) {
          
        // EDIT THE 2 LINES BELOW AS REQUIRED
        $email_to = "hello@themestreet.net";
        $email_subject = "Contact from SANO template";
         
        
        $name = $_POST['name']; // required
        $email_from = $_POST['mail']; // required
        $text = $_POST['message']; // required
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $number = $_POST['number'];
        $department = $_POST['department'];
        $date = $_POST['date'];

        $email_message = "Message from Website: \n\n";
         
        function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
        }
         
        $email_message .= "First Name: ".clean_string($name)."\n";
        $email_message .= "Last Name: ".clean_string($lastname)."\n";
        $email_message .= "Email: ".clean_string($email_from)."\n";
        $email_message .= "Phone: ".clean_string($phone)."\n";
        $email_message .= "SSIN: ".clean_string($number)."\n";
        $email_message .= "Department: ".clean_string($department)."\n";
        $email_message .= "Date: ".clean_string($date)."\n";
        $email_message .= "Message: ".clean_string($text)."\n";
         
         
    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    if(@mail($email_to, $email_subject, $email_message, $headers)) {
        $data['status'] = TRUE;
        $data['msg'] = 'E-mail has been sent!';
        $data['class'] = 'success';
    } else {
        $data['status'] = FALSE;
        $data['msg'] = 'Your e-mail has not been sent!';
        $data['class'] = 'error';
    }
    
    echo json_encode($data);
}
?>