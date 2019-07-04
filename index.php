<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset=“utf-8”>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#006cff">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#006cff">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link href="../letsmit/css/navbar.css" rel="stylesheet" type="text/css">
  <link href="../letsmit/fonts/fonts.css" rel="stylesheet" type="text/css">
  <link href="../letsmit/css/index.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <title>LET'S SMIT - One stop portal for SMIT students.</title>
</head>
<body>
<div class='nav-outer'>
<nav class='nav-bar'>
  <div class="logo"><p>let's smit</p></div>
  <ul class="nav-links">
    <li><a class='remove' href='#slide-1'>Home</a></li>
    <li><a class='remove' href='#slide-2'>Features</a></li>
    <li><a class='remove' href='#slide-3'>Feedback</a></li>
    <?php
    require_once 'core/init.php';
    require_once 'functions/sanitize.php';
      $user=new User();
      if($user->isLoggedIn()){
        ?>
        <li><a href='home.php'>Hello, <?php echo escape($user->data()->fname); ?></a></li>
      <?php
      }
      else {
        ?>
        <li><a href='login.php'>Log in</a></li>
        <li><a href='signup.php'>Sign Up</a></li>
        <?php
      }
     ?>

  </ul>
</nav>
</div>
<div class="slides">
    <div class="slide" id="slide-1">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <div class="slide__text">
          <h1 id="slide-1-title">Slide 1 title</h1>
          <p class='first__para'>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
          <p>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
          <p>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
          <p>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
          <p>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>

        </div>
      </div>
    </div>

    <div class="slide inactive" id="slide-2">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <div class="slide__text">
          <h1 id="slide-2-title">Slide 2 title</h1>
          <p class='first__para'>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
          <p>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
        </div>
      </div>
    </div>

    <div class="slide inactive" id="slide-3">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <div class="slide__text">
          <h1 id="slide-3-title">Slide 3 title</h1>
          <p class='first__para'>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
          <p>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
        </div>
      </div>
    </div>

    <div class="slide inactive" id="slide-4">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <div class="slide__text">
          <h1 id="slide-4-title">Slide 4 title</h1>
          <p class='first__para'>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
        </div>
      </div>
    </div>

	<div class="slide" id="slide-5">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <div class="slide__text">
          <p class='first__para'>Bacon ipsum dolor amet alcatra beef meatloaf brisket beef ribs meatball tenderloin shank ball tip ribeye pig pastrami filet mignon. Sirloin tail fatback venison shank salami. Picanha pastrami venison meatball kevin pork chop leberkas. Meatloaf tenderloin leberkas pancetta hamburger cow kielbasa, filet mignon tri-tip beef ribs.</p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="../letsmit/js/indscripts.js"></script>
</body>
</html>
