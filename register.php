<?php
//menyertakan file program koneksi.php pada register
require('config.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';
//mengecek apakah form registrasi di submit atau tidak
if (isset($_POST['register'])) {
  echo $_POST['register'];
  // menghilangkan backshlases
  $username = stripslashes($_POST['username']);
  //cara sederhana mengamankan dari sql injection
  $username = mysqli_real_escape_string($con, $username);
  $name     = stripslashes($_POST['name']);
  $name     = mysqli_real_escape_string($con, $name);
  $email    = stripslashes($_POST['email']);
  $email    = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $notelp    = stripslashes($_POST['notelp']);
  $notelp    = mysqli_real_escape_string($con, $notelp);
  $jurusan    = stripslashes($_POST['jurusan']);
  $jurusan    = mysqli_real_escape_string($con, $jurusan);

  //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
  if (!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($notelp)) && !empty(trim($jurusan))) {
    //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
    //if ($password == $repass) {
    //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
    if (cek_nama($name, $con) == 0) {
      //hashing password sebelum disimpan didatabase
      $pass  = password_hash($password, PASSWORD_DEFAULT);
      //insert data ke database
      $query = "INSERT INTO mahasiswa (username_mahasiswa,nama_mahasiswa,email_mahasiswa, password,no_telp_mahasiswa,jurusan_mahasiswa ) 
                  VALUES ('$username','$name','$email','$pass','$notelp','$jurusan')";
      $result   = mysqli_query($con, $query);
      echo "result=" . $result;
      //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
      if ($result) {
        $_SESSION['username'] = $username;

        // header('Location: login.php');
        echo '<script>
        window.location.href = "https://studi-kasus-1-evelynsierraa.000webhostapp.com/login.php";
        </script>';
        //jika gagal maka akan menampilkan pesan error
      } else {
        $error =  'Register User Gagal !!';
      }
    } else {
      $error =  'Username sudah terdaftar !!';
    }
    //} //else {
    //$validate = 'Password tidak sama !!';
    //}
  } else {
    $error =  'Data tidak boleh kosong !!';
  }
}

//fungsi untuk mengecek username apakah sudah terdaftar atau belum
function cek_nama($username, $con)
{
  $nama = mysqli_real_escape_string($con, $username);
  $query = "SELECT * FROM mahasiswa WHERE username = '$nama'";
  if ($result = mysqli_query($con, $query)) return mysqli_num_rows($result);
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
  <title>Register Page</title>

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <img src='https://source.unsplash.com/WEQbe2jBg40/414x512'>
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Register</h5>
            <form action="" method="POST">

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="name" required autofocus>
                <label for="floatingInputName">Name</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="username" required autofocus>
                <label for="username">Username</label>
              </div>

              <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="password">
                <label for="password">Password</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="notelp" id="notelp" placeholder="password">
                <label for="notelp">Nomor Telepon</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="password">
                <label for="jurusan">Jurusan</label>
              </div>

              <div class="d-grid mb-2">
                <!-- <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" name="register" value="register">Register</button>
--> <input type="hidden" name="register" value="register">
                <input type="submit" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" value="register">
              </div>
            </form>
            <a class="d-block text-center mt-2 small" href="login.php">Have an account? Sign In</a>

            <hr class="my-4">

            <div class="d-grid mb-2">
              <button class="btn btn-lg btn-google btn-login fw-bold text-uppercase" type="submit">
                <i class="fab fa-google me-2"></i> Sign up with Google
              </button>
            </div>

            <div class="d-grid">
              <button class="btn btn-lg btn-facebook btn-login fw-bold text-uppercase" type="submit">
                <i class="fab fa-facebook-f me-2"></i> Sign up with Facebook
              </button>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>