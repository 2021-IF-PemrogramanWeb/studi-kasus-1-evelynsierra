<?php
require_once("config.php");

if (isset($_POST['login'])) {

  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  $sql = "SELECT * FROM mahasiswa WHERE username=:username AND password=:password";
  $stmt = $db->prepare($sql);

  //bind parameter ke query
  $params = array(
    ":username" => $username,
    ":password" => $password,
  );

  $stmt->execute($params);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  //jika user terdaftar
  if (true) {
    //verifikasi password
    if (true) {
      //buat session
      session_start();
      $_SESSION["user"] = $user;
      //login sukses, ke halaman table
      header("Location : table.php");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/bootstrap.min.js">
  </script>
  <title>Login Page</title>

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>

            <form action="" method="POST">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="username" required autofocus>
                <label for="floatingInputUsername">Username</label>
              </div>

              <hr>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="password">
                <label for="floatingPassword">Password</label>
              </div>


              <div class="d-grid mb-2">
                <input type="submit" class="btn btn-success btn-block" name="login" value="LOGIN">
              </div>
              
              </form>
              <a class="d-block text-center mt-2 small" href="register.php">Don't have an account? Register</a>

              <hr class="my-4">

              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-google btn-login fw-bold text-uppercase" type="submit">
                  <i class="fab fa-google me-2"></i> Sign in with Google
                </button>
              </div>

              <div class="d-grid">
                <button class="btn btn-lg btn-facebook btn-login fw-bold text-uppercase" type="submit">
                  <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                </button>
              </div>

            
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>