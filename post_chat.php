<?php
session_start();
if (isset($_SESSION['name'])) { //if user is in the chat save the text into log
    $text = $_POST['text'];

    date_default_timezone_set('EST'); //timezone
    $date = new DateTimeImmutable();

    $text_message = "<div class='msgln'><span class='chat-time'>" . date("G:i:s A") . "</span> <b class='user-name'>" . $_SESSION['name'] . "</b> " . stripslashes(htmlspecialchars($text)) . "<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX); //return text from log
}
?>