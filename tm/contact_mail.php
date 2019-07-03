<?php
$toEmail = "alex@bizngine.com,jack@bizngine.com";
$mailHeaders = "From: " . $_POST["firstname"] . "<". $_POST["email"] .">\r\n";
if(mail($toEmail, $_POST["subject"], $_POST["content"], $mailHeaders)) {
print "<p class='success'>Contact Mail Sent.</p>";
} else {
print "<p class='Error'>Problem in Sending Mail.</p>";
}
?>