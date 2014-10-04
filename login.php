<?php
require_once'core/init.php';
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate=new Validation();
        $validation=$validate->check($_POST, array(
            'username'=>array('required'=>true),
            'password'=>array('required'=>true)
        ));
        if ($validation->passed()) {
            $surgeon=new Surgeon();
            
            $remember = (Input::get('remember')==='on')?TRUE:FALSE;
            $login=$surgeon->login(Input::get('username'),Input::get('password'),$remember);
            if ($login) {
                
                Redirect::to('index.php');
            } else {
               
                echo '<p> Sorry, login failed. </p>';
            }
        
        
            
        }else{
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
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
    
    <div class="field">
        
        <label for="remember">
            <input type="checkbox" name="remember" id="remember"> Remember me 
        </label>
    </div>
    
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input type="submit" value="login">
</form> 