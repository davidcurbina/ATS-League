<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="Public/style.css">
<meta name="robots" content="noindex,follow" />
</head>
<body>
  <div class="container">
    <div class="row">
      <img src="Public/atslogo.png" style="width:75%; margin-left:12.5%; padding-bottom:25px;"/>
    </div>
    <div class="login">
      <h1>Login</h1>
		<?php echo $parameter?>
		<form method="post" action="login.php">
        <p><input id ="email" type="text" name="email" value="" placeholder="Username or Email"></p>
        <p><input id ="password" type="password" name="password" value="" placeholder="Password"></p>
       
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>
<!--
    <div class="login-help">
      <p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
    </div>
-->
  </div>
</body>
</html>