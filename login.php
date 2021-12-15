
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="js/bootstrap.min.js"></script>
    <title>Customer Login</title>
  </head>

  <style>
    .login-form {
      width: 340px;
      margin: 50px auto;
    }
    .login-form form {
      margin-bottom: 15px;
      background: #f7f7f7;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
    }
    .login-form h2 {
      margin: 0 0 15px;
    }
    .form-control,
    .btn {
      min-height: 38px;
      border-radius: 2px;
    }
    .input-group-addon .fa {
      font-size: 18px;
    }
    .btn {
      font-size: 15px;
      font-weight: bold;
    }
    .bottom-action {
      font-size: 14px;
    }
  </style>
  <body>
    <div class="login-form">
      <form action="backend/login.php" method="post">
        <h2 class="text-center">Sign In</h2>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <span class="fa fa-user"></span>
              </span>
            </div>
            <input
              type="text"
              class="form-control"
              placeholder="Username"
              required="required"
              name="username"
            />
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fa fa-lock"></i>
              </span>
            </div>
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              required="required"
              name="password"
            />
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">
            Log in
          </button>
        </div>
      </form>
    </div>
  </body>
</html>
