<?php
    if(isset($_POST['mail'])) {

      // EDIT THE 2 LINES BELOW AS REQUIRED
      $email_to = "paintingforward@gmail.com";
      $email_subject = "Contact from Twocoatspainters.com form";


      $name = $_POST['name']; // required
      $email_from = $_POST['mail']; // required
      $text = $_POST['message']; // required
      $lastname = $_POST['lastname'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $date = $_POST['date'];
      $rawService = $_POST['e2'];

      $serviceArray = [
        "0" => "No Service selected",
        "1" => "Exterior",
        "2" => "Interior",
        "3" => "Powerwashing",
        "4" => "Patchwork",
        "5" => "Exterior and Interior"
      ];

      $service = $serviceArray[$rawService];

      $email_message = "Message from Twocoatspainters.com: \n\n";

      function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
      }

      $email_message .= "First Name: ".clean_string($name)."\n";
      $email_message .= "Last Name: ".clean_string($lastname)."\n";
      $email_message .= "Email: ".clean_string($email_from)."\n";
      $email_message .= "Phone: ".clean_string($phone)."\n";
      $email_message .= "Service: ".clean_string($service)."\n";
      $email_message .= "Address: ".clean_string($address)."\n";
      $email_message .= "Date: ".clean_string($date)."\n";
      $email_message .= "Message: ".clean_string($text)."\n";


    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $mailsend = mail($email_to, $email_subject, $email_message, $headers);

    if($mailsend) {
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
