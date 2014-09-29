<?php

class Surgeon{
    private $_db,
            $_data,
            $_sessionName;
    public $_isLoggedIn;


    public function __construct($surgeon = NULL) {
         $this->_db = DB::getInstance();
         $this->_sessionName = Config::get('session/session_name');
         if(!$surgeon){
             if(Session::exists($this->_sessionName)){
                 $surgeon = Session::get($this->_sessionName);
                 if($this->find($surgeon)){
                     $this->_isLoggedIn = TRUE;
                     
                 }  else {
                     //process logout
                 }
                 
             }
         }  else {
             $this->find($surgeon);
             
         }
     }
     
     public function create($fields=array()){
		if (!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating an account.');
			
		}
	}
     public function find($surgeon = NULL){
         if ($surgeon){
             $field = (is_numeric($surgeon)) ? 'id' : 'username';
             $data = $this->_db->get('users',array($field,'=',$surgeon));
             
             if($data->count()){
                 $this->_data = $data->first();
                 return TRUE;
                 
             }
         }
         return FALSE;
     }
     
     public function login($username = NULL ,$password = NULL){
         $surgeon = $this->find($username);
         
         if($surgeon){
             if($this->data()->password === Hash::make($password,  $this->data()->salt)){
                 Session::put($this->_sessionName,  $this->data()->id);
             }
         }
         return FALSE;
         
        /* 
         if($surgeon){
             if ($surgeon) {
			if ($this->data()->password==Hash::make($password, $this->data()->salt)) {
				Session::put($this->_sessionName, $this->data()->id);
				return true;
			}
         }
         return FALSE;
     }*/}
     
     public function data(){
         return $this->_data;
     }
     
     public function isLoggedIn(){
         return $this->_isLoggedIn;
     }
}