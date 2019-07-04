
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
<!--signup-->
<div id="login-target-inner">
  <h1>Sign up to LET'S SMIT</h1>
  <h3>Or <span id="text"><a class="create" href="login.php">Login</a></span></h3>
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
        $validate=new Validate();
        $validation=$validate->check($_POST,array(
          'Email'=>array(
            'required'=>true,
            'max'=>60,
            'unique'=>'accounts'
          ),
          'Password'=>array(
            'required'=>true,
            'min'=>8
          )
        ));
        if($validation->passed()){
          $user=new User();
          try{
            $user->create(array(
              'email'=> mb_strtolower(Input::get('Email')),
              'password'=> Hash::make(Input::get('Password')),
              'group'=>1
            ));
            //log user in
            $remember=false;
            $login=$user->login(mb_strtolower(Input::get('Email')),Input::get('Password'),$remember);
            if($login){
              Redirect::to('home.php');
            }
            else {
              Redirect::to('login.php');
            }
          }
          catch(Exception $e){
            die($e->getMessage());
          }
        }
        else{
          foreach($validation->errors() as $error){
            echo $error,'<br>';
          }
        }
      }
    }
     ?>
   </p>
  <form class="onboard" action="" method='POST'>
    <input type="text" placeholder="Email Address" name="Email" value="<?php echo escape(Input::get('Email')); ?>" required>
    <input class="password" type="password" placeholder="Password" name="Password" required>
    <button type="submit" name='signup-submit'>Sign up</button>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  </form>
</div>
</body>
</html>
