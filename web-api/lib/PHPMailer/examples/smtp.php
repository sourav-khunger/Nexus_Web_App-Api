<?php
    $smtpHost = "mail.nexus.com";
	$smtpPort = "587";
	$smtpUsername = "team@nexus.in";
	$smtpPassword = "lQ6LXMemS~Tc";
	$smtpFrom = "Nexus@nexus.in";
	$smtpReplyTo = "team@nexus.in";

/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//require '../PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
//$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = $smtpHost;
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = $smtpPort;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = $smtpUsername;
//Password to use for SMTP authentication
$mail->Password = $smtpPassword;
//Set who the message is to be sent from
$mail->setFrom($smtpFrom, $siteTitle);
//Set an alternative reply-to address
$mail->addReplyTo($smtpReplyTo, $siteTitle);
//Set who the message is to be sent to