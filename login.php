<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset=“utf-8”>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../letsmit/fonts/fonts.css" rel="stylesheet" type="text/css">
  <link href="../letsmit/css/onboardingpage.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <title>LET'S SMIT - One stop portal for SMIT students.</title>
</head>
<body>
  <nav>
    <div id="logo">
      <a id="logo-link" href="index.php"><p>let's smit</p></a>
    </div>
  </nav>
<!--login-->
  <div id="login-target-inner">
    <h1>Log into LET'S SMIT</h1>
    <h3>Or <span id="text"><a class="create" href="signup.php">Create Account</a></span></h3>
    <p id="error_alert">
      <?php
      require_once 'core/init.php';
      require_once 'functions/sanitize.php';
      $user=new User();
      if($user->isLoggedIn()){
        Redirect::to('home.php');
      }
      if(Input::exists()){
        if(Token::check(Input::get('token'))){
          $validate=new validate();
          $validation=$validate->check($_POST,array(
            'Email'=>array('required'=>true),
            'Password'=>array('required'=>true)
          ));
          if($validation->passed()){
            $user=new User();
            $remember=(Input::get('remember')==='on')?true:false;
            $login=$user->login(mb_strtolower(Input::get('Email')),Input::get('Password'),$remember);
            if($login){
              Redirect::to('home.php');
            }
            else{
              echo "Incorrect Username/Email/Password";
            }
          }
          else {
            foreach ($validation->errors() as $error) {
              echo $error,'<br>';
            }
          }
        }
      }
      ?>
    <form class="onboard" method='POST'>
      <input type="text" placeholder="Username/ Email Address" name="Email" required>
      <input class="password" type="password" placeholder="Password" name="Password" required>
      <button type="submit" name="login-submit">Log in</button>
      <span id="remember"><input type="checkbox" name="remember"> Remember Me</span>
      <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </form>
    <a class="forgot" href="#"><span>Forgot Password?</span></a>
  </div>
</body>
</html>
