<?php

require_once 'core/init.php';
$user=new User();
if(!$user->isLoggedIn()){
  Redirect::to('index.php');
}
if(Input::exists()){
  if(Token::check(Input::get('token'))){
    //if username is same as before
    if(Input::get('Username')===($user->data()->username)){
      $validate=new Validate();
      $validation=$validate->check($_POST,array(
        'fname' => array(
          'required'=>true,
          'min'=>2,
          'max'=>60
        ),
        'lname' => array(
          'min'=>2,
          'max'=>60
        ),
        'phone_no' => array(
          'min'=>10,
          'max'=>10,
        ),
        'semester' => array(
          'required'=>true,
          'min'=>1,
          'max'=>1
        ),
        'course' => array(
          'required'=>true,
          'min'=>1,
          'max'=>1
        ),
        'department' => array(
          'required'=>true,
          'min'=>1,
          'max'=>1
        ),
        'section' => array(
          'required'=>true,
          'min'=>1,
          'max'=>1
        ),
        'image' =>array()
      ));
    }
    else{
      //new username provided
    $validate=new Validate();
    $validation=$validate->check($_POST,array(
      'Username' => array(
        'required'=>true,
        'min'=>4,
        'max'=>20,
        'unique'=>'accounts',
        'notnumeric' => true
      ),
      'fname' => array(
        'required'=>true,
        'min'=>2,
        'max'=>60
      ),
      'lname' => array(
        'min'=>2,
        'max'=>60
      ),
      'phone_no' => array(
        'min'=>10,
        'max'=>10,
      ),
      'semester' => array(
        'required'=>true,
        'min'=>1,
        'max'=>1
      ),
      'course' => array(
        'required'=>true,
        'min'=>1,
        'max'=>1
      ),
      'department' => array(
        'required'=>true,
        'min'=>1,
        'max'=>1
      ),
      'section' => array(
        'required'=>true,
        'min'=>1,
        'max'=>1
      )
    ));
  }
    if($validation->passed()){
      try{
        if(Input::get('Username')===($user->data()->username)){
          $user->update(array(
          'fname'=>escape(ucfirst(Input::get('fname'))),
          'lname'=>escape(ucfirst(Input::get('lname'))),
          'phone_no'=>escape(Input::get('phone_no')),
          'semester'=>Input::get('semester'),
          'course'=>Input::get('course'),
          'department'=>Input::get('department'),
          'section'=>Input::get('section'),
        ));
        Session::flash('home','Your profile has been updated succesfully');
        Redirect::to('updateprofile.php');
        }
        else{
          $user->update(array(
          'username'=>escape(mb_strtolower(Input::get('Username'))),
          'fname'=>escape(ucfirst(Input::get('fname'))),
          'lname'=>escape(ucfirst(Input::get('lname'))),
          'phone_no'=>escape(Input::get('phone_no')),
          'semester'=>Input::get('semester'),
          'course'=>Input::get('course'),
          'department'=>Input::get('department'),
          'section'=>Input::get('section'),
        ));
        Session::flash('home','Your profile has been updated succesfully');
        Redirect::to('home.php');
        }
      }
      catch(Exception $e){
        die($e->getMessage());
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
 <html>
 <head>
   <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.css">
 </head>
 <style>
 .active{
   display: block;
 }
 .inactive{
   display: none;
 }
 </style>
 <body>
   <div class="panel-body">
     <div id="uploaded_image">
       <img width="200px" height="200px" src="<?php if(empty($user->data()->image)){echo "profileimage/default.png"; } else{ echo "profileimage/".$user->data()->image; } ?>">
     </div>
     <input type="file" name="upload_image" id="upload_image" />
   </div>

   <div id="uploadimageModal" class="inactive">
     <div id="image_demo" style="width:350px; margin-top:30px"></div>
   		 <button class="crop_image">Upload Image</button>
      <button class="cancel">Cancel</button>
   </div>

  <form action="" method="post">
   <input type="text" name="Username" value="<?php echo escape($user->data()->username); ?>" placeholder="Username" required><br>
   <input type="text" name="fname" value="<?php echo escape($user->data()->fname); ?>" placeholder="First Name" required><br>
   <input type="text" name="lname" value="<?php echo escape($user->data()->lname); ?>" placeholder="Last Name" required><br>
   <input type="text" name="phone_no" value="<?php echo escape($user->data()->phone_no); ?>" placeholder="Contact Number"><br>
   <select name="course">
    <option value="" <?php if (escape($user->data()->course)===null) echo 'selected="selected"';?> hidden>Select: </option>
    <option value="1" <?php if (escape($user->data()->course)==1) echo 'selected="selected"';?> >Bachelor's</option>
    <option value="2" <?php if (escape($user->data()->course)==2) echo 'selected="selected"';?> >Master's</option>
  </select><br>
  <select name="department">
   <option value="" <?php if (escape($user->data()->department)===null) echo 'selected="selected"';?> hidden>Select: </option>
   <option value="1" <?php if (escape($user->data()->department)==1) echo 'selected="selected"';?> >CSE</option>
   <option value="2" <?php if (escape($user->data()->department)==2) echo 'selected="selected"';?> >ECE</option>
   <option value="3" <?php if (escape($user->data()->department)==3) echo 'selected="selected"';?> >IT</option>
   <option value="4" <?php if (escape($user->data()->department)==4) echo 'selected="selected"';?> >ME</option>
   <option value="5" <?php if (escape($user->data()->department)==5) echo 'selected="selected"';?> >CE</option>
   <option value="6" <?php if (escape($user->data()->department)==6) echo 'selected="selected"';?> >CA</option>
   <option value="7" <?php if (escape($user->data()->department)==7) echo 'selected="selected"';?> >BA</option>
 </select><br>
   <select name="semester">
    <option value="" <?php if (escape($user->data()->semester)===null) echo 'selected="selected"';?> hidden>Select: </option>
    <option value="1" <?php if (escape($user->data()->semester)==1) echo 'selected="selected"';?> >First</option>
    <option value="2" <?php if (escape($user->data()->semester)==2) echo 'selected="selected"';?> >Second</option>
    <option value="3" <?php if (escape($user->data()->semester)==3) echo 'selected="selected"';?> >Third</option>
    <option value="4" <?php if (escape($user->data()->semester)==4) echo 'selected="selected"';?> >Fourth</option>
    <option value="5" <?php if (escape($user->data()->semester)==5) echo 'selected="selected"';?> >Fifth</option>
    <option value="6" <?php if (escape($user->data()->semester)==6) echo 'selected="selected"';?> >Sixth</option>
    <option value="7" <?php if (escape($user->data()->semester)==7) echo 'selected="selected"';?> >Seventh</option>
  </select><br>
  <select name="section">
   <option value="" <?php if (escape($user->data()->section)===null) echo 'selected="selected"';?> hidden>Select: </option>
   <option value="1" <?php if (escape($user->data()->section)==1) echo 'selected="selected"';?> >A</option>
   <option value="2" <?php if (escape($user->data()->section)==2) echo 'selected="selected"';?> >B</option>
   <option value="3" <?php if (escape($user->data()->section)==3) echo 'selected="selected"';?> >C</option>
 </select><br>
   <input type="submit" value="Update">
   <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
 </form>

 <script>
 $(document).ready(function(){

 	$image_crop = $('#image_demo').croppie({
     enableExif: true,
     viewport: {
       width:300,
       height:300,
       type:'circle'
     },
     boundary:{
       width:500,
       height:500
     }
   });

   $('#upload_image').on('change', function(){
     var reader = new FileReader();
     reader.onload = function (event) {
       $image_crop.croppie('bind', {
         url: event.target.result
       }).then(function(){
         console.log('jQuery bind complete');
       });
     }
     reader.readAsDataURL(this.files[0]);
     $('#uploadimageModal').removeClass('inactive');
     $('#uploadimageModal').addClass('active');
   });

   $('.cancel').click(function(){
     $('#uploadimageModal').removeClass('active');
     $('#uploadimageModal').addClass('inactive');
   });

   $('.crop_image').click(function(event){
     $image_crop.croppie('result', {
       type: 'canvas',
       size: 'viewport'
     }).then(function(response){
       $.ajax({
         url:"pro_img_up_driver.php",
         type: "POST",
         data:{"image": response},
         success:function(data)
         {
           $('#uploadimageModal').removeClass('active');
           $('#uploadimageModal').addClass('inactive');
           location.reload();
         }
       });
     })
   });

 });
 </script>


</body>
</html>
