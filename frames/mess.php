<?php
  require_once (realpath(dirname(__FILE__). '/../core/init.php'));
  require_once (realpath(dirname(__FILE__). '/../functions/sanitize.php'));
  $user=new User();
  if(!$user->isLoggedIn()){
    Redirect::to('index.php');
  }
  else{
    if($user->data()->username==null){
      Redirect::to('updateprofile.php');
    }
    ?>

    <?php
    if(Input::exists('get')){
      $dayname=Input::get('day');
     ?>
     <!DOCTYPE html>
     <html lang="en">
     <body>
       <div class="container" id="#mainload">
         <p><i class="fas fa-hamburger"></i> Menu for <?php echo $dayname; ?><span class='sunday padding' onclick='getNextDay("frames/mess.php?day=");'><i class='fas fa-chevron-right'></i></span><span class='sunday padding' data-target-url='frames/mess.php?day=' onclick='getPrevDay("frames/mess.php?day=")'><i class='fas fa-chevron-left'></i></span></p>
         <div class="menubox">
           <?php
           try{
             $menu=$user->readRoutine(3333);
             foreach ($menu as $day=>$time) {
               if($day==$dayname){
                 echo "<p>Breakfast</p>";
                 foreach ($time as $t => $food) {
                  if($t=="Breakfast"){
                    foreach ($food as $index => $value) {
                      if($index==sizeof($food)-1){
                        echo $value.'.';
                      }
                      else{
                        echo $value.', ';
                      }
                    }
                  }
                 }
               }
             }
           }
           catch (Exception $e){
             echo "<p>Some Error Occured</p>";
           }
           ?>
         </div>
         <div class="menubox">
           <?php
           try{
             $menu=$user->readRoutine(3333);
             foreach ($menu as $day=>$time) {
               if($day==$dayname){
                 echo "<p>Lunch</p>";
                 foreach ($time as $t => $food) {
                  if($t=="Lunch"){
                    foreach ($food as $index => $value) {
                      if($index==sizeof($food)-1){
                        echo $value.'.';
                      }
                      else{
                        echo $value.', ';
                      }
                    }
                  }
                 }
               }
             }
           }
           catch (Exception $e){
             echo "<p>Some Error Occured</p>";
           }
           ?>
         </div>
         <div class="menubox">
           <?php
           try{
             $menu=$user->readRoutine(3333);
             foreach ($menu as $day=>$time) {
               if($day==$dayname){
                 echo "<p>Snacks</p>";
                 foreach ($time as $t => $food) {
                  if($t=="Snacks"){
                    foreach ($food as $index => $value) {
                      if($index==sizeof($food)-1){
                        echo $value.'.';
                      }
                      else{
                        echo $value.', ';
                      }
                    }
                  }
                 }
               }
             }
           }
           catch (Exception $e){
             echo "<p>Some Error Occured</p>";
           }
           ?>
         </div>
         <div class="menubox">
           <?php
           try{
             $menu=$user->readRoutine(3333);
             foreach ($menu as $day=>$time) {
               if($day==$dayname){
                 echo "<p>Dinner</p>";
                 foreach ($time as $t => $food) {
                  if($t=="Dinner"){
                    foreach ($food as $index => $value) {
                      if($index==sizeof($food)-1){
                        echo $value.'.';
                      }
                      else{
                        echo $value.', ';
                      }
                    }
                  }
                 }
               }
             }
           }
           catch (Exception $e){
             echo "<p>Some Error Occured</p>";
           }
           ?>
         </div>
       </div>
       <?php
    }
  }
        ?>
     </body>
     </html>
