<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "update_trust";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT email, username, password FROM donations JOIN users ON donations.user_id = users.id";
$result = $conn->query($sql);

$emailArray = array(); 

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emailArray[] = array(
            'email' => $row["email"],
            'username' => $row["username"],
            'password' => $row["password"]
        );
    }

    echo "<pre>";
    print_r($emailArray);
    echo "</pre>";

    foreach ($emailArray as $recipientData) {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ppprakash1818@gmail.com'; 
            $mail->Password = 'mhje pqtz zeok pkct'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('ppprakash1818@gmail.com');  
            $mail->isHTML(true);

            $mail->addAddress($recipientData['email']);

            $mail->Subject = 'Thank You for Your Donation';

            $body = "Dear Friend,<br><br>
            <div class='animated-text'>
                <span class='text'>Thank you for your donation.</span>
                <span class='text'>On this special day, we wish you all the joy, health, and success in the world.</span>
                <span class='text'>Your login details:</span>
                <span class='text'>Username: {$recipientData['username']}</span>
                <span class='text'>Password: {$recipientData['password']}</span>
                <span class='text'>May your day be filled with love, laughter, and wonderful surprises.</span>
                <span class='text'>Best regards,</span>
                <span class='text'>LIBS CHARITY<br>Email: info@libscharity.com<br>Phone: 7654321456, 7654321456<br>Website: libscharity.com</span>
            </div>";

            $mail->Body = $body;
            $mail->send();

            echo "Email sent to {$recipientData['email']} successfully.<br>";
        } catch (Exception $e) {
            echo "Error: Message could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
        }
    }
}

$conn->close();
?>
