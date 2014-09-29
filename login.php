<?php

require_once 'core/init.php';
if(Input::exists()){
    
    if(Token::check(Input::get('token'))){
        $validate = new Validation();
        $validation = $validate->check($_POST,array(
           'username' => array('required' => TRUE) ,
            'password'=> array('required' => TRUE)
        ));
        
        if($validation->passed()){
            //log in
            $surgeon = new Surgeon();
            $login  = $surgeon->login(Input::get('username'),  Input::get('password'));
            
            if($login){
                echo 'Success';
            }  else {
                echo '<p>Sorry, loggin in failed.</p>';
                
            }
        }else{
            foreach ($validate->errors() as $error){
                echo $error,'<br>';
            }
            
        }/*{
           //header('Location:index.php');
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'));
            if($login){
                Redirect::to('index.php');
                
            }  else {
                echo '<p>Sorry,loggin in failed.</p>';
                
            }
            
        }  else {
            foreach ($validation->errors() as $error){
                echo $error,'<br>';
            }
                
        }
    }*/
}
}

?>
<form action="" method="post">
    
    <div class="field">
        <label for="username" >Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
    </div>
    
    <div class="field">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off">
             
    </div>
    
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input type="submit" value="login">
</form> 