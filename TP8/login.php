<?php
    $title = "login";
    $page = "login";

    include "Components/header.php";
    if (isset($_SESSION["user"]))
    {
        header("Location: index.php");
    }
    include "fungsi.php";

    $errors = [];
    if (isset($_POST["login"])) {
        $errors = login($_POST, $errors);
    }
?>

<style>
    .login-container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .login-card {
      width: 320px; /* Ukuran kotak login */
    }
</style>

<div class="login-container">
    <div class="card login-card p-4 shadow">
      <h3 class="text-center mb-4">Login</h3>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
      </form>
      <?php

        if (!empty($errors)) {
        echo '<div class="alert alert-danger mt-4" role="alert">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
        }
        ?>
    </div>
</div>





<?php include "Components/footer.php"; ?>

