<?php require "includes/header.php"; ?>
<?php
require "config.php";
?>

<?php
if (!isset($_SESSION['username'])) {
  header("location: forum.php");
}

if (isset($_POST['submit'])) {
  if ($_POST['title'] == '' or $_POST['body'] == '') {
    echo "Input Missing!";
  } else {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $username = $_SESSION['username'];

    $insert = $conn->prepare("INSERT INTO user_post (title, body, username)
      VALUES (:title, :body, :username)");

    $insert->execute([
      ':title' => $title,
      ':body' => $body,
      ':username' => $username,
    ]);
    echo "<script>window.location.href='forum.php'</script>";

  }
}
?>

<div class="form-signin w-50 m-auto mt-5">
  <form method="POST" action="create_post.php">
    <h1 class="text-center">Create Post</h1>
    <hr class="border border-danger border-2 opacity-50">
    <div>
      <input name="title" type="text" id="inputPassword5" class="form-control" aria-labelledby="passwordHelpBlock"
        placeholder="Title">
      <label for="exampleFormControlInput1" class="form-label"></label>
    </div>
    <div>
      <input name="username" type="hidden" placeholder="username">
    </div>
    <div>
      <textarea rows="9" name="body" id="inputPassword5" class="form-control" aria-labelledby="passwordHelpBlock"
        placeholder="Write something..."></textarea>
      <label for="exampleFormControlInput1" class="form-label"></label>
    </div>
    <div class="text-center  mt-2 pt-2">
      <button name="submit" type="submit" class="btn btn-primary">Create Post</button>
    </div>
  </form>
</div>
<?php require "includes/footer.php"; ?>