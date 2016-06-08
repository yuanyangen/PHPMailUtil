# introduction

这个是对于php的mail函数的简单封装， 支持发件人， 收件人， 添加附件

感谢郭老师提供最初的源码
this is a simple encapsulation of php mail function

---

# demo

```
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

```