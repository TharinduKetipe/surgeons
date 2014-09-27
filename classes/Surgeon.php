<?php

class Surgeon{
    private $_db,
            $_data,
            $_sessionName;
    public $_isLoggedIn;


    public function __construct($user = NULL) {
         $this->_db = DB::getInstance();
         $this->_sessionName = Config::get('session/session_name');
         if(!$user){
             if(Session::exists($this->_sessionName)){
                 $user = Session::get($this->_sessionName);
                 if($this->find($user)){
                     $this->_isLoggedIn = TRUE;
                     
                 }  else {
                     //process logout
                 }
                 
             }
         }  else {
             $this->find($user);
             
         }
     }
     
     public function create($fields = array()){
         if(!$this->_db->insert('users',$fields)){
             throw new Exception('There was a problem');
         }
     }
     public function find($user = NULL){
         if ($user){
             $field = (is_numeric($user)) ? 'id' : 'username';
             $data = $this->_db->get('users',array($field,'=',$user));
             
             if($data->count()){
                 $this->_data = $data->first();
                 return TRUE;
                 
             }
         }
         return FALSE;
     }
     
     public function login($username = NULL ,$password = NULL){
         $user = $this->find($username);
         
         
         if($user){
             if ($user) {
			if ($this->data()->password==Hash::make($password, $this->data()->salt)) {
				Session::put($this->_sessionName, $this->data()->Patient_ID);
				return true;
			}
         }
         return FALSE;
     }}
     
     public function data(){
         return $this->_data;
     }
     
     public function isLoggedIn(){
         return $this->_isLoggedIn;
     }
}