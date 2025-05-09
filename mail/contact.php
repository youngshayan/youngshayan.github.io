<?php
if (
    empty($_POST['name']) ||
    empty($_POST['subject']) ||
    empty($_POST['message']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    http_response_code(400); // Bad Request
    exit("Invalid form data.");
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "theyoungshayan@gmail.com";
$subject = "$m_subject: $name";
$body = "You have received a new message from your website contact form.\n\n".
        "Here are the details:\n\n".
        "Name: $name\n".
        "Email: $email\n".
        "Subject: $m_subject\n".
        "Message: $message";

$header = "From: no-reply@yourdomain.com\r\n"; // Use a verified domain email
$header .= "Reply-To: $email\r\n";

// Send the email
if (!mail($to, $subject, $body, $header)) {
    http_response_code(500);
    exit("Mail sending failed.");
}

http_response_code(200);
echo "Message sent successfully.";
?>
