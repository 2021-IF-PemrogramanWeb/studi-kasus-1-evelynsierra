<?php
//menyertakan file program koneksi.php pada register
require('config.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';

//mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if (isset($_SESSION['username'])) {
  echo '<script>
        window.location.href = "https://studi-kasus-1-evelynsierraa.000webhostapp.com/table.php";
        </script>';
} //header('Location: table.php');

//mengecek apakah form disubmit atau tidak
if (isset($_POST['submit'])) {

  // menghilangkan backshlases
  $username = stripslashes($_POST['username']);
  //cara sederhana mengamankan dari sql injection
  $username = mysqli_real_escape_string($con, $username);
  // menghilangkan backshlases
  $password = stripslashes($_POST['password']);
  //cara sederhana mengamankan dari sql injection
  $password = mysqli_real_escape_string($con, $password);

  //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
  if (!empty(trim($username)) && !empty(trim($password))) {

    //select data berdasarkan username dari database
    $query      = "SELECT * FROM mahasiswa WHERE username_mahasiswa = '$username'";
    $result     = mysqli_query($con, $query);
    $rows       = mysqli_num_rows($result);

    if ($rows != 0) {
      $hash   = mysqli_fetch_assoc($result)['password'];
      if (password_verify($password, $hash)) {
        $_SESSION['username'] = $username;

        // header('Location: table.php');
        echo '<script>
        window.location.href = "https://studi-kasus-1-evelynsierraa.000webhostapp.com/table.php";
        </script>';
      }

      //jika gagal maka akan menampilkan pesan error
    } else {
      $error =  'Register User Gagal !!';
    }
  } else {
    $error =  'Data tidak boleh kosong !!';
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
                <input type="hidden" name="submit" value="submit">
                <input type="submit" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" name="login" value="LOGIN">
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