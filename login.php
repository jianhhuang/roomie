<?php require "includes/header.php"; ?>
<?php
require "config.php";
?>

<?php
// Check database and fetch data
if (isset($_SESSION['username'])) { //display when user is logged in
  header('Location: index.php');
}

if (isset($_POST['submit'])) { //user must type in their account information to login
  if ($_POST['email'] == '' or $_POST['password'] == '') {
    echo "Input Missing!";
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = $conn->query("SELECT * FROM user_profile WHERE email = '$email'"); //retun existing account

    $login->execute();

    $data = $login->fetch(PDO::FETCH_ASSOC);


    if ($login->rowCount() > 0) { //if password doesn't match return nothing
      if (password_verify($password, $data['password'])) {

        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        header('Location: index.php');

      } else {
        echo "Email or Password is wrong!";
      }

    } else {
      echo "Duplicate!";
    }
  }
}
?>

<div class="vh-100" style="background-color: #00ffff	;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="logo/roomie_logo.png" alt="login form" class="img-fluid"
                style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="POST" action="login.php">



                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleFormControlInput1"
                      placeholder="name@example.edu">
                  </div>

                  <div class="form-outline mb-4">
                    <label for="inputPassword5" class="form-label">Password</label>
                    <input name="password" type="password" id="inputPassword5" class="form-control"
                      aria-labelledby="passwordHelpBlock" placeholder="Password">
                  </div>

                  <div class="pt-1 mb-4">
                    <button name="submit" type="submit" class="btn btn-dark btn-lg btn-block" type="button">Sign
                      In</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a class="link-danger"
                      href="register.php" style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="gap" class="form-signin w-50 m-auto mt-5">
  <form method="POST" action="login.php">
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleFormControlInput1"
        placeholder="name@example.edu">
    </div>

    <div class="mb-3">
      <label for="inputPassword5" class="form-label">Password</label>
      <input name="password" type="password" id="inputPassword5" class="form-control"
        aria-labelledby="passwordHelpBlock" placeholder="Password">
    </div>

</div>
<div class="text-center  mt-4 pt-2">
  <button name="submit" type="submit" class="btn btn-primary btn-lg">Sign in</button>
  <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a class="link-danger" href="register.php">Register</a>
  </p>
  <a href="#!" class="text-body">Forgot password?</a>
</div>
</form>

</div>
<?php require "includes/footer.php"; ?>