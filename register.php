

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
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
                <!-- Header Links-->
		<title>SriLanka Eye Donation Society</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                <link href="interface/css/bootstrap.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
                <link href="interface/css/styles.css" rel="stylesheet">
                
	</head>
        <body style="background: #fff" >

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
            
         </body>
</html>

    