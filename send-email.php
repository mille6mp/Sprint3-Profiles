<?php
// Load the AWS SDK for PHP
require 'vendor/autoload.php';

// Import the necessary classes from the SDK
use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

// Set up the sender email address
$sender = 'sender@example.com'; // replace with your own email address

// Set the recipient email address
$recipient = 'recipient@example.com'; // replace with the actual email address

// Set the subject line of the email
$subject = 'Your Subject Line'; // replace with your own subject line

// Set the body of the email
$body = 'This is a test email.'; // replace with your own email content

// Create an SES client with your AWS access key and secret key
$sesClient = new SesClient([
    'version' => 'latest', // use the latest version of the SDK
    'region'  => 'us-east-1', // replace with your own AWS region
    'credentials' => [
        'key'    => 'your-aws-access-key', // replace with your own AWS access key
        'secret' => 'your-aws-secret-key', // replace with your own AWS secret key
    ],
]);

try {
    // Use the SES client to send the email
    $result = $sesClient->sendEmail([
        'Destination' => [
            'ToAddresses' => [$recipient], // set the recipient email address
        ],
        'Message' => [
            'Body' => [
                'Text' => [
                    'Charset' => 'UTF-8',
                    'Data' => $body, // set the body of the email
                ],
            ],
            'Subject' => [
                'Charset' => 'UTF-8',
                'Data' => $subject, // set the subject line of the email
            ],
        ],
        'Source' => $sender, // set the sender email address
    ]);
    // Print a success message if the email was sent successfully
    echo "Email sent to $recipient";
} catch (AwsException $e) {
    // Handle any errors that occurred while sending the email
    echo "Error sending email: " . $e->getMessage();
}
?>
