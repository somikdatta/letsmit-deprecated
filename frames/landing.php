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
    $t1=9;
    $t2=2;
    ?>

    <?php
    if(Input::exists('get')){
      $dayname=Input::get('day');
     ?>
     <div class="greetings" id='mainload'>
       <div class="gmsg"></div>
     </div>
    <div class="routine" >
     <table class='list'>

       <?php
       if($dayname=='Sunday'){
         echo "<p>Sunday, Funday!<br>It's holiday!<p><span class='sunday' onclick='getNextDay(\"frames/landing.php?day=\",0)'>Show me Monday's routine.</span>";
       }
       else{
       ?>
       <caption><span id='switchbtn' onclick='removeDay()'><i class='fas fa-th'></i></span> Your schedule for <?php print_r($dayname); ?><span class='sunday padding' onclick='getNextDay("frames/landing.php?day=");'><i class='fas fa-chevron-right'></i></span><span class='sunday padding' data-target-url='frames/landing.php?day=' onclick='getPrevDay("frames/landing.php?day=")'><i class='fas fa-chevron-left'></i></span></caption>
       <tr>
         <th>Time</th>
         <th>Subject</th>
     </tr>
     <?php
     try{
       $subjects=$user->readRoutine($user->data()->course.$user->data()->department.$user->data()->semester.$user->data()->section);
       foreach ($subjects as $day => $value) {
         if($day==$dayname){
         foreach ($value as $half => $subs) {
           if($half=='first'&&empty($subs)){
             ?>
             <tr>
               <td>9 - 10</td>
               <td rowspan='4'>Enjoy your free half!</td>
             </tr>
             <tr>
               <td>10 - 11</td>
             </tr>
             <tr>
               <td>11 - 12</td>
             </tr>
             <tr>
               <td>12 - 1</td>
             </tr>
             <?php
           }
           elseif($half=='second'&&empty($subs)){
             ?>
             <tr>
               <td>2 - 3</td>
               <td rowspan='3'>Enjoy your free half!</td>
             </tr>
             <tr>
               <td>3 - 4</td>
             </tr>
             <tr>
               <td>4 - 5</td>
             </tr>
             <?php
           }
           foreach ($subs as $period => $subname) {
            if($half=='first'&&strpos($subname,'Lab')!==false){
              ?>
              <tr>
                <td>9 - 10</td>
                <td rowspan='3'><?php echo $subname ?></td>
              </tr>
              <tr>
                <td>10 - 11</td>
              </tr>
              <tr>
                <td>11 - 12</td>
              </tr>
              <?php
            }
            elseif($half=='second'&&strpos($subname,'Lab')!==false){
              ?>
              <tr>
                <td>2 - 3</td>
                <td rowspan='3'><?php echo $subname ?></td>
              </tr>
              <tr>
                <td>3 - 4</td>
              </tr>
              <tr>
                <td>4 - 5</td>
              </tr>
              <?php
            }
            elseif($half=='first'){
              ?>
              <tr>
                <td><?php  echo $t1.' - '; if($t1==12) { $t1=0; } echo ++$t1; ?></td>
                <td><?php echo $subname ?></td>
              </tr>
              <?php
            }
            elseif($half=='second'){
              ?>
              <tr>
                <td><?php  echo $t2.' - '.++$t2 ?></td>
                <td><?php echo $subname ?></td>
              </tr>
              <?php
            }
         }
       }
     }
   }
 }
     catch(Exception $e){
       echo "Something went wrong.";
     }
   }
      ?>
    </table>
    </div>
    <?php
  }
  else{
    ?>
    <div class="greetings">
      <div class="gmsg"></div>
    </div>
    <div class="routine">
      <table class='grid'>
        <div class="phone">
          <span id='droptext' onclick='getDay()'>Open Routine in List View <i class="fas fa-angle-down sm"></i></span>
        </div>
        <caption><span id='switchbtn' onclick="getDay()"><i class="fas fa-list-ul sm"></i></span>  Your schedule for the week:</caption>
        <tr>
          <th></th>
          <th>9 - 10</th>
          <th>10 - 11</th>
          <th>11 - 12</th>
          <th>12 - 1</th>
          <th>2 - 3</th>
          <th>3 - 4</th>
          <th>4 - 5</th>
      </tr>
      <?php
      try{
        $subjects=$user->readRoutine($user->data()->course.$user->data()->department.$user->data()->semester.$user->data()->section);
        foreach ($subjects as $day => $value) {
          ?>
          <tr>
          <td>
          <?php
          print_r($day);
          ?>
          </td>
          <?php

          foreach ($value as $half => $subs) {
            if($half=='first'&&empty($subs)){
              echo "<td colspan='4'></td>";
            }
            else if(empty($subs)){
              echo "<td colspan='3'></td>";
            }
            foreach ($subs as $period => $subname) {
                if(strpos($subname,'Lab')!==false){
                echo "<td colspan='3'>".$subname."</td>";
              }
              else{
                echo "<td>".$subname."</td>";
              }
            }
            if($half=='first'&&sizeof($subs)===3){
              echo "<td></td>";
            }
            else if($half=='first'&&sizeof($subs)===1){
              echo "<td></td>";
            }
          }
        }
      }
      catch(Exception $e){
        echo "Something went wrong.";
      }
       ?>

     </table>
   </div>
   <?php
  }
}
     ?>
