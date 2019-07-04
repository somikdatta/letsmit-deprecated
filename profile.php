<?php

require_once 'core/init.php';

if(!$username=Input::get('user')){
  Redirect::to('home.php');
}
else{
  $user = new User();
  $find=$user->findusername($username);
  if(!$find){
    Redirect::to(404);
  }
  else{
    $data=$user->data();

  }



  ?>

  <!--Profile Begins-->
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $user->data()->fname.' '.$user->data()->lname." - LET'S SMIT" ?></title>
    <link href="../letsmit/fonts/fonts.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../letsmit/css/home.css">
    <link rel="stylesheet" type="text/css" href="../letsmit/css/navbar.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style media="screen">
      *{
        box-sizing: border-box;
      }
      body{
        margin: 0;
        padding: 0;
        background-color: #fff;
      }
      .bg{
        height: 84vh;
        margin-top:8vh;
        background-color: #F5E8FF;
        margin-left: 8vh;
        margin-right: 8vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 5px;
        font-family: ProximaRegular,sans-serif;
      }
      .new{
        text-align: center;
        color: #006cff;
        flex:1;
        cursor: pointer;
      }
      .details{
        flex:1;
        display: flex;
        align-items: center;
      }
      @media screen and (max-width:415px){
        .bg{
          margin-left:2vh;
          margin-right:2vh;
        }
      }
      @media screen and (max-width:296px){
        .bg{
          margin-left:0;
          margin-right:0;
        }
      }
      @media screen and (max-width:619px){
  header{
    display: none;
  }
  .main{
    margin-left: 0;
  }
  .center{
    display: none;
  }
  .icon-container{
    display: flex;
  }
  .grid{
    display: none;
  }
  .phone{
    display: flex;
  }
  .menubox{
    margin-left: 2vh;
    margin-right: 2vh;
  }
  .main{
    height: 84vh;
  }
  .bottom-nav{
    display: flex;
  }
}
@media screen and (max-width:828px){
  .routine .grid ,th,td{
    font-size: 1em;
  }
}
@media screen and (max-width:778px){
  .logo{
    flex-grow: 1;
  }
  .routine .grid,th,td{
    font-size: 1em;
  }
}
@media screen and (max-width:537px){
  .routine .grid,th,td{
    font-size: 0.9em;
  }
}
@media screen and (max-width:415px){
  .routine .grid,th,td{
    font-size: 0.8em;
  }
  .gmsg{
    font-size: 2em;
  }
}
@media screen and (max-width:293px){
  .logo{
    font-size: 1.2em !important;
  }
}
    </style>
  </head>
  <body>
    <div class='nav-outer'>
      <nav class='nav-bar'>
        <a onclick='window.history.back()' class="new"><i class="fas fa-arrow-left"></i></a>
        <div class="logo"><p>let's smit</p></div>
        <ul class="center">
          <li><a href="profile.php?user=<?php //echo escape($user->data()->username); ?>">Hello <?php echo escape($user->data()->fname); ?>! <i class="fas fa-caret-down"></i></a>
            <!-- First Tier Drop Down-->
            <ul class="drop">
                <li><a href="home.php">Home</a></li>
                <li><a href="updateprofile.php">Update Profile</a></li>
            </ul>
          </li>
          <a class="" href="logout.php"><i class="fas fa-power-off sm"></i></a>
        </ul>
        <div class="icon-container">
          <a class="icon" href="logout.php"><i class="fas fa-power-off sm"></i></a>
        </div>
      </nav>
    </div>
    <div class="bg">
      <img style="margin-top:10px;" width="200px" height="200px" src="<?php if(empty($user->data()->image)){echo "profileimage/default.png"; } else{ echo "profileimage/".$user->data()->image; } ?>" <br>
      <p class='details'>Name: <?php echo escape($data->fname); echo ' '; echo escape($data->lname); ?></p>
      <p class='details'>Email: <?php echo escape($data->email);?></p>
      <p class='details'>Phone: <?php echo escape($data->phone_no);?></p>
      <p class='details'>Course: <?php echo escape($data->course);?></p>
      <p class='details'>Semester: <?php echo escape($data->semester);?></p>
      <p class='details'>Department: <?php echo escape($data->department);?></p>
      <p class='details'>Section: <?php echo escape($data->section);?></p>
    </div>
    
  </body>
  </html>


  <?php
}

 ?>
