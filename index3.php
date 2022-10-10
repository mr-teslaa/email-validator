<?php
$status = $statusmessage = '';

if (isset($_POST['submit'])) {
    if (!empty($_POST['email'])) {
        // Include library file
        require_once 'validateemailclass.php';

        // Initialize library class
        $mail = new VerifyEmail();

        // Set the timeout value on stream
        $mail->setStreamTimeoutWait(20);

        // Set debug output mode
        // $mail->Debug= true;
        // $mail->Debugoutput= 'html';

        // Set email address for SMTP request
        $mail->setEmailFrom('sayhi@hossainfoysal.com');

        // Email to check
        $email = $_POST['email'];

        // Check if email is valid and exist
        if ($mail->check($email)) {
            $status = 'success';
            $statusmessage = 'Email &lt;'.$email.'&gt; is exist!';
        } elseif (verifyEmail::validate($email)) {
            $status = 'error';
            $statusmessage = 'Email &lt;'.$email.'&gt; is valid, but not exist!';
        } else {
            $status = 'error';
            $statusmessage = 'Email &lt;'.$email.'&gt; is not valid and not exist!';
        }
    } else {
        $status = 'error';
        $statusmessage = 'Enter the email to verify';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Check</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            max-width: 998px;
            margin: auto;
            font-family: 'Poppins', sans-serif;
        }

        h1 { margin-top: 3rem; }

        form {
            max-width: 480px;
            margin-top: 1rem;
        }

        input[type="email"] {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #000;
            width: 100%;
            font-size: 1.2rem;
        }

        .button {
            margin: 1rem 0 0;
            padding: 0.5rem 1.5rem;
            background: yellow;
            border: 2px solid #000;
            font-size: 1.2rem;
            transition: all 0.4s ease-in-out;
        }

        .button:hover {
            background-color: #000;
            border-color: yellow;
            color: yellow;
        }

        .status{
            color: #fff;
            padding: 1rem 0.75rem;
            border-radius: 0.4rem;
        }

        .error {
            background-color: red;
        }
        
        .success {
            background-color: green;
        }
    </style>
</head>
<body>
    <h1>
        Email validator - Developed by 
        <a href="https://hossainfoysal.com">Hossain Foysal</a>
    </h1>
    <p class="status <?php echo $status; ?>"> <?php echo $statusmessage; ?> </p>
    <form action="" method="POST">
        
        <input type="email" name="email" placeholder="Enter the email to verify" />
        <input type="submit" name="submit" class="button" value="Verify this email" />
    </form>
</body>
</html>