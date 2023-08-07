<?php require "includes/header.php"; ?>
<?php
require "config.php";
?>

<?php
if (isset($_SESSION['username'])) { //only shows when user logged in
  header("location: index.php");
}

if (isset($_POST['submit'])) { //must have input in each field before inserting data to database
  if ($_POST['email'] == '' or $_POST['username'] == '' or $_POST['password'] == '') {
    echo "Input Missing!";
  } else {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $insert = $conn->prepare("INSERT INTO user_profile (email, username, password) 
    VALUES (:email, :username, :password)");

    $insert->execute([
      ':email' => $email,
      ':username' => $username,
      ':password' => password_hash($password, PASSWORD_DEFAULT),
    ]);
  }
}
?>

<div class="">
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Welcome to <br />
            <span class="text-dark">COF Roomie</span>
          </h1>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form method="POST" action="register.php">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Userame</label>
                  <input name="username" type="username" id="inputPassword5" class="form-control"
                    aria-labelledby="passwordHelpBlock" placeholder="witroomie" />
                </div>


                <!-- Email input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Email</label>
                  <input name="email" type="email" class="form-control" id="exampleFormControlInput1"
                    placeholder="name@example.edu" />

                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input name="password" type="password" id="inputPassword5" class="form-control"
                    aria-labelledby="passwordHelpBlock" placeholder="Password" />
                </div>
                <div id="passwordHelpBlock" class="form-text">
                  Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces,
                  special
                  characters, or emoji.
                </div>

                <!-- Submit button -->
                <div class="text-center  mt-4 pt-2">
                  <button name="submit" type="submit" class="btn btn-primary btn-block mb-4">
                    Sign up
                  </button>
                  <p class="small fw-bold mt-2 pt-1 mb-0">Aleardy have an account? <a class="link-danger"
                      href="login.php">Login</a>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--
<main class="form-signin w-50 m-auto mt-5 pt-5">
  <form method="POST" action="register.php">
    <h1 class="text-center">Ready to join the community? Register now!</h1>
    <hr class="border border-danger border-2 opacity-50">

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleFormControlInput1"
        placeholder="name@example.edu">
    </div>
    <div class="mb-3">
      <label for="inputPassword5" class="form-label">Username</label>
      <input name="username" type="username" id="inputPassword5" class="form-control"
        aria-labelledby="passwordHelpBlock" placeholder="Username">
    </div>
    <div class="mb-3">
      <label for="inputPassword5" class="form-label">Password</label>
      <input name="password" type="password" id="inputPassword5" class="form-control"
        aria-labelledby="passwordHelpBlock" placeholder="Password">
    </div>
    <div id="passwordHelpBlock" class="form-text">
      Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special
      characters, or emoji.
    </div>
    <div class="text-center  mt-4 pt-2">
      <button name="submit" type="submit" class="btn btn-primary btn-lg">Register</button>
      <p class="small fw-bold mt-2 pt-1 mb-0">Aleardy have an account? <a class="link-danger" href="login.php">Login</a>
      </p>
    </div>
  </form>
-->
<?php require "includes/footer.php"; ?>