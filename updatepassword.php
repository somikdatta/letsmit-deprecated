<?php

require_once 'core/init.php';
$user=new User();
if(!$user->isLoggedIn()){
  Redirect::to('index.php');
}
if(Input::exists()){
  if(Token::check(Input::get('token'))){
    $validate=new Validate();
    $validation=$validate->check($_POST,array(
      'current_password' => array(
        'required'=>true,
        'min'=>8
      ),
      'new_password' => array(
        'required'=>true,
        'min'=>8
      ),
      'renew_password' => array(
        'required'=>true,
        'min'=>8,
        'matches' => 'new_password'
      )
    ));

    if($validation->passed()){
      if(!password_verify(Input::get('current_password'),$user->data()->password)){
        echo "Password is wrong!";
      }
      else{
        $user->update(array(
          'password' => Hash::make(Input::get('new_password'))
        ));
        Session::flash('home','Password changed successfully');
        Redirect::to('home.php');
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

 <form action="" method="post">
   <input type="password" name="current_password" placeholder="Current Password" required>
   <input type="password" name="new_password" placeholder="New Password" required>
   <input type="password" name="renew_password" placeholder="Repeat New Password" required>
   <input type="submit" value="Update">
   <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
 </form>
