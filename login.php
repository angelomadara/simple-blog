<?php
require 'header.php';
?>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="actions/login.php" method='post' id="login-form">
                <input type="hidden" name="_token" id="_token" value="<?= Token::generateToken() ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                <div>
                  <p>Not yet registered? <a href='create-account.php'>Create an account now</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
      </div>
    </div>

    <?php include 'footer.php'; ?>
  </body>

</html>
