<?php 
// Email configuration 
$toEmail = 'info.kliqoo@gmail.com'; 
$fromName = 'Sender Name'; 
$formEmail = 'sender@example.com'; 
 
$postData = $statusMsg = $valErr = ''; 
$status = 'error'; 
 
// If the form is submitted 
if(isset($_POST['submit'])){ 
    // Get the submitted form data 
    $postData = $_POST; 
    $name = trim($_POST['name']); 
    $email = trim($_POST['email']); 
    $moblie = trim($_POST['moblie']); 
    $message = trim($_POST['message']); 
     
    // Validate form fields 
    if(empty($name)){ 
         $valErr .= 'Please enter your name.<br/>'; 
    } 
    if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){ 
        $valErr .= 'Please enter a valid email.<br/>'; 
    } 
    if(empty($moblie)){ 
        $valErr .= 'Please enter mobile.<br/>'; 
    } 
    if(empty($message)){ 
        $valErr .= 'Please enter your message.<br/>'; 
    } 
     
    if(empty($valErr)){ 
        // Send email notification to the site admin 
        $moblie = 'New contact request submitted'; 
        $htmlContent = " 
            <h2>Contact Request Details</h2> 
            <p><b>Name: </b>".$name."</p> 
            <p><b>Email: </b>".$email."</p> 
            <p><b>Mobile: </b>".$moblie."</p> 
            <p><b>Message: </b>".$message."</p> 
        "; 
         
        // Always set content-type when sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        // Header for sender info 
        $headers .= 'From:'.$fromName.' <'.$formEmail.'>' . "\r\n"; 
         
        // Send email 
        @mail($toEmail, $moblie, $htmlContent, $headers); 
         
        $status = 'success'; 
        $statusMsg = 'Thank you! Your contact request has submitted successfully, we will get back to you soon.'; 
        $postData = ''; 
    }else{ 
        $statusMsg = '<p>Please fill all the mandatory fields:</p>'.trim($valErr, '<br/>'); 
    } 
}