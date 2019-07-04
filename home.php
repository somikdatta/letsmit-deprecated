<?php
require_once 'core/init.php';
require_once 'functions/sanitize.php';

if(Session::exists('home')){
  echo '<p>' .Session::flash('home'). '</p>';
}

$user=new User();

if(!$user->isLoggedIn()){
  Redirect::to('index.php');
}
else{
  if($user->data()->username==null){
    Redirect::to('updateprofile.php');
  }
//remove this after admin script is activated.
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#006cff">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#006cff">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link href="../letsmit/fonts/fonts.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../letsmit/css/home.css">
    <link rel="stylesheet" type="text/css" href="../letsmit/css/navbar.css">
    <title>Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>
  <body>
    <div class='nav-outer'>
      <nav class='nav-bar'>
        <div class="logo"><p>let's smit</p></div>
        <ul class="center navigation">
          <li><a class='link' href="profile.php?user=<?php echo escape($user->data()->username); ?>">Hello <?php echo escape($user->data()->fname); ?>! <i class="fas fa-caret-down"></i></a>
            <!-- First Tier Drop Down -->
            <ul class="drop">
                <li><a href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a></li>
                <li><a href="updateprofile.php">Update Profile</a></li>
            </ul>
          </li>
          <a class="" href="logout.php"><i class="fas fa-power-off sm"></i></a>
        </ul>
        <div class="icon-container navigation">
          <a class="icon link" data-target="profile.php?user=<?php echo escape($user->data()->username); ?>"><i class="fas fa-user sm"></i></a>
          <a class="icon" href="logout.php"><i class="fas fa-power-off sm"></i></a>
        </div>
      </nav>
    </div>
  <header>
    <div class="navBtn navigation">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet" viewBox="201.06185567010314 -1 184.02774631500242 404" width="50" height="20"><defs><path d="M216.11 12.52L222.88 18.56L229.48 24.46L235.92 30.22L242.2 35.83L248.31 41.3L254.26 46.63L260.05 51.81L265.67 56.85L271.13 61.74L276.43 66.49L281.57 71.1L286.54 75.56L291.35 79.88L296 84.05L300.48 88.08L304.8 91.97L308.96 95.71L312.95 99.31L316.78 102.77L320.45 106.08L323.96 109.25L327.3 112.27L330.48 115.15L333.5 117.89L336.35 120.48L339.04 122.93L341.57 125.23L343.93 127.4L346.13 129.41L348.17 131.29L350.05 133.02L351.76 134.6L353.31 136.04L354.69 137.34L355.92 138.5L356.98 139.51L357.87 140.37L358.61 141.1L359.73 142.24L360.83 143.4L361.9 144.58L362.94 145.78L363.96 146.99L364.96 148.22L365.92 149.47L366.86 150.73L367.78 152.01L368.66 153.31L369.52 154.62L370.36 155.94L371.16 157.28L371.94 158.64L372.69 160.01L373.41 161.39L374.11 162.78L374.78 164.19L375.42 165.61L376.03 167.04L376.61 168.49L377.16 169.94L377.69 171.41L378.18 172.89L378.65 174.37L379.09 175.87L379.5 177.38L379.88 178.89L380.23 180.42L380.55 181.95L380.84 183.5L381.1 185.05L381.33 186.61L381.53 188.17L381.7 189.74L381.84 191.32L381.95 192.91L382.03 194.5L382.07 196.1L382.09 197.7L382.07 199.3L382.03 200.9L381.95 202.49L381.84 204.07L381.7 205.65L381.53 207.22L381.33 208.79L381.1 210.35L380.84 211.9L380.55 213.44L380.23 214.98L379.88 216.5L379.5 218.02L379.09 219.53L378.65 221.02L378.18 222.51L377.69 223.99L377.16 225.46L376.61 226.91L376.03 228.36L375.42 229.79L374.78 231.21L374.11 232.62L373.41 234.01L372.69 235.39L371.94 236.76L371.16 238.12L370.36 239.46L369.52 240.78L368.66 242.09L367.78 243.39L366.86 244.67L365.92 245.93L364.96 247.18L363.96 248.41L362.94 249.62L361.9 250.82L360.83 252L359.73 253.16L358.61 254.3L357.87 255.03L356.98 255.91L355.92 256.93L354.69 258.1L353.31 259.43L351.76 260.9L350.05 262.53L348.17 264.3L346.13 266.22L343.93 268.29L341.57 270.51L339.04 272.89L336.35 275.41L333.5 278.08L330.48 280.9L327.3 283.87L323.96 286.98L320.45 290.25L316.78 293.67L312.95 297.24L308.96 300.96L304.8 304.82L300.48 308.84L296 313L291.35 317.32L286.54 321.79L281.57 326.4L276.43 331.16L271.13 336.08L265.67 341.14L260.05 346.35L254.26 351.72L248.31 357.23L242.2 362.89L235.92 368.7L229.48 374.66L222.88 380.77L216.11 387.03L209.18 393.44L202.09 400L202.09 396.51L202.09 393.11L202.08 389.8L202.08 386.57L202.08 383.43L202.08 380.39L202.08 377.43L202.08 374.56L202.08 371.77L202.07 369.08L202.07 366.47L202.07 363.95L202.07 361.52L202.07 359.18L202.07 356.93L202.07 354.77L202.07 352.69L202.07 350.7L202.07 348.8L202.07 346.99L202.07 345.27L202.07 343.64L202.07 342.09L202.07 340.63L202.07 339.26L202.07 337.98L202.07 336.79L202.07 335.69L202.07 334.67L202.07 333.74L202.08 332.91L202.08 332.16L202.08 331.49L202.08 330.92L202.08 330.43L202.08 330.04L202.08 329.73L202.09 329.51L202.09 329.38L202.09 329.33L202.29 329.15L202.86 328.61L203.8 327.73L205.07 326.52L206.67 325.02L208.57 323.22L210.76 321.16L213.21 318.85L215.91 316.3L218.84 313.54L221.98 310.58L225.31 307.43L228.82 304.12L232.48 300.67L236.27 297.08L240.19 293.39L244.2 289.6L248.29 285.73L252.45 281.8L256.65 277.83L260.87 273.84L265.1 269.84L269.31 265.85L273.49 261.89L277.63 257.98L281.69 254.12L285.67 250.35L289.54 246.68L293.29 243.12L296.89 239.69L300.34 236.42L303.6 233.31L306.66 230.39L309.51 227.67L312.12 225.17L314.47 222.91L316.55 220.9L318.34 219.17L319.82 217.72L320.97 216.59L321.35 216.2L321.71 215.82L322.07 215.42L322.42 215.02L322.76 214.62L323.09 214.21L323.41 213.79L323.73 213.37L324.03 212.94L324.33 212.51L324.62 212.07L324.89 211.63L325.16 211.18L325.42 210.73L325.67 210.28L325.91 209.81L326.15 209.35L326.37 208.88L326.58 208.41L326.78 207.93L326.98 207.45L327.16 206.96L327.34 206.47L327.51 205.98L327.66 205.48L327.81 204.98L327.94 204.48L328.07 203.97L328.19 203.46L328.29 202.95L328.39 202.44L328.48 201.92L328.56 201.4L328.62 200.88L328.68 200.35L328.73 199.83L328.76 199.3L328.79 198.77L328.8 198.23L328.81 197.7L328.8 197.16L328.79 196.63L328.76 196.1L328.73 195.57L328.68 195.04L328.62 194.52L328.56 194L328.48 193.48L328.39 192.96L328.29 192.44L328.19 191.93L328.07 191.42L327.94 190.92L327.81 190.41L327.66 189.91L327.51 189.42L327.34 188.92L327.16 188.44L326.98 187.95L326.78 187.47L326.58 186.99L326.37 186.52L326.15 186.05L325.91 185.58L325.67 185.12L325.42 184.66L325.16 184.21L324.89 183.76L324.62 183.32L324.33 182.88L324.03 182.45L323.73 182.03L323.41 181.6L323.09 181.19L322.76 180.78L322.42 180.37L322.07 179.97L321.71 179.58L321.35 179.19L320.97 178.81L319.85 177.7L318.44 176.34L316.76 174.73L314.82 172.9L312.65 170.85L310.26 168.6L307.65 166.17L304.85 163.56L301.87 160.78L298.72 157.86L295.43 154.81L292 151.63L288.45 148.35L284.8 144.98L281.06 141.52L277.24 138L273.36 134.42L269.44 130.8L265.49 127.16L257.55 119.84L253.6 116.2L249.68 112.58L245.8 109L241.98 105.48L238.24 102.02L234.59 98.64L231.04 95.36L227.61 92.19L224.32 89.13L221.17 86.21L218.19 83.44L215.39 80.83L212.79 78.39L210.39 76.14L208.22 74.1L206.28 72.26L204.6 70.66L203.19 69.29L202.07 68.19L202.07 68.14L202.07 68.01L202.07 67.8L202.07 67.5L202.06 67.12L202.06 66.65L202.06 66.09L202.06 65.45L202.06 64.73L202.06 63.92L202.06 63.02L202.06 62.04L202.06 60.98L202.06 59.82L202.06 58.59L202.06 57.27L202.06 55.86L202.06 54.37L202.06 52.79L202.06 51.13L202.06 49.38L202.06 47.55L202.07 45.63L202.07 43.63L202.07 41.54L202.07 39.37L202.07 37.11L202.07 34.77L202.07 32.34L202.07 29.82L202.07 27.22L202.08 24.54L202.08 21.77L202.08 18.92L202.08 15.98L202.08 12.95L202.08 9.84L202.09 6.65L202.09 3.37L202.09 0L209.18 6.33L216.11 12.52Z" id="a18sKmB7Xa"></path></defs><g><g><use xlink:href="#a18sKmB7Xa" opacity="1" fill="#006cff" fill-opacity="1"></use><g><use xlink:href="#a18sKmB7Xa" opacity="1" fill-opacity="0" stroke="#000000" stroke-width="1" stroke-opacity="0"></use></g></g></g></svg>
      <a class="link" href="landing.php" data-target="frames/landing.php"><i class="fas fa-home"></i></a>
      <a class="link" href="mess.php" data-target="frames/mess.php"><i class="fas fa-hamburger"></i></a>
    </div>
    <nav class="sidebar navigation">
      <a class='link' href="landing.php" data-target="frames/landing.php">Home</a>
      <a class='link' href="mess.php" data-target="frames/mess.php">Mess</a>
    </nav>
  </header>


  <div class="main">
    <?php
      require 'frames/landing.php';
     ?>
    <!---php for admin script
        if($user->hasPermission('admin')){
          echo "<p>Administrator</p>";
        }
      }
    else{
      Redirect::to('index.php');
    }
    --->
  </div>
  <div class='bottom-nav navigation'>
    <a href="landing.php" data-target="frames/landing.php" class="link bottom-nav-links" ><i class="fas fa-home"></i></a>
    <a href="mess.php" data-target="frames/mess.php" class="link bottom-nav-links" ><i class="fas fa-hamburger"></i></a>
  </div>
  <?php
    }
  ?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="../letsmit/js/homescripts.js"></script>
  </body>
  </html>
