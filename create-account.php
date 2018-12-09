<?php require 'header.php'; ?>


    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="actions/create-account.php" method='post' id="login-form">
				<div class="<?= Request::get('class') ?>" role="alert">
					<?= Request::get('message') ?>
				</div> 
                <div class="form-group">
                    <label for="input-fullname">Fullname</label>
                    <input type="text" name='fullname' class="form-control" id="input-fullname" placeholder="Fullname" required>
                </div>
                <div class="form-group">
                    <label for="input-email">Email address</label>
                    <input type="email" name='email' class="form-control" id="input-email" aria-describedby="emailHelp" placeholder="Enter email" required>
					<small id="emailHelp" class="form-text text-muted">This will be use for login</small>
                </div>
                <div class="form-group">
                    <label for="input-password">Password</label>
                    <input type="password" name='password' class="form-control" id="input-password" placeholder="Password" required>
                </div>
                <div>
                  <p>Already have an account? <a href='login.php'>Login now</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
      </div>
    </div>

    <?php include 'footer.php'; ?>
  </body>

</html>
