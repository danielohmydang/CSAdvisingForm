<? php

/** Initialize Variabels **/
$from = 'Demo contact form <demo@domain.com>';
$sendTo = 'csadvising@cs.odu.edu';
$subject = 'Online Advising Form Submission';

// array variable name => Text to appear in email
$fields = array('name' => 'Name', 
				'surname' => 'Surname', 
				'email' => 'Email', 
				'uin' => 'UIN', 
				'semester' => 'Semester',
				'courses' => 'Courses',
				'message' => 'Message');

$okMessage = 'Form successfully submitted. Thank you, your hold will be removed as soon as possible';
$errorMessage = 'There was an error while submitting the form. Please try again later';

/** Sending of the email **/
try
{
	$emailText = "You have a new online advisingn form submission\n=============================\n";

	//iterate through array to check if it's empty
	foreach ($POST as $key => $value) {
		if(isset($fields[$key])) {
			$emailText .= "$fields[$key]: $value\n";
		}
	}

	//send the email
	mail($sendTo, $subject, $emailText, "From: " . $from);

	//confirms successfull message
	$responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
	//error message
	$responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

//JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);
    
    header('Content-Type: application/json');
    
    echo $encoded;
}
else {
    echo $responseArray['message'];
}