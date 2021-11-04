<?php
require_once('config.php');

if (isset($_POST['register'])) {

  //filter data yang diinputkan

  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  //enkripsi password
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $notelp = filter_input(INPUT_POST, 'notelp', FILTER_SANITIZE_STRING);
  $jurusan = filter_input(INPUT_POST, 'jurusan', FILTER_SANITIZE_STRING);

  //menyiapkan query
  $sql = "INSERT INTO mahasiswa (username_mahasiswa, nama_mahasiswa, no_telp_mahasiswa, email_mahasiswa, password, jurusan_mahasiswa)
          VALUES (:username, :name, :notelp, :email, :password, :jurusan)";
  $stmt = $db->prepare($sql);


  //bind parameter ke query
  $params = array(
    ":username" => $username,
    ":name" => $name,
    ":notelp" => $notelp,
    ":email" => $email,
    ":password" => $password,
    ":jurusan" => $jurusan
  );

  //eksekusi query untuk simpan ke database
  $saved = $stmt->execute($params);

  //jika user sudah terdaftar maka akan dialihkan ke halaman login
  if ($saved) header("Location : login.php");
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
                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" name="register" value="register">Register</button>
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