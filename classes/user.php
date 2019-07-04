<?php

class User{
  private $_db,
          $_data,
          $_sessionName,
          $_cookieName,
          $_isLoggedIn;
  public function __construct($user=null){
    $this->_db=DB::getInstance();
    $this->_sessionName=Config::get('session/session_name');
    $this->_cookieName=Config::get('remember/cookie_name');
    if(!$user){
      if(Session::exists($this->_sessionName)){
        $user=Session::get($this->_sessionName);
        if($this->find($user)){
          $this->_isLoggedIn=true;
        }
        else{
          //process logout
        }
      }
    }
    else {
      $this->find($user);
    }
  }

  public function update($fields=array(),$id=null){

    if(!$id && $this->isLoggedIn()){
      $id=$this->data()->uid;
    }

    if(!$this->_db->update('accounts',$id,$fields)){
      throw new Exception('There was some problem updating your profile.');
    }
  }

  public function create($fields=array()){
    if(!$this->_db->insert('accounts',$fields)){
        throw new Exception('There was a problem creating your account.');
    }
  }

  public function find($user=null){
    if($user){
      $field=(is_numeric($user))?'uid':'email';
      $data=$this->_db->get('accounts',array($field,'=',$user));
      if($data->count()){
        $this->_data=$data->first();
        return true;
      }
    }
    return false;
  }
  //next func to temporarily do away with probs of find()
  public function findusername($user=null){
    if($user){
      $field='username';
      $data=$this->_db->get('accounts',array($field,'=',$user));
      if($data->count()){
        $this->_data=$data->first();
        return true;
      }
    }
    return false;
  }

  public function login($email=null,$password=null,$remember=false){
    if($this->isemail($email)){
    $user=$this->find($email);
    }
    else {
      $user=$this->findusername($email);
    }

    if(!$email && !$password && $this->exists()){
      Session::put($this->_sessionName,$this->data()->uid);
    }
    else{
      if($user){
        if(password_verify($password,$this->data()->password)){
          Session::put($this->_sessionName,$this->data()->uid);

          if($remember){
            $hashCheck=$this->_db->get('sessions',array('uid','=',$this->data()->uid));
            if(!$hashCheck->count()){
              $hash=Hash::unique();
              $this->_db->insert('sessions',array(
                'uid'=>$this->data()->uid,
                'hash'=>$hash
              ));
            }
            else{
              $hash=$hashCheck->first()->hash;
            }
            Cookie::put($this->_cookieName,$hash,Config::get('remember/cookie_expiry'));
          }

          return true;
        }
      }
    }
    return false;
  }
  public function logout(){
    $this->_db->delete('sessions',array('uid','=',$this->data()->uid));
    Session::delete($this->_sessionName);
    Cookie::delete($this->_cookieName);
  }
  public function hasPermission($key){
    $group=$this->_db->get('groups',array('id','=',$this->data()->group));
    if($group->count()){
      $permissions=json_decode($group->first()->permissions,true);
      if($permissions[$key]==true){
        return true;
      }
    }
    return false;
  }
  public function readRoutine($key){
    $jsonval=$this->_db->get('routine',array('id','=',$key));
    if($jsonval->count()){
      $subjects=json_decode($jsonval->first()->subjects,true);
      return $subjects;
    }
    return false;
  }
  private function isemail($user){
    //If the username input string is an e-mail, return true
    if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
  }

  public function data(){
    return $this->_data;
  }
  public function isLoggedIn(){
    return $this->_isLoggedIn;
  }
  public function exists(){
    return (!empty($this->_data))?true:false;
  }
}

 ?>
