<?php
/**
 * this is the demo for Mail
 */

$from = 'yuanyangen@test.cn';
$to = 'yuanyangen@test1.com';
$subject = "title";
$body = 'this is a simple test';
$mail = new \PHPMailUtil\Mail($to, $from, $subject, $body);
$filePath1 = '/tmp/1';
$filePath1 = '/tmp/2';
$mail->addAttachment($filePath1);
$mail->addAttachment($filePath2);
$flag = $mail->send();
