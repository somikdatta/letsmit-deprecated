<?php

require_once 'core/init.php';

if(Input::exists())
{
	$data = Input::get('image');
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName= date('mdY_hiB').'.png';
	$user=new User();
	try{
		if(empty($user->data()->image)){
			$user->update(array(
				'image'=> escape($imageName)
			));
			file_put_contents('profileimage/'.$imageName, $data);
		}
		else {
			unlink('profileimage/'.$user->data()->image);
			$user->update(array(
				'image'=> escape($imageName)
			));
			file_put_contents('profileimage/'.$imageName, $data);
		}
	}
	catch(Exception $e){
		die($e->getMessage());
	}

}
else{
	Redirect::to('home.php');
}

?>
