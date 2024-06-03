<?php
$user = new User($db);

//$didCreate = $user->createUser('fdc.beethoven', 'admin123', 'member', 'Beethoven', 'Etol', '');
//var_dump($didCreate);

if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    echo 'Please enter username and password.';
    die();
  }

  $user = new User($db);

  if ($user->authenticate($username, $password)) {
    $_SESSION['user_id'] = $user->getId();
    $_SESSION['username'] = $user->getUsername();
    $_SESSION['role'] = $user->getRole();
    $_SESSION['is_logged_in'] = true;

    echo "<script>
				window.location.href = '?page=dashboard';
			</script>";
    exit;
  } else {
    echo 'Invalid username or password.';
  }
}

?>


<section class="container">
  <div class="row justify-content-center login-container">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="text-center mb-4">
            <img src="manager_image.png" alt="Sign In image" class="img-fluid" style="max-width: 150px;">
          </div>
          <form action="" method="POST">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>