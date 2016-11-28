<?php

// configure
$from = 'Demo contact form <demo@domain.com>'; 
$sendTo = 'csadvising@cs.odu.edu';
$subject = 'Online Advising';
$fields = array('name' => 'Name', 
                'surname' => 'Surname', 
                'uin' => 'UIN', 
                'email' => 'Email',
                'semester' => "Semester",
                'courses' => "Courses", 
                'message' => 'Message'); // array variable name => Text to appear in email

$okMessage = 'Form successfully submitted. Thank you, we will remove your hold as soon as possible';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// let's do the sending

try
{
    $emailText = "Online advising hold submission form\n=============================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    mail($sendTo, $subject, $emailText);

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);
    
    header('Content-Type: application/json');
    
    echo $encoded;
}
else {
    echo $responseArray['message'];
}
