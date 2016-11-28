<html>
    <head>
        <title>Computer Science Advising Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <h1 align="center">**This advising tool is for ODU Computer Science majors only**</a></h1>
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">


                    <p align="center" class="lead">To receive online advising, please complete the following form and an email will be sent with your information to the computer science department advisor.
					Your hold should be removed no later than 4-5 days from the day you submit the form. Please allow 24-48 hours for the changes to be made in LeoOnline.
					To schedule an appointment for an in-person advising session, please email <a href="mailto:csadvising@cs.odu.edu">
                    csadvising@cs.odu.edu</a> or check the<a href = "http://advisor.cs.odu.edu/advise_info_ug.shtml">  advising website </a> for walk-in office hours.
					</p> <br><br>

<?php

function checkField( $value, $reg) {
    return true;
}

/*checks the form, echos error outputs, and returns a boolean.
*/
function valid() {
    $val = true;
    if ( trim($_POST['name']) == '' ) {
        echo 'Please supply your name.<br>';
        $val = false;
    }
    if ( trim($_POST['uin'] == '' ) ) {
        echo 'Please supply your UIN.<br>';
        $val = false;
    }
    if ( !checkField( $_POST['email'], '' ) ) {
        echo 'Please supply a valid CS email address.<br>';
        $val = false;
    }
    return $val;
}
if ( isset( $_POST['name'] ) && valid() ) {
    // process and email the form
    $body = 'Name: ' . $_POST['name'] . "\n" .
                    'UIN: ' . $_POST['uin'] . "\n" .
                    'Email: ' . $_POST['email'] . "\n" .
                    'Semester: ' . $_POST['semester'] . "\n" .
                    'Courses: ';
    $i = 1;             
                    
    while ($i < 7) {
        if ($_POST['course'.$i] == "" ) {
            $i++;
        } else {
            $body .= $_POST['course'.$i] . "; ";
            $i++;
        }   
    }
    
    $body .= "\n" . 'Comments: ' . $_POST['comments'];
    
    mail( 'csadvising@cs.odu.edu', "Online Advising", $body );
    
    ?>
    Your request has been sent to your advisor.
    <?php
}
else {
?>
<form method="post" action="index.php">
<pre>
Name:   <input type="text" name="name" value="<?php echo $_POST['name']; ?>"/> 
UIN:    <input type="text" name="uin" value="<?php echo $_POST['uin']; ?>" />
E-Mail: <input type="text" name="email" value="<?php echo $_POST['email']; ?>" /> (ODU Account Preferred)
<br>
Semester registering for:
<select name="semester">
<option value="spring">Spring</option>
<option value="fall">Fall</option>
<option value="summer">Summer</option>
</select>
<br>
<a href = "http://www.cs.odu.edu/~advisor/advising/course_4yearsplan.shtml">ODU CS Advising Worksheets</a><br>
Courses to be taken (EX: CS 150, CS 250, CS 330):
1.<input type="text" name="course1" value="<?php echo $_POST['course1']; ?>" size=7 /> 2.<input type="text" name="course4" value="<?php echo $_POST['course4']; ?>" size=7 />
3.<input type="text" name="course2" value="<?php echo $_POST['course2']; ?>" size=7 /> 4.<input type="text" name="course5" value="<?php echo $_POST['course5']; ?>" size=7 />
5.<input type="text" name="course3" value="<?php echo $_POST['course3']; ?>" size=7 /> 6.<input type="text" name="course6" value="<?php echo $_POST['course6']; ?>" size=7 />
<br>
Comments/Questions/Concerns: 
<textarea NAME="comments" COLS=40 ROWS=6></textarea>   
<br>
<input type="submit" name="submit" value="Submit" />

</pre>
</form>
<?php } ?>
</body>
</html>
