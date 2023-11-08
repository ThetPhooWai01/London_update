<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>London Shop Login Form </title>
    <link rel="stylesheet" href="user_login.css">
  </head>
  
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post" action="user_login_server.php">
        <div class="txt_field">
          <input type="text" name="name" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">Forgot Password?</div>
        <button type="submit">Login</button>
        
        <div class="signup_link">
          Not account? <a href="#">Signup</a>
        </div>
      </form>
    </div>

  </body>
</html>
