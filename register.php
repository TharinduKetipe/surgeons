<?php


require_once 'core/init.php';




if(Input::exists()){
    
    
    if(Token::check(Input::get('token'))){
        

    $validate = new Validation();
    $validation = $validate->check($_POST,array(
        'username'=> array(
            'required' => TRUE,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password'=> array(
            'required'=> TRUE,
            'min' => 6
        ),
        'password_again' => array(
            'required' => TRUE,
            'matches' => 'password'
        ),
        'name' => array(
            'required' => TRUE,
            'min' => 2,
            'max' => 50,
        )
    ));
    if ($validate->passed()){
        $surgeon = new Surgeon();
        $salt = Hash::salt(32);
        
        
        try {
            $surgeon->create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'salt' => $salt,
                'name' => Input::get('name'),
                'joined' => date('Y-m-d H:i:s'),
                'group' => 1
            ));
            

            Session::flash('index','You have been registered and can now log in!');
            
            
            Redirect::to('index.php');
            
            
            
        } catch (Exception $e) {
            die($e->getMessage());
            
        }
    }else {
        foreach ($validate->errors() as $error){
            echo $error, '<br>';
        }
    }
    }
}

   
?>

<form action="" method="post">
    <div class="field">
        <label for="username"> Username </label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'));?>" autocomplete="off">
    </div>
   
    <div class="field"> 
        <label for="password">Choose a password</label>
        <input type="password" name="password" >
    
    </div>
    
    <div class="field">
        <label for="password_again" >Enter your password again</label>
        <input type="password" name="password_again" >
    </div>
    <div class="field">
        <label for="name"> Name </label>
        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" >
    </div>
    <div class="field">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember" > Remember me
        </label>
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="register">
    
</form>
    