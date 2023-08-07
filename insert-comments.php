<?php require "includes/header.php"; ?>
<?php
require "config.php";
?>

<?php
//trigger when submit button has been clicked and insert data into database
if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $id = $_POST['post_id'];
  $comment = $_POST['comment'];

  $insert = $conn->prepare("INSERT INTO comments (username, post_id, comment)
    VALUES (:username, :post_id, :comment)");

  $insert->execute([
    ':username' => $username,
    ':post_id' => $id,
    ':comment' => $comment,
  ]);
}

?>