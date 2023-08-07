<?php

require "config.php";

if (isset($_POST['delete'])) {
    $id = $_POST['id']; //post index

    $delete = $conn->prepare("DELETE FROM comments WHERE id = '$id'"); //trigger delete comment if delete button has been clicked
    $delete->execute();
}